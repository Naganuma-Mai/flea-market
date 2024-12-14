<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Contracts\CreatesNewAdmins;

class CreateNewAdmin implements CreatesNewAdmins
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered admin.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Admin
    {
        Validator::make($input, [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(Admin::class),
            ],
            'password' => ['required'],
        ])->validate();

        return Admin::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
