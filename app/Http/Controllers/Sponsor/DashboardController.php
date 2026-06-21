<?php

namespace App\Http\Controllers\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $sponsorships = Sponsorship::with('event')
            ->where('sponsor_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        $stats = [
            'total'        => $sponsorships->count(),
            'acknowledged' => $sponsorships->where('acknowledged', true)->count(),
            'pending'      => $sponsorships->where('acknowledged', false)->count(),
            'total_amount' => $sponsorships->sum('amount'),
        ];

        return view('sponsor.dashboard', compact('sponsorships', 'stats'));
    }
}
