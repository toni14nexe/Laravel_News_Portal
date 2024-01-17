<section>
    <header>
        <span>
            {{ __("Profile Information") }}
            @if (session("status") === "profile-updated")
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
            {{ __("Update your account's profile information and email address.") }}
        </span>
        <br><br>

        <form
            id="send-verification"
            method="post"
            action="{{ route("verification.send") }}"
        >
            @csrf
        </form>

        <form
            method="post"
            action="{{ route("profile.update") }}"
        >
            @csrf
            @method("patch")

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <br>
                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                    autocomplete="name"
                />
                <br>
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <br>
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <br>
                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    :value="old('email', $user->email)"
                    required
                    autocomplete="username"
                />
                <br>
                <x-input-error
                    class="color-red"
                    :messages="$errors->get('email')"
                />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <br>
                        <span>
                            {{ __("Your email address is unverified.") }}

                            <button
                                form="send-verification"
                                class="btn-green"
                            >
                                {{ __("Click here to re-send the verification email.") }}
                            </button>
                        </span>

                        @if (session("status") === "verification-link-sent")
                            <br>
                            <span
                                class="btn-green"
                            >
                                {{ __("A new verification link has been sent to your email address.") }}
                            </span>
                        @endif
                    </div>
                @endif
            </div>

            <div class="profile-settings-btn-div">
                <x-primary-button class="btn-green">{{ __("Save") }}</x-primary-button>
            </div>
        </form>
    </header>
</section>
