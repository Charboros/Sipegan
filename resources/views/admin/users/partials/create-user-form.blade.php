<div class="w-full lg:w-1/3">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-6">Tambah User Baru</h3>
            <form action="{{ route('konfigurasi.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama User</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                    @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Role</label>
                    <select name="role" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                        <option value="petugas">Petugas</option>
                        <option value="admin">Administrator</option>
                    </select>
                    @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ showPassword: false, password: '' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" x-model="password" name="password" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors pr-10" required>
                        <button type="button" x-show="password.length > 0" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors" style="display: none;">
                            <template x-if="!showPassword">
                                <x-icons.eye />
                            </template>
                            <template x-if="showPassword">
                                <x-icons.eye-slash />
                            </template>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div x-data="{ showPasswordConf: false, passwordConf: '' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password</label>
                    <div class="relative">
                        <input :type="showPasswordConf ? 'text' : 'password'" x-model="passwordConf" name="password_confirmation" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors pr-10" required>
                        <button type="button" x-show="passwordConf.length > 0" @click="showPasswordConf = !showPasswordConf" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors" style="display: none;">
                            <template x-if="!showPasswordConf">
                                <x-icons.eye />
                            </template>
                            <template x-if="showPasswordConf">
                                <x-icons.eye-slash />
                            </template>
                        </button>
                    </div>
                </div>

                <button type="submit" class="mt-4 w-full px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-sm transition">
                    Tambah User
                </button>
            </form>
        </div>
    </div>
</div>
