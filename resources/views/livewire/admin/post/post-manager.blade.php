<div>

{{-- ═══════════════════════════════════ LIST VIEW ═══════════════════════════════════ --}}
@if($mode === 'list')

    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="admin-title">Posts</h1>
            <p class="admin-subtitle">Manage your blog posts.</p>
        </div>
        <button wire:click="openCreate"
                class="admin-btn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Post
        </button>
    </div>

    <div class="flex flex-wrap gap-3 mb-6">
        <input wire:model.live.debounce.300ms="search"
               type="text"
               placeholder="Search posts…"
               class="admin-input w-auto">
        <select wire:model.live="filterStatus"
                class="admin-input w-auto">
            <option value="">All statuses</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="admin-card overflow-hidden">
        @if($posts->isEmpty())
            <div class="admin-empty">No posts found.</div>
        @else
            <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="admin-thead">
                    <tr>
                        <th class="admin-th px-6">Title</th>
                        <th class="admin-th hidden md:table-cell">Category</th>
                        <th class="admin-th">Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-dashed divide-stone-200 dark:divide-stone-700">
                    @foreach($posts as $post)
                        <tr class="admin-row">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-stone-800 dark:text-stone-100">{{ $post->title }}</p>
                                <div class="flex">
                                    <p class="text-xs text-stone-400 dark:text-stone-500">{{ $post->created_at->format('M j, Y') }}</p>
                                    @if (!empty($post->published_at))
                                        <p class="text-xs text-stone-400 dark:text-stone-500">, (Last update:</p>
                                        <p class="text-xs text-stone-400 dark:text-stone-500">{{ $post->published_at->format('M j, Y') }})</p>                                    
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4 text-stone-600 dark:text-stone-300 hidden md:table-cell">
                                {{ $post->category?->name ?? '—' }}
                            </td>
                            <td class="px-4 py-4">
                                @if($post->status === 'published')
                                    <span class="admin-badge bg-[#8EE3C8]">
                                        Published
                                    </span>
                                @else
                                    <span class="admin-badge">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="openEdit({{ $post->id }})"
                                            class="admin-action">
                                        Edit
                                    </button>
                                    <button wire:click="confirmDelete({{ $post->id }})"
                                            class="admin-action admin-action-danger">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            @if($posts->hasPages())
                <div class="px-6 py-4 border-t-2 border-dashed border-stone-200 dark:border-stone-700">
                    {{ $posts->links() }}
                </div>
            @endif
        @endif
    </div>

