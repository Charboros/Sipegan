<x-public-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white tracking-tight">Pendaftaran Magang SIPEGAN</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 md:p-8 border-b border-slate-100">
                <h3 class="text-lg md:text-xl font-bold text-slate-800">Form Pendaftaran Magang / Praktik Kerja Lapangan</h3>
                <p class="text-sm text-slate-500 mt-1">Silakan lengkapi data diri Anda dengan benar.</p>
            </div>

            <div class="p-6 md:p-8">
                <form action="{{ route('public.store_magang') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Lengkap --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        {{-- No. HP / WA --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">No. WhatsApp <span class="text-red-500">*</span></label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- NIM / NISN --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">NIM / NISN <span class="text-red-500">*</span></label>
                            <input type="text" name="nim_nisn" value="{{ old('nim_nisn') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('nim_nisn') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Kategori Peserta --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori Peserta <span class="text-red-500">*</span></label>
                            <select name="participant_category" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                                <option value="">Pilih Kategori...</option>
                                <option value="Sekolah Menengah Kejuruan" {{ old('participant_category') == 'Sekolah Menengah Kejuruan' ? 'selected' : '' }}>Sekolah Menengah Kejuruan</option>
                                <option value="Perguruan Tinggi" {{ old('participant_category') == 'Perguruan Tinggi' ? 'selected' : '' }}>Perguruan Tinggi</option>
                            </select>
                            @error('participant_category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        {{-- Asal Sekolah / Perguruan Tinggi --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Asal Sekolah / PT <span class="text-red-500">*</span></label>
                            <input type="text" name="institution" value="{{ old('institution') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('institution') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Program Studi / Kejuruan --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Program Studi / Kejuruan <span class="text-red-500">*</span></label>
                            <input type="text" name="study_program" value="{{ old('study_program') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('study_program') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        {{-- Tempat Lahir --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="birth_place" value="{{ old('birth_place') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('birth_place') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tanggal Lahir --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('birth_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="gender" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                                <option value="">Pilih...</option>
                                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        {{-- Alamat Sesuai KTP --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Sesuai KTP <span class="text-red-500">*</span></label>
                            <textarea name="address" rows="2" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>{{ old('address') }}</textarea>
                            @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Nama Dosen Pembimbing --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Pembimbing</label>
                            <input type="text" name="advisor_name" value="{{ old('advisor_name') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700">
                            <p class="text-xs text-slate-500 mt-1">Kosongkan jika belum ada</p>
                            @error('advisor_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- No HP Pembimbing --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">No. WhatsApp Pembimbing</label>
                            <input type="text" name="advisor_phone" value="{{ old('advisor_phone') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700">
                            @error('advisor_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Bulan Magang --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Bulan Pelaksanaan Magang <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                @php
                                    $months = [
                                        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                                        '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                                        '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                                    ];
                                @endphp
                                @foreach($months as $num => $name)
                                    <label class="flex items-center justify-center gap-2 text-sm text-slate-700 bg-white border border-slate-300 rounded-lg py-2 cursor-pointer hover:bg-blue-50 hover:border-blue-300 transition-all duration-300 shadow-sm">
                                        <input type="checkbox" name="magang_months[]" value="{{ $num }}" class="rounded text-blue-600 focus:ring-blue-500 w-4 h-4 cursor-pointer" {{ is_array(old('magang_months')) && in_array($num, old('magang_months')) ? 'checked' : '' }}>
                                        {{ $name }}
                                    </label>
                                @endforeach
                            </div>
                            @error('magang_months') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        {{-- Surat Permohonan --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Upload Surat Permohonan (PDF) <span class="text-red-500">*</span></label>
                            <input type="file" name="document" accept=".pdf" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            <p class="text-xs text-slate-500 mt-1">Format harus .pdf, maksimal 2MB.</p>
                            @error('document') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 w-full md:w-auto text-lg">
                            Kirim Pendaftaran Magang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-public-layout>


