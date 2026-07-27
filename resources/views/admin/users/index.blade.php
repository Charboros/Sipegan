<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white tracking-tight">Konfigurasi Pengguna</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-4 flex flex-col lg:flex-row gap-6">
        
        {{-- Form Tambah User --}}
        <div class="w-full lg:w-1/3">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Tambah Petugas Baru</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('konfigurasi.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Username</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500" required>
                            @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                            <input type="password" name="password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500" required>
                            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Role</label>
                            <select name="role" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-blue-500" required>
                                <option value="petugas">Petugas</option>
                                <option value="admin">Administrator</option>
                            </select>
                            @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="w-full px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-sm transition">
                            Simpan Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Daftar User --}}
        <div class="w-full lg:w-2/3">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800">Daftar Akun Sistem</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-4">Username</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach($users as $user)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-slate-800 block">{{ $user->username }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->role == 'admin')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-purple-100 text-purple-800">Admin</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-100 text-blue-800">Petugas</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('konfigurasi.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-xs">Hapus</button>
                                    </form>
                                    @else
                                    <span class="text-slate-400 text-xs italic">Akun Anda</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($users->hasPages())
                <div class="p-6 border-t border-slate-100">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>
