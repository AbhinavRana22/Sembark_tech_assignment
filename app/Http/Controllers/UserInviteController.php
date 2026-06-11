<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserInvitationMail;
use Illuminate\Support\Facades\URL;


class UserInviteController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        if ($user->hasRole('Member')) {
            abort(403);
        }

        $companies = [];

        if ($user->hasRole('Admin')) {
            $companies = Company::where('id', $user->company_id)->get();
        }
        $roles = Role::where('name','!=','Super Admin')->get();
        return view(
            'users.invite',
            compact('companies', 'roles')
        );
    }

    public function store(Request $request)
    {
         $request->validate([
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'company_id' => 'required'
        ]);

        $authUser = auth()->user();

        if ($authUser->hasRole('Member')) {
            abort(403);
        }

        $role = $request->role ?? 'Admin';
        $companyId = $request->company_id;

        $user = User::create([
            'name' => '',
            'email' => $request->email,
            'password' => null,
            'company_id' => $companyId,
        ]);

        $user->assignRole($role);

        $inviteUrl = URL::temporarySignedRoute(
            'invitation.accept',
            now()->addDays(7),
            [
                'email' => $user->email
            ]
        );

        Mail::to($user->email)
            ->send(new UserInvitationMail($user, $inviteUrl));

        return redirect()->route('short-urls.list')->with('success', 'User invited successfully');
    }

}
