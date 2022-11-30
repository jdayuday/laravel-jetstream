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
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'min:4','max:4'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date', 'max:255'],
            'phone_no' => ['required', 'string', 'min:11','max:11'],
            'role' => ['required', 'string', 'max:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        //dd($input);

        return User::create([
            'name' => $input['name'],
            'address' => $input['address'],
            'city' => $input['city'],
            'zip' => $input['zip'],
            'country' => $input['country'],
            'state' => $input['zip'],
            'birth_date' => $input['birth_date'],
            'phone_no' => $input['phone_no'],
            'role' => $input['role'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
