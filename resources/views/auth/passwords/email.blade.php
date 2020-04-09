<x-app>

    <div class="h-full">
        <aside class="fixed h-screen bg-gray-100 p-2 w-2/5">
            <div class="w-full h-full terms p-8">
                <img src="/images/bawsala-logo.png" class="self-center" alt="">

            </div>
        </aside>
        <section class="ml-2/5 h-full flex items-center justify-center p-16">
            <div class="w-3/2">
                <h1 class="text-4xl mb-12 font-bold text-center">{{ __('Reset Password') }}</h1>

                <div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <label for="email"
                               class="input-label"
                        >{{ __('E-Mail Address') }}</label>

                        <input id="email"
                               type="email"
                               class="input w-full @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <div class="text-center">
                            <button type="submit" class="button is-primary">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-app>