<div>
    <form action="{{ route('membership') }}" method="get" class="flex gap-2 mb-5">
        <label class="input">
            <i class="fas fa-search h-[1em] opacity-50"></i>
            <input type="search" id="keyword" name="keyword" placeholder="Cari Member" value="{{ $keyword }}" />
        </label>
    </form>

    <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-200 mb-5">
        <table class="table table-compact table-pin-rows">
            <thead>
                <tr>
                    <th><i class="fas fa-cogs"></i></th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No WhatsApp</th>
                    <th>Jenis Kelamin</th>
                    <th>Jenis Membership</th>
                    <th>Tanggal Join</th>
                    <th>Tanggal Expired</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($memberships as $membership)
                    <tr>
                        <td class="text-nowrap flex justify-center gap-1">
                            <a href="{{ route('membership.edit', $membership) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-error"
                                onclick="deleteMembership({{ $membership->id }}, '{{ $membership->user->name }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $membership->id }}"
                                action="{{ route('membership.destroy', $membership) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hidden">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <button class="btn btn-sm btn-info"
                                onclick="showResetModal({{ $membership->user->id }}, '{{ $membership->user->email }}')">
                                <i class="fas fa-key"></i>
                            </button>
                        </td>
                        <td class="text-nowrap">{{ $membership->user->name }}</td>
                        <td class="text-nowrap">{{ $membership->user->email }}</td>
                        <td class="text-nowrap">{{ $membership->no_whatsapp }}</td>
                        <td class="text-nowrap">{{ $membership->gender->label() }}</td>
                        <td class="text-nowrap">{{ $membership->member_type->label() }}</td>
                        <td class="text-nowrap">{{ $membership->join_date->format('d F Y') }}</td>
                        <td class="text-nowrap">{{ $membership->expired_date->format('d F Y') }}</td>
                        <td class="text-nowrap text-center">
                            {!! $membership->status_badge !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{ $memberships->links('vendor.pagination.daisy') }}
    </div>
</div>
