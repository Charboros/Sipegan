<x-public-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white tracking-tight">Cek Status Pendaftaran</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-4 space-y-6">
        
        {{-- Success Message --}}
        @if(session('registered_code'))
        <div class="bg-green-50 border-2 border-green-500 rounded-2xl p-6 md:p-8 text-center shadow-lg relative mb-8 animate-slide-down">
            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-2xl font-black text-green-800 mb-2">Pendaftaran Berhasil Dikirim!</h3>
            <p class="text-green-700">Terima kasih, data Anda telah masuk ke dalam sistem. <br>Anda dapat melacak status pendaftaran kapan saja melalui halaman ini menggunakan <strong>Email dan NIM/NISN</strong> Anda.</p>
        </div>
        @endif

        {{-- Search Form --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
            <h3 class="text-lg font-bold text-slate-800 mb-2">Lacak Status Pendaftaran</h3>
            <p class="text-sm text-slate-500 mb-6">Masukkan Alamat Email dan NIM/NISN yang Anda gunakan saat mendaftar untuk melihat seluruh status pendaftaran Anda.</p>

            <form action="{{ route('public.search_status') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                @csrf
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" value="{{ request('email') }}" placeholder="Contoh: nama@email.com" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all shadow-sm" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">NIM / NISN</label>
                    <input type="text" name="nim_nisn" value="{{ request('nim_nisn') }}" placeholder="Masukkan NIM / NISN..." class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all shadow-sm" required>
                </div>
                <div class="md:col-span-1">
                    <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-sm transition-all h-[42px]">
                        Cari Data
                    </button>
                </div>
            </form>
        </div>

        {{-- Results --}}
        @if(isset($registrations))
            <h3 class="text-xl font-extrabold text-slate-800 mt-8 mb-4">Hasil Pencarian: {{ $registrations->count() }} Pendaftaran</h3>
            
            <div class="space-y-6">
                @foreach($registrations as $registration)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden animate-slide-up" style="animation-delay: {{ $loop->index * 100 }}ms;">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-start flex-col sm:flex-row gap-4 bg-slate-50/50">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Pendaftaran {{ ucfirst($registration->type) }}</h3>
                            <p class="text-slate-500 text-sm mt-1">Diajukan pada: {{ $registration->created_at->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'menunggu' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'diterima' => 'bg-green-100 text-green-800 border-green-200',
                                    'ditolak'  => 'bg-red-100 text-red-800 border-red-200',
                                    'selesai'  => 'bg-blue-100 text-blue-800 border-blue-200',
                                ];
                                $statusClass = $statusColors[$registration->status] ?? 'bg-slate-100 text-slate-800';
                            @endphp
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold border capitalize {{ $statusClass }}">
                                Status: {{ $registration->status }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-6 gap-x-6">
                        <div>
                            <p class="text-[13px] text-slate-500 font-semibold mb-1 uppercase tracking-wide">Nama Lengkap</p>
                            <p class="font-medium text-slate-800">{{ $registration->name }}</p>
                        </div>
                        <div>
                            <p class="text-[13px] text-slate-500 font-semibold mb-1 uppercase tracking-wide">Asal Instansi</p>
                            <p class="font-medium text-slate-800">{{ $registration->institution }}</p>
                        </div>
                        <div>
                            <p class="text-[13px] text-slate-500 font-semibold mb-1 uppercase tracking-wide">Program Studi</p>
                            <p class="font-medium text-slate-800">{{ $registration->study_program }}</p>
                        </div>
                        
                        @if($registration->type == 'penelitian')
                        <div>
                            <p class="text-[13px] text-slate-500 font-semibold mb-1 uppercase tracking-wide">Tanggal Mulai</p>
                            <p class="font-medium text-slate-800">{{ $registration->start_date ? \Carbon\Carbon::parse($registration->start_date)->translatedFormat('d F Y') : '-' }}</p>
                        </div>
                        <div class="sm:col-span-2 lg:col-span-4 border-t border-slate-100 pt-4 mt-2">
                            <p class="text-[13px] text-slate-500 font-semibold mb-1 uppercase tracking-wide">Judul Penelitian</p>
                            <p class="font-medium text-slate-800">{{ $registration->research_title }}</p>
                        </div>
                        @else
                        <div>
                            <p class="text-[13px] text-slate-500 font-semibold mb-1 uppercase tracking-wide">Bulan Pelaksanaan</p>
                            @php
                                $months = [
                                    '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
                                    '05' => 'Mei', '06' => 'Jun', '07' => 'Jul', '08' => 'Agu',
                                    '09' => 'Sep', '10' => 'Okt', '11' => 'Nov', '12' => 'Des'
                                ];
                                $selected = [];
                                if(is_array($registration->magang_months)) {
                                    foreach($registration->magang_months as $m) {
                                        $selected[] = $months[$m] ?? $m;
                                    }
                                }
                            @endphp
                            <p class="font-medium text-slate-800">{{ !empty($selected) ? implode(', ', $selected) : '-' }}</p>
                        </div>
                        @endif
                    </div>
                    
                    @if($registration->status == 'menunggu')
                    <div class="px-6 py-4 bg-yellow-50 border-t border-yellow-100 text-sm text-yellow-800 flex items-start gap-3">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p>Pendaftaran ini sedang menunggu proses verifikasi oleh Admin. Silakan cek status secara berkala.</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @endif

    </div>
</x-public-layout>
