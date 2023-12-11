<x-layout class="container py-5">
    <div class="row d-flex flex-column align-content-center">
        <div class="col-4">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="p-4 bg-white shadow-sm mb-3 rounded">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email Address --}}
                    <div>
                        <label for="email" class="form-label">
                            {{ __('Email') }}
                        </label>

                        <input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div class="mt-4">
                        <label for="password" class="form-label">
                            {{ __('Password') }}
                        </label>

                        <input type="password" id="password" class="form-control" name="password" autocomplete="current-password" required>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Remember Me --}}
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="shadow-sm" name="remember">
                            <span class="ms-2 text-secondary user-select-none">
                                {{ __('Remember me') }}
                            </span>
                        </label>
                    </div>

                    <div class="d-flex justify-content-between mt-4 pt-4 border-top">
                        <a class="text-decoration-none fw-bold" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>

                        <button class="btn btn-sm btn-primary" type="submit">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
