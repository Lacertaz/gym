<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogMembershipRequest;
use App\Http\Requests\UpdateLogMembershipRequest;
use App\LogMembershipStatusType;
use App\MembershipStatus;
use App\Models\LogMembership;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Extend Membership';
        $keyword = $request->keyword ?? null;

        $extend_memberships = LogMembership::with([
            'membership',
            'membership.user',
            'gymPackage',
        ])
            ->orderBy('status', 'asc')
            ->orderBy('start_date', 'desc')
            ->whereHas('membership.user', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->keyword.'%');
            });

        if (Auth::user()->role == 'user') {
            $extend_memberships->where('membership_id', Auth::user()->memberships->id);
        }

        $extend_memberships = $extend_memberships->paginate(5)->withQueryString();

        return view('pages.extend_membership.main', compact('title', 'keyword', 'extend_memberships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Extend Membership';

        $memberships = Membership::leftJoin('users', 'users.id', '=', 'memberships.user_id')
            ->select('memberships.*', 'users.name')
            ->orderBy('users.name', 'asc');

        if (Auth::user()->hasRole('user')) {
            $memberships->where('users.id', Auth::user()->id);
        }

        $memberships = $memberships->get();

        return view('pages.extend_membership.form', compact('title', 'memberships'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLogMembershipRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LogMembership $logMembership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogMembership $logMembership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogMembershipRequest $request, LogMembership $logMembership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogMembership $logMembership)
    {
        //
    }

    public function proses_approve_reject($id, $type)
    {
        if ($id == '') {
            return response()->json([
                [
                    'message' => 'ID tidak ditemukan',
                ],
            ], 404);
        }

        if (! in_array($type, ['approve', 'reject'])) {
            return response()->json([
                'message' => 'Status tidak ditemukan',
            ], 404);
        }

        $log_membership = LogMembership::find($id);

        if (! $log_membership) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $membership_id = $log_membership->membership_id;
        $duration = $log_membership->duration;
        $expired_date = $log_membership->membership->expired_date;
        if ($expired_date <= now() && $type == 'approve') {
            $start_date = now();
            $end_date = now()->addMonths($duration);

            Membership::where('id', $membership_id)->update([
                'expired_date' => $end_date,
                'status' => MembershipStatus::ACTIVE->value,
            ]);

            $log_membership->start_date = $start_date;
            $log_membership->end_date = $end_date;
        } elseif ($expired_date > now() && $type == 'approve') {
            $start_date = $expired_date;
            $end_date = $expired_date->addMonths($duration);
            Membership::where('id', $membership_id)->update([
                'expired_date' => $end_date,
                'status' => MembershipStatus::ACTIVE->value,
            ]);

            $log_membership->start_date = $start_date;
            $log_membership->end_date = $end_date;
        }

        $log_membership->status = ($type == 'approve') ? LogMembershipStatusType::PAID->value : LogMembershipStatusType::REJECT->value;
        $log_membership->save();

        return response()->json([
            'message' => 'Berhasil',
        ], 200);
    }
}
