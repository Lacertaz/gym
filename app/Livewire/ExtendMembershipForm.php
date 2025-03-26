<?php

namespace App\Livewire;

use App\LogMembershipStatusType;
use App\Models\GymPackage;
use App\Models\LogMembership;
use App\Models\Membership;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ExtendMembershipForm extends Component
{
    #[Validate('required', message: 'Silahkan pilih member')]
    #[Validate('exists:memberships,id', message: 'Member tidak ditemukan')]
    public string $member_id;

    #[Validate('required', message: 'Paket gym harus dipilih')]
    #[Validate('exists:gym_packages,id', message: 'Paket gym tidak valid')]
    public string $gym_package_id;

    public object $memberships;

    public $gym_packages = [];

    public function mount($memberships)
    {
        $this->gym_package_id = '';
        $this->memberships = $memberships;

        if (Auth::user()->hasRole('user')) {
            $this->member_id = Auth::user()->memberships->id;
            $this->getGymPackages($this->member_id);
        } else {
            $this->member_id = '';
            $this->gym_packages = [];
        }

    }

    public function getGymPackages($member_id)
    {
        $membership = Membership::find($member_id);

        if ($membership) {
            $this->gym_packages = GymPackage::where('member_type', $membership->member_type->value)->get();
        } else {
            $this->gym_packages = collect();
        }

    }

    public function updatedMemberId()
    {
        $this->getGymPackages($this->member_id);
    }

    public function save()
    {
        $validated = $this->validate();

        $membership = Membership::findOrFail($validated['member_id']);
        $gym_package = GymPackage::findOrFail($validated['gym_package_id']);

        LogMembership::create([
            'membership_id' => $validated['member_id'],
            'gym_package_id' => $validated['gym_package_id'],
            'gym_package_name' => $gym_package->name,
            'price' => $gym_package->price,
            'duration' => $gym_package->duration,
            'member_type' => $membership->member_type->value,
            'start_date' => null,
            'end_date' => null,
            'status' => LogMembershipStatusType::UNPAID->value,
        ]);

        session()->flash('success', 'Request Extend Membership berhasil dibuat');
        $this->redirect(route('extend-membership'));
    }

    public function render()
    {
        return view('livewire.extend-membership-form');
    }
}
