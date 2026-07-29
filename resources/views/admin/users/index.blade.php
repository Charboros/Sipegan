<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-white tracking-tight">Konfigurasi Pengguna</h2>
    </x-slot>

    <div x-data="{ openEdit: false, editId: '', editUsername: '', editRole: '' }">
        <div class="max-w-7xl mx-auto mt-4 flex flex-col lg:flex-row gap-6">
            @include('admin.users.partials.create-user-form')
            
            @include('admin.users.partials.users-table')
        </div>

        @include('admin.users.partials.edit-user-modal')
    </div>
</x-app-layout>
