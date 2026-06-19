<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteUserRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    public function create()
    {
        if (!in_array(auth()->user()->role, ['superadmin', 'admin'])) {
            abort(403);
        }

        return view('invitations.create');
    }

    public function store(InviteUserRequest $request)
    {
        $data = $request->validated();

        if (auth()->user()->role === 'superadmin') {
            $company = Company::create(['name' => $data['company_name']]);
            $companyId = $company->id;
        } else {
            $companyId = auth()->user()->company_id;
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'company_id' => $companyId,
        ]);

        return redirect()->route('dashboard')->with('status', 'User invited successfully.');
    }
}
