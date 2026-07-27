<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.registrations.index') }}" class="text-white hover:text-slate-200 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="text-xl font-bold text-white tracking-tight">Detail Pendaftaran {{ $registration->name }}</h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">
            <div class="p-6 md:p-8 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Informasi Lengkap Pendaftar</h3>
                    <p class="text-sm text-slate-500 mt-1 capitalize">Jenis Pendaftaran: <strong>{{ $registration->type }}</strong></p>
                </div>
                <div>
                    @php
                        $statusColors = [
                            'menunggu' => 'bg-yellow-100 text-yellow-800',
                            'diterima' => 'bg-green-100 text-green-800',
                            'ditolak'  => 'bg-red-100 text-red-800',
                            'selesai'  => 'bg-blue-100 text-blue-800',
                        ];
                        $statusClass = $statusColors[$registration->status] ?? 'bg-slate-100 text-slate-800';
                    @endphp
                    <span class="px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wider {{ $statusClass }}">
                        Status: {{ $registration->status }}
                    </span>
                </div>
            </div>

            <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">Nama Lengkap</p>
                    <p class="font-medium text-slate-800">{{ $registration->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">NIM / NISN</p>
                    <p class="font-medium text-slate-800">{{ $registration->nim_nisn ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">Email</p>
                    <p class="font-medium text-slate-800">{{ $registration->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">No. WhatsApp</p>
                    <p class="font-medium text-slate-800">{{ $registration->phone }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">Asal Sekolah / Universitas</p>
                    <p class="font-medium text-slate-800">{{ $registration->institution }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">Program Studi / Kejuruan</p>
                    <p class="font-medium text-slate-800">{{ $registration->study_program ?? '-' }}</p>
                </div>

                @if($registration->type == 'magang')
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">Kategori Peserta</p>
                    <p class="font-medium text-slate-800">{{ $registration->participant_category ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">Tempat, Tanggal Lahir</p>
                    <p class="font-medium text-slate-800">{{ $registration->birth_place ?? '-' }}, {{ $registration->birth_date ? \Carbon\Carbon::parse($registration->birth_date)->translatedFormat('d F Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">Jenis Kelamin</p>
                    <p class="font-medium text-slate-800">{{ $registration->gender ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-slate-500 font-semibold mb-1">Alamat Lengkap</p>
                    <p class="font-medium text-slate-800">{{ $registration->address ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">Nama Pembimbing</p>
                    <p class="font-medium text-slate-800">{{ $registration->advisor_name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">No. HP Pembimbing</p>
                    <p class="font-medium text-slate-800">{{ $registration->advisor_phone ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-slate-500 font-semibold mb-1">Bulan Pelaksanaan Magang</p>
                    @php
                        $months = [
                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                        ];
                        $selected = [];
                        if(is_array($registration->magang_months)) {
                            foreach($registration->magang_months as $m) {
                                $selected[] = $months[$m] ?? $m;
                            }
                        }
                    @endphp
                    <div class="flex flex-wrap gap-2 mt-1">
                        @forelse($selected as $m)
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">{{ $m }}</span>
                        @empty
                            <span class="text-slate-500">-</span>
                        @endforelse
                    </div>
                </div>
                @else
                <div class="md:col-span-2">
                    <p class="text-sm text-slate-500 font-semibold mb-1">Judul Penelitian</p>
                    <p class="font-medium text-slate-800">{{ $registration->research_title ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-semibold mb-1">Tanggal Mulai Pelaksanaan</p>
                    <p class="font-medium text-slate-800">{{ $registration->start_date ? \Carbon\Carbon::parse($registration->start_date)->translatedFormat('d F Y') : '-' }}</p>
                </div>
                @endif
                
                <div class="md:col-span-2 mt-4 pt-4 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500 font-semibold mb-1">Dokumen Surat Permohonan</p>
                        @if($registration->document_path)
                            <a href="{{ asset('storage/' . $registration->document_path) }}" target="_blank" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Lihat / Unduh Surat
                            </a>
                        @else
                            <p class="text-slate-500 italic">Tidak ada dokumen yang diunggah.</p>
                        @endif
                    </div>

                    <form action="{{ route('admin.registrations.status', $registration->id) }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                        @csrf
                        @method('PATCH')
                        <div class="flex items-center gap-3">
                            <label class="text-sm font-semibold text-slate-700 whitespace-nowrap">Ubah Status:</label>
                            <select name="status" class="rounded-lg border-slate-300 focus:ring-blue-500 cursor-pointer text-sm">
                                <option value="menunggu" {{ $registration->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diterima" {{ $registration->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ $registration->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="selesai" {{ $registration->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-sm transition">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