{{-- ═══════════════════════════════════ EDITOR VIEW ═══════════════════════════════════ --}}
@else

    <div
        x-data="{
            quill: null,
            wordCount: 0,
            saveStatus: '',
            saveTimer: null,
            uploadRange: null,

            init() {
                this.$nextTick(() => {
                    if (typeof Quill === 'undefined' || !this.$refs.quillEditor) return;

                    this.quill = new Quill(this.$refs.quillEditor, {
                        theme: 'snow',
                        placeholder: 'Start writing your post…',
                        modules: {
                            toolbar: {
                                container: [
                                    [{ header: [1, 2, 3, false] }],
                                    ['bold', 'italic', 'underline', 'strike'],
                                    ['blockquote', 'code-block'],
                                    [{ list: 'ordered' }, { list: 'bullet' }],
                                    ['link', 'image'],
                                    ['clean']
                                ],
                                handlers: {
                                    image: () => this.pickAndUploadImage()
                                }
                            }
                        }
                    });

                    const initial = this.$refs.quillEditor.dataset.initialContent || '';
                    if (initial) { this.quill.root.innerHTML = initial; }
                    this.updateWordCount();

                    this.quill.on('text-change', () => {
                        this.updateWordCount();
                        this.saveStatus = '';
                        clearTimeout(this.saveTimer);
                        this.saveTimer = setTimeout(() => this.autoSave(), 800);
                    });
                });

                $wire.on('post-loaded', ({ content }) => {
                    if (!this.quill) return;
                    this.quill.root.innerHTML = content || '';
                    this.updateWordCount();
                    this.saveStatus = '';
                    clearTimeout(this.saveTimer);
                });

                $wire.on('content-image-uploaded', ({ url }) => {
                    const range = this.uploadRange || this.quill.getSelection(true);
                    this.quill.insertEmbed(range.index, 'image', url, 'user');
                    this.quill.setSelection(range.index + 1);
                    this.uploadRange = null;
                });

                $wire.on('content-image-upload-failed', () => {
                    this.uploadRange = null;
                    alert('Image upload failed. Please try again.');
                });
            },

            pickAndUploadImage() {
                this.uploadRange = this.quill.getSelection(true);

                const input = document.createElement('input');
                input.type = 'file';
                input.accept = 'image/*';
                input.onchange = () => {
                    const file = input.files[0];
                    if (!file) return;

                    $wire.upload('contentImage', file, () => {}, () => {
                        this.uploadRange = null;
                        alert('Image upload failed. Please try again.');
                    });
                };
                input.click();
            },

            async autoSave() {
                this.saveStatus = 'saving';
                await $wire.saveContent(this.quill.root.innerHTML);
                this.saveStatus = 'saved';
            },

            updateWordCount() {
                const text = this.quill.getText().trim();
                this.wordCount = text ? text.split(/\s+/).filter(w => w.length > 0).length : 0;
            }
        }"
    >
        {{-- Page header --}}
        <div class="flex flex-wrap items-center justify-between mb-6 gap-y-3">
            <div class="flex items-center gap-3">
                <button wire:click="cancel"
                    class="admin-btn admin-btn-white p-1.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <div>
                    <h1 class="admin-title">
                        {{ $editingId ? 'Edit Post' : 'New Post' }}
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-4">
                {{-- Word count --}}
                <span class="text-xs text-stone-400 dark:text-stone-500 tabular-nums">
                    <span x-text="wordCount.toLocaleString()"></span> words
                </span>

                {{-- Save status --}}
                <div class="text-xs">
                    <template x-if="saveStatus === 'saving'">
                        <span class="text-stone-400 flex items-center gap-1">
                            <svg class="w-3 h-3 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                            Saving
                        </span>
                    </template>
                    <template x-if="saveStatus === 'saved'">
                        <span class="text-emerald-700 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            Saved
                        </span>
                    </template>
                </div>

                {{-- Save button --}}
                <button
                    @click="$wire.content = quill.root.innerHTML"
                    wire:click="save"
                    wire:loading.attr="disabled"
                    class="admin-btn">
                    <span wire:loading.remove wire:target="save">{{ $editingId ? 'Save changes' : 'Save post' }}</span>
                    <span wire:loading wire:target="save">Saving…</span>
                </button>
            </div>
        </div>

        {{-- 3-column editor layout --}}
        <div class="admin-card flex flex-col lg:flex-row overflow-hidden">

            {{-- Posts list sidebar — hidden on mobile, vertical on desktop --}}
            <aside class="hidden lg:flex w-44 shrink-0 border-r-[2.5px] border-[#1C1B22] dark:border-stone-300 bg-[#FBF8F1] dark:bg-stone-900/60 flex-col">
                <div class="px-3 py-3 border-b-2 border-dashed border-stone-200 dark:border-stone-700">
                    <p class="admin-label mb-0">Posts</p>
                </div>
                <nav class="flex-1 py-1 overflow-y-auto max-h-[600px]">
                    @foreach($recentPosts as $p)
                        <button wire:click="openEdit({{ $p->id }})"
                            @class([
                                'w-full flex items-center gap-2 px-3 py-2 text-left transition-colors',
                                'bg-[#FFE45C] text-[#1C1B22] font-semibold' => $p->id === $editingId,
                                'text-stone-600 dark:text-stone-400 hover:text-[#1C1B22] dark:hover:text-stone-200 hover:bg-white dark:hover:bg-stone-800' => $p->id !== $editingId,
                            ])>
                            <span class="truncate text-[12px]">{{ $p->title ?: 'Untitled' }}</span>
                            @if($p->status === 'published')
                                <span class="w-2 h-2 rounded-full bg-[#8EE3C8] border border-[#1C1B22] shrink-0 ml-auto"></span>
                            @endif
                        </button>
                    @endforeach
                </nav>
                <div class="px-3 py-3 border-t-2 border-dashed border-stone-200 dark:border-stone-700">
                    <button wire:click="openCreate"
                        class="admin-btn admin-btn-sm w-full">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        New
                    </button>
                </div>
            </aside>

            {{-- Writing area --}}
            <main class="flex-1 flex flex-col min-w-0 bg-white dark:bg-stone-950">
                <div class="border-b-2 border-dashed border-stone-200 dark:border-stone-700 px-4 sm:px-6 py-4 space-y-2">
                    <input type="text" wire:model.lazy="title" placeholder="Post title"
                        class="w-full bg-transparent border-none outline-none font-serif text-3xl font-bold text-[#1C1B22] dark:text-stone-100 placeholder-stone-300 dark:placeholder-stone-600 focus:ring-0">
                    @error('title') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    <textarea wire:model.lazy="excerpt" rows="2" placeholder="Short excerpt…"
                        class="w-full bg-transparent border-none outline-none text-sm text-stone-400 dark:text-stone-500 placeholder-stone-300 dark:placeholder-stone-600 focus:ring-0 resize-none leading-relaxed"></textarea>
                </div>

                <div wire:ignore>
                    <div x-ref="quillEditor" data-initial-content="{{ $content }}" class="text-stone-900 dark:text-stone-100"></div>
                </div>
                @error('content') <p class="px-4 sm:px-6 py-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </main>

            {{-- Meta sidebar — full-width row on mobile, fixed column on desktop --}}
            <aside class="w-full lg:w-52 shrink-0 border-t-[2.5px] lg:border-t-0 lg:border-l-[2.5px] border-[#1C1B22] dark:border-stone-300 bg-[#FBF8F1] dark:bg-stone-900/60 p-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-1 gap-4 lg:gap-5">
                <div>
                    <label class="admin-label">Status</label>
                    <select wire:model="status"
                        class="admin-input">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
                <div>
                    <label class="admin-label">Category</label>
                    <select wire:model="category_id"
                        class="admin-input">
                        <option value="">No category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if($tags->isNotEmpty())
                <div class="col-span-2 sm:col-span-3 lg:col-span-1">
                    <label class="admin-label mb-3">Tags</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" wire:model="selectedTags" value="{{ $tag->id }}"
                                    class="admin-checkbox">
                                <span class="text-sm text-stone-600 dark:text-stone-300">{{ $tag->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>{{-- end meta grid --}}
            </aside>
        </div>
    </div>

@endif

{{-- Delete confirmation modal --}}
<div x-data="{ show: @entangle('deletingId').live }"
     x-show="show !== null"
     x-transition:enter="transition duration-150"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     class="admin-backdrop"
     style="display: none;">
    <div @click.stop class="admin-modal max-w-sm text-center">
        <p class="font-serif text-2xl font-bold text-[#1C1B22] dark:text-stone-100 mb-2">Delete post?</p>
        <p class="text-sm text-stone-500 dark:text-stone-400 mb-6">This cannot be undone.</p>
        <div class="flex justify-center gap-3">
            <button wire:click="cancelDelete"
                    class="admin-btn admin-btn-white">Cancel</button>
            <button wire:click="delete"
                    class="admin-btn admin-btn-danger">Delete</button>
        </div>
    </div>
</div>

</div>
