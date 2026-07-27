<x-public-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white tracking-tight">Pendaftaran Penelitian SIPEGAN</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 md:p-8 border-b border-slate-100">
                <h3 class="text-lg md:text-xl font-bold text-slate-800">Form Pendaftaran Penelitian (Riset)</h3>
                <p class="text-sm text-slate-500 mt-1">Silakan lengkapi data diri Anda dengan benar.</p>
            </div>

            <div class="p-6 md:p-8">
                <form action="{{ route('public.store_penelitian') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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

                        {{-- Asal Sekolah / Perguruan Tinggi --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Asal Instansi/PT <span class="text-red-500">*</span></label>
                            <input type="text" name="institution" value="{{ old('institution') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('institution') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Program Studi / Kejuruan --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Program Studi / Kejuruan <span class="text-red-500">*</span></label>
                            <input type="text" name="study_program" value="{{ old('study_program') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('study_program') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Judul Penelitian --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Penelitian <span class="text-red-500">*</span></label>
                            <input type="text" name="research_title" value="{{ old('research_title') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('research_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Waktu Pelaksanaan --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Mulai Pelaksanaan <span class="text-red-500">*</span></label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            @error('start_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        
                        {{-- Surat Permohonan --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Upload Surat Permohonan (PDF) <span class="text-red-500">*</span></label>
                            <input type="file" name="document" accept=".pdf" class="w-full px-4 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-300 shadow-sm text-slate-700" required>
                            <p class="text-xs text-slate-500 mt-1">Format harus .pdf, maksimal 2MB.</p>
                            @error('document') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 w-full md:w-auto text-lg">
                            Kirim Pendaftaran Penelitian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-public-layout>


