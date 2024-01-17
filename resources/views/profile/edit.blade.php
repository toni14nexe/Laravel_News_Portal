<x-app-layout>
    <x-slot name="header">
        <h2
            class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
        >
            {{ __("Profile") }}
        </h2>
    </x-slot>

    @include("profile.partials.update-profile-information-form")
    @include("profile.partials.update-password-form")
    
</x-app-layout>
