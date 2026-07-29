<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white tracking-tight">Data Pendaftaran</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 md:p-8 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-800">Daftar Pendaftar Magang & Penelitian</h3>
                <p class="text-sm text-slate-500 mt-1">Kelola data pendaftar dan ubah status pendaftaran di sini.</p>
            </div>

            {{-- Fitur Filter Terpadu --}}
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <form method="GET" action="{{ route('admin.registrations.index') }}" class="flex flex-col lg:flex-row gap-4 items-end">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Pencarian</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama, NIM/NISN, Instansi..." class="w-full text-sm rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Tahun</label>
                        <select name="year" class="w-full lg:w-28 text-sm rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua</option>
                            @foreach($availableYears as $y)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-data="{ open: false, selected: {{ json_encode(request('months', [])) }} }" class="relative lg:w-48">
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Bulan</label>
                        <div @click="open = !open" class="w-full text-sm rounded-lg border-slate-300 bg-white px-3 py-2 border cursor-pointer flex justify-between items-center h-[38px]">
                            <span x-text="selected.length === 0 ? 'Semua Bulan' : selected.length + ' Bulan Terpilih'" class="truncate pr-2"></span>
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                        
                        <div x-show="open" @click.away="open = false" class="absolute z-10 w-full mt-1 bg-white border border-slate-200 rounded-lg shadow-lg py-1 max-h-64 overflow-y-auto" style="display: none;">
                            @foreach(['01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'] as $num => $name)
                            <label class="flex items-center px-4 py-2 hover:bg-slate-50 cursor-pointer">
                                <input type="checkbox" name="months[]" value="{{ $num }}" x-model="selected" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 mr-3">
                                <span class="text-sm text-slate-700">{{ $name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Status</label>
                        <select name="status" class="w-full lg:w-36 text-sm rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                            <option value="{{ \App\Models\Registration::STATUS_MENUNGGU }}" {{ request('status') == \App\Models\Registration::STATUS_MENUNGGU ? 'selected' : '' }}>Menunggu</option>
                            <option value="{{ \App\Models\Registration::STATUS_DITERIMA }}" {{ request('status') == \App\Models\Registration::STATUS_DITERIMA ? 'selected' : '' }}>Diterima</option>
                            <option value="{{ \App\Models\Registration::STATUS_DITOLAK }}" {{ request('status') == \App\Models\Registration::STATUS_DITOLAK ? 'selected' : '' }}>Ditolak</option>
                            <option value="{{ \App\Models\Registration::STATUS_SELESAI }}" {{ request('status') == \App\Models\Registration::STATUS_SELESAI ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Jenis</label>
                        <select name="type" class="w-full lg:w-32 text-sm rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>Semua Jenis</option>
                            <option value="{{ \App\Models\Registration::TYPE_MAGANG }}" {{ request('type') == \App\Models\Registration::TYPE_MAGANG ? 'selected' : '' }}>Magang</option>
                            <option value="{{ \App\Models\Registration::TYPE_PENELITIAN }}" {{ request('type') == \App\Models\Registration::TYPE_PENELITIAN ? 'selected' : '' }}>Penelitian</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="submit" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded-lg text-sm transition shadow h-[38px]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                            Filter
                        </button>
                        <a href="{{ route('admin.registrations.index') }}" class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2 px-4 rounded-lg border border-slate-300 text-sm transition text-center h-[38px]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-4">Tanggal Pendaftaran</th>
                            <th class="px-6 py-4">Pendaftar</th>
                            <th class="px-6 py-4">Instansi</th>
                            <th class="px-6 py-4">Jenis</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($registrations as $reg)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-800 block">{{ $reg->created_at->format('d M Y') }}</span>
                                <span class="text-xs text-slate-500">{{ $reg->created_at->format('H:i') }} WIB</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-800 block">{{ $reg->name }}</span>
                                <span class="text-xs text-slate-500">{{ $reg->phone }}</span>
                            </td>
                            <td class="px-6 py-4">{{ $reg->institution }}</td>
                            <td class="px-6 py-4 capitalize font-medium">{{ $reg->type }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        \App\Models\Registration::STATUS_MENUNGGU => 'bg-yellow-100 text-yellow-800',
                                        \App\Models\Registration::STATUS_DITERIMA => 'bg-green-100 text-green-800',
                                        \App\Models\Registration::STATUS_DITOLAK  => 'bg-red-100 text-red-800',
                                        \App\Models\Registration::STATUS_SELESAI  => 'bg-blue-100 text-blue-800',
                                    ];
                                    $statusClass = $statusColors[$reg->status] ?? 'bg-slate-100 text-slate-800';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $statusClass }}">
                                    {{ $reg->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <form action="{{ route('admin.registrations.status', $reg->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="text-xs rounded-lg border-slate-300 focus:ring-blue-500 py-1.5 pl-3 pr-8 cursor-pointer w-full">
                                            <option value="{{ \App\Models\Registration::STATUS_MENUNGGU }}" {{ $reg->status == \App\Models\Registration::STATUS_MENUNGGU ? 'selected' : '' }}>Menunggu</option>
                                            <option value="{{ \App\Models\Registration::STATUS_DITERIMA }}" {{ $reg->status == \App\Models\Registration::STATUS_DITERIMA ? 'selected' : '' }}>Diterima</option>
                                            <option value="{{ \App\Models\Registration::STATUS_DITOLAK }}" {{ $reg->status == \App\Models\Registration::STATUS_DITOLAK ? 'selected' : '' }}>Ditolak</option>
                                            <option value="{{ \App\Models\Registration::STATUS_SELESAI }}" {{ $reg->status == \App\Models\Registration::STATUS_SELESAI ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>
                                    <a href="{{ route('admin.registrations.show', $reg->id) }}" class="px-3 py-1.5 bg-blue-100 text-blue-700 hover:bg-blue-200 font-semibold rounded-lg text-xs transition">
                                        Detail
                                    </a>
                                    <form action="{{ route('admin.registrations.destroy', $reg->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftaran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 font-semibold rounded-lg text-xs transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">Belum ada data pendaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($registrations->hasPages())
            <div class="p-6 border-t border-slate-100">
                {{ $registrations->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
