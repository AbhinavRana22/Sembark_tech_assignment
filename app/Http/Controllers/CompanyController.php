<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserInvitationMail;
use Illuminate\Support\Facades\URL;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies',
            'email' => 'required|email|unique:users,email'
        ]);

        $company = Company::create([
            'name' => $request->name
        ]);
        \Log::info($company->id);
        $this->createCompanyUser($request, $company->id);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $company = Company::findOrFail($id);
        // return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $company = Company::findOrFail($id);
        // $company->update([
        //     'name' => $request->name
        // ]);
        // return redirect()
        //     ->route('companies.index')
        //     ->with('success', 'Company updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $company = Company::findOrFail($id);
        // $company->delete();
        // return redirect()
        //     ->route('companies.index')
        //     ->with('success', 'Company deleted');
    }

    public function createCompanyUser($request, $company_id)
    {
        $authUser = auth()->user();

        if ($authUser->hasRole('Member')) {
            abort(403);
        }

        $role = 'Admin';
        $companyId = $company_id;

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
    }
}
