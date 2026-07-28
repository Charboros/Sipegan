<x-public-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white tracking-tight">Pertanyaan yang Sering Diajukan (FAQ)</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 space-y-6">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
            <h3 class="text-2xl font-black text-slate-800 mb-6 text-center">Bantuan & FAQ</h3>
            <p class="text-center text-slate-600 mb-8 max-w-2xl mx-auto">Temukan jawaban untuk pertanyaan umum seputar pendaftaran magang dan penelitian di Dinas Kependudukan dan Pencatatan Sipil Kabupaten Tegal.</p>

            {{-- Search Form --}}
            <form action="{{ route('public.faq') }}" method="GET" class="mb-8 max-w-xl mx-auto relative">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pertanyaan atau kata kunci..." 
                           class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all shadow-sm">
                    @if(request('search'))
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <a href="{{ route('public.faq') }}" class="text-slate-400 hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </a>
                        </div>
                    @endif
                </div>
            </form>

            @if($faqs->isEmpty())
                <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 text-center">
                    @if(request('search'))
                        <p class="font-semibold text-blue-800 mb-2">Tidak ditemukan hasil untuk "{{ request('search') }}"</p>
                        <a href="{{ route('public.faq') }}" class="text-sm text-blue-600 hover:underline">Tampilkan semua FAQ</a>
                    @else
                        <p class="font-semibold text-blue-800">Saat ini belum ada data FAQ yang tersedia.</p>
                    @endif
                </div>
            @else
                <div class="space-y-4" x-data="{ activeFaq: null }">
                    @foreach($faqs as $faq)
                        <div class="border border-slate-200 rounded-xl overflow-hidden transition-all duration-300"
                             :class="activeFaq === {{ $faq->id }} ? 'ring-2 ring-blue-500 border-transparent shadow-md' : 'hover:border-blue-300 hover:shadow-sm'">
                            <button @click="activeFaq = activeFaq === {{ $faq->id }} ? null : {{ $faq->id }}" 
                                    class="w-full flex items-center justify-between p-5 text-left bg-white hover:bg-slate-50 transition-colors focus:outline-none">
                                <span class="font-bold text-slate-800 pr-4">{{ $faq->question }}</span>
                                <span class="shrink-0 w-8 h-8 flex items-center justify-center rounded-full transition-colors"
                                      :class="activeFaq === {{ $faq->id }} ? 'bg-blue-100 text-blue-600' : 'bg-slate-100 text-slate-500'">
                                    <svg class="w-5 h-5 transition-transform duration-300" :class="activeFaq === {{ $faq->id }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </span>
                            </button>
                            <div x-show="activeFaq === {{ $faq->id }}" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 style="display: none;">
                                <div class="p-5 pt-0 border-t border-slate-100 bg-slate-50/50">
                                    <div class="prose prose-sm max-w-none text-slate-600 whitespace-pre-line leading-relaxed">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="text-center pb-8">
            <p class="text-slate-500 text-sm">Masih memiliki pertanyaan? Silakan <a href="https://api.whatsapp.com/send/?phone=%2B6285726409177&text&type=phone_number&app_absent=0" target="_blank" class="text-blue-600 font-bold hover:underline">Hubungi Admin</a></p>
        </div>
    </div>
</x-public-layout>
