<x-layouts.app :title="$title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-2xl font-bold">
            Hi, {{ auth()->user()->name }}
        </h1>

        <div class="container max-w-xl">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr class="bg-white border-b border-gray-200 text-neutral-900">
                            <th scope="row" class="px-6 py-4">
                                Tanggal Join
                            </th>
                            <td class="px-6 py-4">
                                {{ auth()->user()->memberships->join_date->format('d F Y') }}
                            </td>
                        </tr>
                        <tr class="bg-white border-b border-gray-200 text-neutral-900">
                            <th scope="row" class="px-6 py-4">
                                Tanggal Expired
                            </th>
                            <td class="px-6 py-4">
                                {{ auth()->user()->memberships->expired_date->format('d F Y') }}
                            </td>
                        </tr>
                        <tr class="bg-white border-b border-gray-200 text-neutral-900">
                            <th scope="row" class="px-6 py-4">
                                Status
                            </th>
                            <td class="px-6 py-4">
                                {!! auth()->user()->memberships->status_badge !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-layouts.app>
