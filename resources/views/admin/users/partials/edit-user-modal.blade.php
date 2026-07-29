<!-- Edit Modal (Single Dynamic Modal) -->
<div x-show="openEdit" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
        <!-- Background overlay -->
        <div x-show="openEdit" @click="openEdit = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" style="background-color: rgba(0, 0, 0, 0.5);" aria-hidden="true"></div>

        <!-- Modal panel -->
        <div x-show="openEdit" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 w-full sm:max-w-md p-6">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800" id="modal-title">Edit User</h3>
                <button type="button" @click="openEdit = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <span class="sr-only">Tutup</span>
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <!-- Body -->
            <form :action="`/users/${editId}`" method="POST" class="space-y-4 text-left">
                @csrf
                @method('PATCH')
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama User</label>
                    <input type="text" name="username" x-model="editUsername" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Role</label>
                    <select name="role" x-model="editRole" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow" required>
                        <option value="petugas">Petugas</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <div x-data="{ editShowPassword: false, passEdit: '' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Password Baru (Opsional)</label>
                    <div class="relative">
                        <input :type="editShowPassword ? 'text' : 'password'" x-model="passEdit" name="password" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow pr-10">
                        <button type="button" x-show="passEdit.length > 0" @click="editShowPassword = !editShowPassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors" style="display: none;">
                            <template x-if="!editShowPassword">
                                <x-icons.eye />
                            </template>
                            <template x-if="editShowPassword">
                                <x-icons.eye-slash />
                            </template>
                        </button>
                    </div>
                </div>
                
                <div x-data="{ editShowPasswordConf: false, passEditConf: '' }">
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input :type="editShowPasswordConf ? 'text' : 'password'" x-model="passEditConf" name="password_confirmation" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow pr-10">
                        <button type="button" x-show="passEditConf.length > 0" @click="editShowPasswordConf = !editShowPasswordConf" class="absolute inset-y-0 right-0 px-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors" style="display: none;">
                            <template x-if="!editShowPasswordConf">
                                <x-icons.eye />
                            </template>
                            <template x-if="editShowPasswordConf">
                                <x-icons.eye-slash />
                            </template>
                        </button>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-8 pt-2 grid grid-cols-2 gap-4">
                    <button type="button" @click="openEdit = false" class="w-full inline-flex justify-center items-center rounded-xl border border-slate-200 px-4 py-2.5 bg-white text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="w-full inline-flex justify-center items-center rounded-xl border border-transparent px-4 py-2.5 bg-blue-600 text-sm font-bold text-white hover:bg-blue-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
