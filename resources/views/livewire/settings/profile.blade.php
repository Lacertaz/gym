<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your account\'s profile information.')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input type="text" id="email" wire:model="email" class="input input-warning cursor-not-allowed" readonly
                    required />
            </div>

            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Lengkap</label>
                <input type="text" id="name" wire:model="name" class="input input-warning" required />
            </div>

            @if(auth()->user()->hasRole('user'))
                <div class="mb-6">
                    <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 ">Jenis Kelamin</label>

                    <select class="select select-warning" wire:model="gender">
                        <option disabled selected>Pick Jenis Kelamin</option>
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="no_whatsapp" class="block mb-2 text-sm font-medium text-gray-900 ">No WhatsaApp</label>
                    <input type="tel" id="no_whatsapp" wire:model="no_whatsapp" class="input input-warning" required />
                </div>
            @endif

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Data berhasil disimpan.') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>