<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\UserRole;
use App\Models\User;
use App\Services\AuditLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%")
                ->orWhere('email', 'like', "%{$s}%"))
            ->when($request->role, fn ($q, $r) => $q->where('role', $r))
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'role'    => 'required|in:user,organizer,volunteer,admin,sponsor',
            'blocked' => 'boolean',
        ]);

        $oldRole = $user->role->value;
        $user->update([
            'role'    => $validated['role'],
            'blocked' => $request->boolean('blocked'),
        ]);

        if ($oldRole !== $validated['role']) {
            AuditLogger::log(Auth::user(), "changed role of user #{$user->id} ({$user->email}) from {$oldRole} to {$validated['role']}");
        }

        if ($user->blocked) {
            AuditLogger::log(Auth::user(), "blocked user #{$user->id} ({$user->email})");
        }

        return redirect()->route('admin.users.index')->with('success', "User \"{$user->name}\" updated.");
    }

    public function toggleBlock(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot block yourself.');
        }

        $user->update(['blocked' => !$user->blocked]);
        $action = $user->blocked ? 'blocked' : 'unblocked';
        AuditLogger::log(Auth::user(), "{$action} user #{$user->id} ({$user->email})");

        return back()->with('success', "User \"{$user->name}\" has been {$action}.");
    }
}
