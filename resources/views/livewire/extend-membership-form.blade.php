<div class="card bg-base-200 p-5 w-full max-w-sm mx-auto">
    <form wire:submit.prevent="save">
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Member</legend>
            <select class="select w-full" wire:model="member_id" wire:change="getGymPackages($event.target.value)">
                <option value="" disabled selected>Pilih member</option>
                @foreach ($memberships as $membership)
                    <option value="{{ $membership->id }}">
                        {{ $membership->user->name }}
                    </option>
                @endforeach
            </select>
            @error('member_id')
                <div class="text-error ml-2">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Gym Paket</legend>
            <select class="select w-full" wire:model="gym_package_id">
                <option value="" disabled selected>Pilih gym paket</option>
                @foreach ($gym_packages as $gym_package)
                    <option value="{{ $gym_package->id }}">
                        {{ $gym_package->name }} ({{ number_format($gym_package->price, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>
            @error('gym_package_id')
                <div class="text-error ml-2">{{ $message }}</div>
            @enderror
        </fieldset>

        <button type="submit" class="btn btn-primary w-full mt-4">Simpan</button>
    </form>
</div>