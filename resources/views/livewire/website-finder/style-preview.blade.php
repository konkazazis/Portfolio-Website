{{-- Tiny wireframe of each visual style, so visitors can point at a look instead of naming it. --}}
<div aria-hidden="true" class="aspect-[16/10] w-full overflow-hidden rounded-md border-2 border-[#1C1B22]">
    @switch($style)
        @case('minimal')
            <div class="flex h-full flex-col bg-white p-3">
                <div class="flex items-center justify-between">
                    <span class="h-1.5 w-6 bg-stone-900"></span>
                    <span class="flex gap-1.5"><span class="h-1 w-3 bg-stone-300"></span><span class="h-1 w-3 bg-stone-300"></span><span class="h-1 w-3 bg-stone-300"></span></span>
                </div>
                <div class="m-auto w-3/5 space-y-1.5 text-center">
                    <span class="mx-auto block h-2 w-full bg-stone-900"></span>
                    <span class="mx-auto block h-1 w-2/3 bg-stone-300"></span>
                    <span class="mx-auto mt-2.5 block h-2.5 w-1/4 bg-emerald-500"></span>
                </div>
            </div>
            @break

        @case('bold')
            <div class="flex h-full flex-col gap-2 bg-[#FFE45C] p-3">
                <div class="flex items-center justify-between">
                    <span class="h-2 w-7 rounded-sm bg-[#1C1B22]"></span>
                    <span class="h-3 w-7 rounded-sm border-2 border-[#1C1B22] bg-[#FF9EC7]"></span>
                </div>
                <div class="flex flex-1 items-center gap-2">
                    <div class="flex-1 space-y-1.5">
                        <span class="block h-2.5 w-full bg-[#1C1B22]"></span>
                        <span class="block h-2.5 w-3/4 bg-[#1C1B22]"></span>
                        <span class="mt-1 block h-3 w-1/2 rounded-sm border-2 border-[#1C1B22] bg-white shadow-[2px_2px_0_#1C1B22]"></span>
                    </div>
                    <span class="h-10 w-10 rotate-6 rounded-[4px_10px_4px_12px] border-2 border-[#1C1B22] bg-[#8EE3C8] shadow-[3px_3px_0_#1C1B22]"></span>
                </div>
            </div>
            @break

        @case('corporate')
            <div class="flex h-full flex-col bg-slate-50">
                <div class="flex items-center justify-between bg-blue-900 px-3 py-1.5">
                    <span class="h-1.5 w-6 bg-white"></span>
                    <span class="h-2 w-6 rounded-sm bg-sky-400"></span>
                </div>
                <div class="space-y-1 px-3 pt-2">
                    <span class="block h-1.5 w-1/2 bg-blue-950"></span>
                    <span class="block h-1 w-1/3 bg-slate-300"></span>
                </div>
                <div class="mt-auto grid grid-cols-3 gap-1.5 p-3">
                    @foreach(range(1, 3) as $i)
                        <span class="h-7 rounded-sm border border-slate-200 bg-white"><span class="m-1 block h-1.5 w-1.5 rounded-full bg-sky-500"></span></span>
                    @endforeach
                </div>
            </div>
            @break

        @case('editorial')
            <div class="grid h-full grid-cols-[1fr_0.8fr] bg-[#F5F0E6]">
                <div class="flex flex-col justify-center gap-1.5 p-3">
                    <span class="font-serif text-2xl leading-none text-stone-900">Aa</span>
                    <span class="block h-px w-full bg-stone-400"></span>
                    <span class="block h-1 w-4/5 bg-stone-400"></span>
                    <span class="block h-1 w-3/5 bg-stone-400"></span>
                </div>
                <div class="bg-gradient-to-br from-stone-400 to-stone-600"></div>
            </div>
            @break

        @case('dark')
            <div class="relative flex h-full flex-col overflow-hidden bg-[#0B0B12] p-3">
                <span class="absolute -right-4 -top-6 h-20 w-20 rounded-full bg-gradient-to-br from-fuchsia-500 to-cyan-400 opacity-60 blur-xl"></span>
                <div class="relative flex items-center justify-between">
                    <span class="h-1.5 w-6 bg-white/80"></span>
                    <span class="h-2 w-6 rounded-full bg-white/15"></span>
                </div>
                <div class="relative mt-auto space-y-1.5">
                    <span class="block h-2 w-3/4 bg-white"></span>
                    <span class="block h-1 w-1/2 bg-white/40"></span>
                    <span class="mt-1 block h-3 w-1/3 rounded-full bg-gradient-to-r from-fuchsia-500 to-cyan-400"></span>
                </div>
            </div>
            @break

        @case('warm')
            <div class="flex h-full items-center gap-3 bg-[#FDEBDD] p-3">
                <span class="h-12 w-12 shrink-0 rounded-full bg-[#E9A27C]"></span>
                <div class="flex-1 space-y-1.5">
                    <span class="block h-2 w-full rounded-full bg-[#7C3F23]"></span>
                    <span class="block h-1.5 w-3/4 rounded-full bg-[#D9A38A]"></span>
                    <span class="mt-1 block h-3 w-1/2 rounded-full bg-[#E9725A]"></span>
                </div>
            </div>
            @break
    @endswitch
</div>
