<x-layout class="container py-5">
    <div class="row d-flex flex-column align-content-center">
        <div class="col-6">
            <div class="p-4 bg-white shadow-sm mb-3 rounded">
                <div class="mb-4 small text-black-50">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    {{-- Password --}}
                    <div>
                        <label for="password" class="form-label">
                            {{ __('Password') }}
                        </label>

                        <input type="password" id="password" class="form-control" name="password"
                               autocomplete="current-password" required>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="d-flex justify-content-between mt-4 pt-4 border-top">
                        <button class="btn btn-sm btn-primary" type="submit">
                            {{ __('Confirm') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
