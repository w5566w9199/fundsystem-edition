<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'account' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'office' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'remark' => ['nullable', 'string',  'max:255'],
            'role' => ['required', 'string',  'max:255'],
            'ext' => ['required', 'string', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'account' => $input['account'],
            'office' => $input['office'],
            'phone' => $input['phone'],
            'phone' => $input['ext'],
            'remark' => $input['remark'],
            'role' => $input['role'],
            'ext' => $input['ext'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
