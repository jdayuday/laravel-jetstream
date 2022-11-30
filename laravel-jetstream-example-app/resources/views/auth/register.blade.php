
<!DOCTYPE html>

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="country" value="{{ __('Country') }}" />
                <select class ="block mt-1 w-full" id="country" name="country">
                    @foreach (\App\Models\Country::all() as $country)
                    <option value="{{  $country->id }},{{ $country->name }}"
                    >{{ $country->name }}

                </option>

                    
                @endforeach
                </select>

                     

            <div class="mt-4">
                <x-jet-label for="state" value="{{ __('Region / State') }}" />
                <select class ="block mt-1 w-full" id="state" name="state"> 
                </select>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    
            <script type="text/javascript">
                $(document).ready(function() {
                $('#country').change(function(event) {
                    var idCountry = this.value;
                    $('#state-dd').html('');
         
                    $.ajax({
                    url: "/api/fetch-state",
                    type: 'POST',
                    dataType: 'json',
                    data: {country_id: idCountry,_token:"{{ csrf_token() }}"},
                    success:function(response){
                        $('#state').html('<option value="">Select State</option>');
                        $.each(response.states,function(index, val){
                        $('#state').append('<option value="'+val.name+'"> '+val.name+' </option>')
                        });
                        $('#city').html('<option value="">Select City</option>');
                    }
                    })
                });
                $('#state-dd').change(function(event) {
                    var idState = this.value;
                    $('#city-dd').html('');
                    $.ajax({
                    url: "/api/fetch-cities",
                    type: 'POST',
                    dataType: 'json',
                    data: {state_id: idState,_token:"{{ csrf_token() }}"},
                    success:function(response){
                        $('#city-dd').html('<option value="">Select State</option>');
                        $.each(response.cities,function(index, val){
                        $('#city-dd').append('<option value="'+val.name+'"> '+val.name+' </option>')
                        });
                    }
                    })
                });
                });
            </script>


            <div class="mt-4">
                <x-jet-label for="city" value="{{ __('City') }}" />
                <x-jet-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus autocomplete="city" />
            </div>
    
            <div class="mt-4">
                <x-jet-label for="zip" value="{{ __('Zip code') }}" />
                <x-jet-input id="zip"  class="block mt-1 w-full" type="text" maxlength="4" name="zip" :value="old('zip')" required autofocus autocomplete="zip" />
            </div>

            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Address') }}" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address"   :value="old('address')" required autofocus autocomplete="address"/>
            </div>
          

            <div class="mt-4">
                <x-jet-label for="birthdate" value="{{ __('Birthdate') }}" />
                <x-jet-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" />
            </div>


            <div class="mt-4">
                <x-jet-label for="phonenumber" value="{{ __('Phone Number') }}" />
                <x-jet-input id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber" maxlength="11" :value="old('phonenumber')" required autofocus autocomplete="phonenumber" />
            </div>


            <div class="mt-4">
                <x-jet-label for="role" value="{{ __('Role') }}" />
                <select name="role" id="role" class="block mt-1 w-full">
                    <option value="1" >Admin</option>
                    <option value="2" >User</option>
                </select>
            </div>

            <script type="text/javascript">
                function getOption() {
                    selectElement = document.querySelector('#role');
                    output = selectElement.value;
                    document.querySelector('.output').textContent = output;
                }
            </script>

 


            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
