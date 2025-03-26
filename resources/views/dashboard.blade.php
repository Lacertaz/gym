<x-layouts.app :title="$title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div class="relative aspect-video overflow-hidden rounded-xl border ">
                <livewire:card-dashboard type="total_member_aktif" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border ">
                <livewire:card-dashboard type="total_member_non_aktif" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border ">
                <livewire:card-dashboard type="total_member_new" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border ">
                {{-- <x-card-dashboard title="TOTAL REQUEST EXTEND MEMBERSHIP" :value="$total_request_extend_membership"
                    icon="fas fa-users" /> --}}
                <livewire:card-dashboard type="total_request_extend_membership" />
            </div>
        </div>
    </div>
</x-layouts.app>
