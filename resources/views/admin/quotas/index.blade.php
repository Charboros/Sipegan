<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Konfigurasi Kuota Magang (Tahun Berjalan: {{ $currentYear }})
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
            <div class="p-6 bg-slate-50 border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-800">Daftar Kuota Magang Tahun {{ $currentYear }}</h3>
                <p class="text-sm text-slate-500 mt-1">Silakan atur jumlah kuota magang untuk masing-masing bulan pada tahun berjalan.</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 text-sm">
                            <th class="p-4 font-semibold">Bulan</th>
                            <th class="p-4 font-semibold w-1/3">Jumlah Kuota Magang</th>
                            <th class="p-4 font-semibold w-48 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach ($quotas as $quota)
                        @php
                            $bulanIndo = ['01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'];
                            $bulanLabel = $bulanIndo[date('m', strtotime($quota->month))] ?? date('F', strtotime($quota->month));
                        @endphp
                        <tr class="hover:bg-slate-50/50">
                            <td class="p-4 font-medium text-slate-800">
                                {{ $bulanLabel }}
                            </td>
                            <td class="p-4">
                                <form action="{{ route('quotas.update', $quota->id) }}" method="POST" class="flex gap-4 items-center" id="form-update-magang-{{ $quota->id }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quota_magang" value="{{ $quota->quota_magang }}" class="w-24 rounded border-slate-300 py-1.5 px-3 text-sm focus:border-blue-500 focus:ring-blue-500 font-bold text-blue-700">
                            </td>
                            <td class="p-4 text-center">
                                    <button type="submit" class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 font-bold py-2 px-4 rounded-lg transition shadow-sm border border-blue-200">
                                        Simpan Perubahan
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
