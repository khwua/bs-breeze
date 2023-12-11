<x-layout class="container py-5">
    <div class="row d-flex flex-column align-content-center">
        <div class="col-4">
            <div class="p-4 bg-white shadow-sm mb-3 rounded">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Username --}}
                    <div>
                        <label for="name" class="form-label">
                            {{ __('Name') }}
                        </label>

                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required>

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email Address --}}
                    <div class="mt-4">
                        <label for="email" class="form-label">
                            {{ __('Email') }}
                        </label>

                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div class="mt-4">
                        <label for="password" class="form-label">
                            {{ __('Password') }}
                        </label>

                        <input type="password" id="password" class="form-control" name="password" autocomplete="new-password">

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mt-4">
                        <label for="password_confirmation" class="form-label">
                            {{ __('Confirm Password') }}
                        </label>

                        <input type="password" id="password_confirmation" class="form-control"
                               name="password_confirmation" autocomplete="new-password">

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="d-flex justify-content-between mt-4 pt-4 border-top">
                        <a class="text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <button class="btn btn-sm btn-primary" type="submit">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
