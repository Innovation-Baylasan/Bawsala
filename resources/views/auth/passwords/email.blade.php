<x-app>

    <div class="h-full">
        <aside class="fixed h-screen bg-gray-100 p-2 w-2/5">
            <div class="w-full h-full reset-password p-8">
                <img src="/images/bawsala-logo.png" class="self-center" alt="">

            </div>
        </aside>
        <section class="ml-2/5 h-full flex p-16">
            <div class="flex-1">
                <h1 class="text-4xl mb-12 text-gray-800 font-bold">{{ __('Reset Password') }}</h1>

                <div>
                    @if (session('status'))
                        <flash message="{{session('status') }}"></flash>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <label for="email"
                               class="input-label"
                        >{{ __('E-Mail Address') }}</label>

                        <input id="email"
                               type="email"
                               class="input w-full h-12 @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ old('email') }}"
                               required autocomplete="email" autofocus>

                        @error('email')
                        <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <button type="submit" class="button is-primary">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-app>