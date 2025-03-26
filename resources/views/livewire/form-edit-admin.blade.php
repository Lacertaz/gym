<div class="card bg-base-200 p-5 w-full max-w-sm mx-auto">
    <form wire:submit.prevent="save">
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Email</legend>
            <input type="email" class="input w-full" placeholder="Masukan Email Admin" wire:model="email" disabled />
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Nama Admin</legend>
            <input type="text" class="input w-full" placeholder="Masukan Nama Admin" wire:model="name" />
            @error('name')
                <div class="text-error ml-2">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Role</legend>
            <select class="select w-full" wire:model="role">
                @foreach ($roles as $role)
                    <option value="{{ $role->value }}" wire:key="{{ $role->value }}">{{ $role->label() }}</option>
                @endforeach
            </select>
            @error('role')
                <div class="text-error ml-2">{{ $message }}</div>
            @enderror
        </fieldset>

        <button type="submit" class="btn btn-primary w-full mt-4" wire:loading.attr="disabled">Simpan</button>
    </form>
</div>