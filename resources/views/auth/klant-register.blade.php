<x-guest-layout>
    <form method="POST" action="{{ route('klant.register') }}" class="space-y-6">
        @csrf

        <!-- Naam -->
        <div>
            <x-input-label for="naam" :value="__('Naam')" />
            <x-text-input id="naam" class="block mt-1 w-full" type="text" name="naam" :value="old('naam')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('naam')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Telefoon -->
        <div class="mt-4">
            <x-input-label for="telefoon" :value="__('Telefoon')" />
            <x-text-input id="telefoon" class="block mt-1 w-full" type="text" name="telefoon" :value="old('telefoon')" />
            <x-input-error :messages="$errors->get('telefoon')" class="mt-2" />
        </div>

        <!-- Adres -->
        <div class="mt-4">
            <x-input-label for="adres" :value="__('Adres')" />
            <x-text-input id="adres" class="block mt-1 w-full" type="text" name="adres" :value="old('adres')" />
            <x-input-error :messages="$errors->get('adres')" class="mt-2" />
        </div>

        <!-- Postcode -->
        <div class="mt-4">
            <x-input-label for="postcode" :value="__('Postcode')" />
            <x-text-input id="postcode" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')" />
            <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
        </div>

        <!-- Plaats -->
        <div class="mt-4">
            <x-input-label for="plaats" :value="__('Plaats')" />
            <x-text-input id="plaats" class="block mt-1 w-full" type="text" name="plaats" :value="old('plaats')" />
            <x-input-error :messages="$errors->get('plaats')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Wachtwoord')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Bevestig Wachtwoord')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('klant.login') }}">
                {{ __('Al geregistreerd?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Registreren') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> 