<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <h2 class="text-xl font-bold text-white tracking-tight">Dashboard Admin & Petugas</h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8 flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-slate-800">Ringkasan Pendaftaran</h3>
                <p class="text-slate-500 mt-1">Statistik pendaftaran magang dan penelitian SIPEGAN.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Card Total --}}
            <div class="bg-white rounded-2xl shadow-sm border border-blue-200 p-6 border-l-4 border-l-blue-500">
                <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-2">Total Pendaftar</p>
                <h3 class="text-3xl font-extrabold text-blue-700">{{ $stats['total'] }}</h3>
            </div>
            
            {{-- Card Menunggu --}}
            <div class="bg-white rounded-2xl shadow-sm border border-yellow-200 p-6 border-l-4 border-l-yellow-500">
                <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-2">Menunggu Proses</p>
                <h3 class="text-3xl font-extrabold text-yellow-600">{{ $stats['menunggu'] }}</h3>
            </div>
            
            {{-- Card Diterima --}}
            <div class="bg-white rounded-2xl shadow-sm border border-green-200 p-6 border-l-4 border-l-green-500">
                <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-2">Diterima / Aktif</p>
                <h3 class="text-3xl font-extrabold text-green-600">{{ $stats['diterima'] }}</h3>
            </div>
            
            {{-- Card Ditolak --}}
            <div class="bg-white rounded-2xl shadow-sm border border-red-200 p-6 border-l-4 border-l-red-500">
                <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-2">Ditolak</p>
                <h3 class="text-3xl font-extrabold text-red-600">{{ $stats['ditolak'] }}</h3>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Pendaftar Magang</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $stats['magang'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
                <div>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Pendaftar Penelitian</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $stats['penelitian'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
