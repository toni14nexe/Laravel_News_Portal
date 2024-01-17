<section>
    <header>
        <span>
            {{ __("Update Password") }}
            @if (session("status") === "password-updated")
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => (show = false), 2000)"
                    class="color-green"
                >
                    {{ __(" - Saved") }}
                </span>
            @endif
        </span>
        <br><br>
        <span>
            {{ __("Ensure your account is using a long, random password to stay secure.") }}
        </span>
        <br><br>

        <form
            method="post"
            action="{{ route("password.update") }}"
        >
            @csrf
            @method("put")

            <div>
                <x-input-label
                    for="update_password_current_password"
                    :value="__('Current Password')"
                />
                <br>
                <x-text-input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    autocomplete="current-password"
                />
                <br>
                <x-input-error
                    class="color-red"
                    :messages="$errors->updatePassword->get('current_password')"
                />
            </div>

            <div>
                <br>
                <x-input-label
                    for="update_password_password"
                    :value="__('New Password')"
                />
                <br>
                <x-text-input
                    id="update_password_password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                />
                <br>
                <x-input-error
                    class="color-red"
                    :messages="$errors->updatePassword->get('password')"
                />
            </div>

            <div>
                <br>
                <x-input-label
                    for="update_password_password_confirmation"
                    :value="__('Confirm Password')"
                />
                <br>
                <x-text-input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                />
                <br>
                <x-input-error
                    class="color-red"
                    :messages="$errors->updatePassword->get('password_confirmation')"
                />
            </div>

            <div class="profile-settings-btn-div">
                <x-primary-button class="btn-green">{{ __("Save") }}</x-primary-button>
            </div>
        </form>
    </header>
</section>
