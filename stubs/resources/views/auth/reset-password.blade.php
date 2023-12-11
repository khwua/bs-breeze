<x-layout class="container py-5">
    <div class="row d-flex flex-column align-content-center">
        <div class="col-4">
            <div class="p-4 bg-white shadow-sm mb-3 rounded">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    {{-- Password Reset Token --}}
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email Address --}}
                    <div>
                        <label for="email" class="form-label">
                            {{ __('Email') }}
                        </label>

                        <input type="email" id="email" class="form-control" name="email"
                               value="{{ old('email', $request->email) }}" required autofocus>

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div class="mt-4">
                        <label for="password" class="form-label">
                            {{ __('Password') }}
                        </label>

                        <input type="password" id="password" class="form-control" name="password" required>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mt-4">
                        <label for="password_confirmation" class="form-label">
                            {{ __('Confirm Password') }}
                        </label>

                        <input type="password" id="password_confirmation" class="form-control"
                               name="password_confirmation" required>

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="d-flex justify-content-end mt-4 pt-4 border-top">
                        <button class="btn btn-sm btn-primary" type="submit">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
