<x-public-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <h2 class="text-xl font-bold text-white tracking-tight">Dashboard SIPEGAN</h2>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto space-y-6 mt-4">
        
        {{-- Hero Section --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 md:p-8 text-center bg-blue-50 border-b border-blue-100">
                <h1 class="text-2xl md:text-3xl font-extrabold text-blue-900 mb-2">Selamat Datang di SIPEGAN</h1>
                <p class="text-blue-700 max-w-2xl mx-auto">Sistem Pelayanan Magang dan Penelitian Dinas Kependudukan dan Pencatatan Sipil Kabupaten Tegal.</p>
            </div>
            
            <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Info Kuota --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-lg font-bold text-slate-800 border-b pb-2">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Informasi Ketersediaan Kuota
                        <span class="ml-auto bg-blue-100 text-blue-800 text-xs font-extrabold px-3 py-1 rounded-full border border-blue-200 uppercase tracking-wider">
                            Tahun {{ date('Y') }}
                        </span>
                    </div>
                    
                    @if(count($quotaData) > 0)
                        <div class="flex gap-4 overflow-x-auto py-4 px-2 snap-x snap-mandatory scroll-smooth border-b border-slate-100 mb-2">
                            @foreach($quotaData as $q)
                                @php 
                                    $totalSisa = max(0, $q['available_magang']);
                                    $bulanIndo = ['01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'Mei', '06'=>'Jun', '07'=>'Jul', '08'=>'Agu', '09'=>'Sep', '10'=>'Okt', '11'=>'Nov', '12'=>'Des'];
                                    $namaBulan = $bulanIndo[date('m', strtotime($q['month']))] ?? 'ERR';
                                @endphp
                                <div class="w-24 shrink-0 h-24 bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm hover:shadow hover:-translate-y-1 transition-all duration-300 flex flex-col">
                                    <div class="bg-blue-50 py-1.5 px-2 text-center border-b border-blue-100">
                                        <p class="text-[11px] font-bold text-blue-900 tracking-wider uppercase">{{ $namaBulan }}</p>
                                    </div>
                                    <div class="flex-1 flex items-center justify-center bg-white">
                                        <span class="text-2xl font-black text-blue-600 tracking-tight">{{ $totalSisa }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-sm text-slate-500 mt-3 px-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Scroll ke samping untuk melihat bulan lainnya
                        </p>
                    @else
                        <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-100 text-center">
                            <p class="font-semibold text-yellow-900">Belum ada kuota yang ditetapkan oleh admin.</p>
                        </div>
                    @endif
                </div>

                {{-- Tautan Cepat Section --}}
                <div>
                    <div class="flex items-center gap-3 text-lg font-bold text-slate-800 mb-6">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        Tautan Cepat
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="https://drive.google.com/drive/folders/1WhCHHS8etmPz9edr27HWYq4BAnVdQFeD" target="_blank" class="h-24 flex flex-col items-center justify-center p-3 bg-white hover:bg-blue-50 border border-slate-200 hover:border-blue-300 rounded-xl hover:-translate-y-1 shadow-sm transition-all duration-300 group">
                            <svg class="w-6 h-6 text-blue-500 mb-1.5 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <span class="text-[13px] font-semibold text-slate-700 group-hover:text-blue-700">Sertifikat Magang</span>
                        </a>
                        
                        <a href="https://api.whatsapp.com/send/?phone=%2B6285726409177&text&type=phone_number&app_absent=0" target="_blank" class="h-24 flex flex-col items-center justify-center p-3 bg-white hover:bg-green-50 border border-slate-200 hover:border-green-300 rounded-xl hover:-translate-y-1 shadow-sm transition-all duration-300 group">
                            <svg class="w-6 h-6 text-green-500 mb-1.5 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            <span class="text-[13px] font-semibold text-slate-700 group-hover:text-green-700">Hubungi Admin</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Video Alur Pendaftaran --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
            <h3 class="text-xl font-bold text-slate-800 mb-4 text-center">Video Alur Pelayanan Pendaftaran</h3>
            <div class="aspect-video bg-slate-100 rounded-xl flex items-center justify-center border border-slate-200 overflow-hidden relative">
                <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/kcScTuVGS7w" title="Alur Pendaftaran" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>

    </div>
</x-public-layout>
