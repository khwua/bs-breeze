<x-layout class="container py-5">
    <div class="row d-flex flex-column align-content-center">
        <div class="col-6">
            <div class="p-4 bg-white shadow-sm mb-3 rounded">
                <div class="mb-4 small text-black-50">
                    {{ __('Forgot your password? Let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                    <div>
                        <label for="email" class="form-label">
                            {{ __('Email') }}
                        </label>

                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}"
                               required autofocus>

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-sm btn-primary" type="submit">
                            {{ __('Email Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
