<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\LogMembership;
use App\LogMembershipStatusType;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $title = 'Dashboard';
        $user = Auth::user();

        if ($user->getRoleNames()->first() == 'user') {
            return view('dashboard_user', compact('title'));
        }

        return view('dashboard', compact('title'));
    }
}
