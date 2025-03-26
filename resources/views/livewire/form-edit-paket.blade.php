<div class="card bg-base-200 p-5 w-full max-w-sm mx-auto">
    <form wire:submit.prevent="save">
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Nama Paket</legend>
            <input type="text" class="input w-full" placeholder="Masukan Nama Paket" wire:model="name" />
            @error('name')
                <div class="text-error ml-2">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Harga</legend>
            <input type="number" class="input w-full" placeholder="Harga Paket" wire:model="price" min="0" />
            @error('price')
                <div class="text-error ml-2">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Durasi</legend>
            <select class="select w-full" wire:model="duration">
                <option value="">Pilih Durasi</option>
                @foreach ($duration_lists as $duration_list)
                    <option value="{{ $duration_list }}">{{ $duration_list }} Bulan</option>
                @endforeach
            </select>
            @error('duration')
                <div class="text-error ml-2">{{ $message }}</div>
            @enderror
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Tipe Paket</legend>
            <select class="select w-full" wire:model="member_type">
                <option value="">Pilih Tipe Member</option>
                @foreach ($member_type_lists as $member_type_list)
                    <option value="{{ $member_type_list->value }}">{{ $member_type_list->label() }}</option>
                @endforeach
            </select>
            @error('member_type')
                <div class="text-error ml-2">{{ $message }}</div>
            @enderror
        </fieldset>

        <button type="submit" class="btn btn-primary w-full mt-4">Simpan</button>
    </form>
</div>