@props(['title', 'description' => null])

<div x-data="{ tab: 'preview' }" class="border border-stone-200 rounded-2xl overflow-hidden bg-white mb-8">

    {{-- Header --}}
    <div class="px-6 py-4 border-b border-stone-200">
        <h3 class="text-lg font-semibold text-stone-800">{{ $title }}</h3>
        @if($description)
            <p class="text-sm text-stone-500 mt-1">{{ $description }}</p>
        @endif
    </div>

    {{-- Tabs --}}
    <div class="flex gap-1 px-6 pt-4 border-b border-stone-200 bg-stone-50">
        <button @click="tab = 'preview'"
                :class="tab === 'preview' ? 'bg-white border-stone-200 border-b-white text-stone-900' : 'border-transparent text-stone-500 hover:text-stone-800'"
                class="px-4 py-2 text-sm font-medium rounded-t-lg border -mb-px transition">
            Preview
        </button>
        <button @click="tab = 'tailwind'"
                :class="tab === 'tailwind' ? 'bg-white border-stone-200 border-b-white text-stone-900' : 'border-transparent text-stone-500 hover:text-stone-800'"
                class="px-4 py-2 text-sm font-medium rounded-t-lg border -mb-px transition">
            Tailwind
        </button>
        <button @click="tab = 'css'"
                :class="tab === 'css' ? 'bg-white border-stone-200 border-b-white text-stone-900' : 'border-transparent text-stone-500 hover:text-stone-800'"
                class="px-4 py-2 text-sm font-medium rounded-t-lg border -mb-px transition">
            Plain CSS
        </button>
    </div>

    {{-- Preview pane --}}
    <div x-show="tab === 'preview'" class="p-8 bg-stone-100 overflow-x-auto">
        <div class="min-w-[500px]">
            {{ $preview }}
        </div>
    </div>

    {{-- Tailwind code pane --}}
    <div x-show="tab === 'tailwind'" x-cloak class="overflow-x-auto">
        <pre class="p-6 text-sm"><code class="language-html">{{ trim($tailwind) }}</code></pre>
    </div>

    {{-- Plain CSS code pane --}}
    <div x-show="tab === 'css'" x-cloak class="overflow-x-auto">
        <pre class="p-6 text-sm"><code class="language-css">{{ trim($css) }}</code></pre>
    </div>

</div>