<x-app>

    <div class="h-full">
        <aside class="fixed h-screen bg-gray-100 p-2 w-2/5">
            <div class="w-full h-full reset-password p-8">
                <img src="/images/bawsala-logo.png" class="self-center" alt="">

            </div>
        </aside>
        <section class="ml-2/5 h-full p-4">
            <div>
                <h1 class="text-4xl mb-12 font-bold text-gray-800">{{ __('Reset Password') }}</h1>

                <div>
                    @if (session('status'))
                        <flash message="{{session('status') }}"></flash>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <label for="email"
                               class="input-label">{{ __('E-Mail Address') }}</label>

                        <input id="email"
                               type="email"
                               class="input w-full h-12  w-full @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ $email ?? old('email') }}"
                               required
                               autocomplete="email"
                               autofocus
                        >

                        @error('email')
                        <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="password"
                               class="input-label">{{ __('Password') }}</label>

                        <input id="password"
                               type="password"
                               class="input w-full h-12  w-full @error('password') is-invalid @enderror" name="password"
                               required
                               autocomplete="new-password"
                        >

                        @error('password')
                        <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <label for="password-confirm"
                               class="input-label">{{ __('Confirm Password') }}</label>

                        <input id="password-confirm"
                               type="password"
                               class="input w-full h-12  w-full"
                               name="password_confirmation"
                               required
                               autocomplete="new-password"
                        >


                        <button type="submit" class="button">
                            {{ __('Reset Password') }}
                        </button>

                    </form>
                </div>
            </div>
        </section>
    </div>
</x-app>
