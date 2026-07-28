<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white leading-tight">
            Kelola FAQ (Pertanyaan yang Sering Diajukan)
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ showAddForm: false, editing: null }">
        
        <div class="mb-6 text-right">
            <button @click="showAddForm = !showAddForm" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition shadow-sm">
                <span x-show="!showAddForm">+ Tambah FAQ Baru</span>
                <span x-show="showAddForm">Batal Tambah</span>
            </button>
        </div>

        {{-- Form Tambah --}}
        <div x-show="showAddForm" style="display: none;" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6 p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Tambah FAQ Baru</h3>
            <form action="{{ route('faqs.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Pertanyaan</label>
                    <input type="text" name="question" class="w-full rounded border-slate-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500" required placeholder="Masukkan pertanyaan...">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Jawaban</label>
                    <textarea name="answer" rows="4" class="w-full rounded border-slate-300 px-3 py-2 focus:border-blue-500 focus:ring-blue-500" required placeholder="Masukkan jawaban..."></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Status Aktif</label>
                        <div class="mt-2 flex items-center">
                            <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 w-5 h-5">
                            <span class="ml-2 text-sm text-slate-600">Tampilkan ke Publik</span>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition shadow-sm">
                        Simpan FAQ
                    </button>
                </div>
            </form>
        </div>

        {{-- Daftar FAQ --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 bg-slate-50 border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-800">Daftar FAQ</h3>
            </div>
            
            <div class="overflow-x-auto p-6 space-y-4">
                @if($faqs->isEmpty())
                    <p class="text-slate-500 text-center py-4">Belum ada FAQ yang ditambahkan.</p>
                @endif

                @foreach($faqs as $faq)
                <div class="border border-slate-200 rounded-lg p-4">
                    {{-- Tampilan Display --}}
                    <div x-show="editing !== {{ $faq->id }}">
                        <div class="flex justify-between items-start gap-4 flex-col md:flex-row">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2 flex-wrap">
                                    <h4 class="font-bold text-slate-800">{{ $faq->question }}</h4>
                                    @if($faq->is_active)
                                        <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase">Aktif</span>
                                    @else
                                        <span class="bg-slate-100 text-slate-600 text-[10px] font-bold px-2 py-0.5 rounded uppercase">Nonaktif</span>
                                    @endif
                                </div>
                                <p class="text-slate-600 text-sm whitespace-pre-line">{{ $faq->answer }}</p>
                            </div>
                            <div class="flex gap-2 shrink-0 w-full md:w-auto justify-end">
                                <button @click="editing = {{ $faq->id }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold bg-blue-50 px-3 py-1.5 rounded transition">Edit</button>
                                <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold bg-red-50 px-3 py-1.5 rounded transition">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Form Edit --}}
                    <div x-show="editing === {{ $faq->id }}" style="display: none;" class="bg-slate-50 -m-4 p-4 rounded-lg border-b border-slate-200">
                        <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Pertanyaan</label>
                                <input type="text" name="question" value="{{ $faq->question }}" class="w-full rounded border-slate-300 px-3 py-2 focus:border-blue-500 text-sm" required>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Jawaban</label>
                                <textarea name="answer" rows="3" class="w-full rounded border-slate-300 px-3 py-2 focus:border-blue-500 text-sm" required>{{ $faq->answer }}</textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div class="col-span-2">
                                    <label class="block text-sm font-semibold text-slate-700 mb-1">Status Aktif</label>
                                    <div class="mt-2 flex items-center">
                                        <input type="checkbox" name="is_active" value="1" {{ $faq->is_active ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 w-4 h-4">
                                        <span class="ml-2 text-sm text-slate-600">Tampilkan ke Publik</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-2 justify-end">
                                <button type="button" @click="editing = null" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-1.5 px-4 rounded transition text-sm">Batal</button>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1.5 px-4 rounded transition text-sm">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
