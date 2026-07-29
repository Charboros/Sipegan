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
                            <div class="flex items-center justify-center gap-3">
                                <button @click="openEdit = true; editId = '{{ $user->id }}'; editUsername = '{{ addslashes($user->username) }}'; editRole = '{{ $user->role }}'" class="text-blue-500 hover:text-blue-700 font-semibold text-xs">Edit</button>
                                
                                @if($user->id !== auth()->id())
                                <form action="{{ route('konfigurasi.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-xs">Hapus</button>
                                </form>
                                @else
                                <span class="text-slate-400 text-xs italic">Akun Anda</span>
                                @endif
                            </div>
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
