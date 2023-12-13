<x-layout class="container py-5" :title="__('Edit your profile')">

    @if(session('status'))
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
        </svg>

        <div
            class="alert alert-success d-flex align-items-center position-sticky sticky-top alert-dismissible fade show"
            role="alert" style="height: 5rem;">
            <svg width="10px" class="bi flex-shrink-0 me-2" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill"/>
            </svg>
            <div>
                {{ __('Your profile has been updated successfully.') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row d-flex flex-column align-content-center">
        <div class="col-6">
            <div class="p-4 bg-white shadow-sm mb-3 rounded">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="email" class="form-label">
                            {{ __('Email') }}
                        </label>

                        <input type="text" id="email" class="form-control" name="email"
                               value="{{ old('email', $user->email) }}" required>

                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <label for="name" class="form-label">
                            {{ __('Name') }}
                        </label>

                        <input type="text" id="name" class="form-control" name="name"
                               value="{{ old('email', $user->name) }}" required>

                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>


                    <div class="d-flex justify-content-end mt-4 pt-4 border-top">
                        <button class="btn btn-sm btn-primary" type="submit">
                            {{ __('Save Updates') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <div class="col-6 d-flex justify-content-end">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#DeleteAccount">
                {{ __('Delete My Account') }}
            </button>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="DeleteAccount"
             tabindex="-1" aria-labelledby="DeleteAccountForm" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger" id="DeleteAccountForm">
                            {{ __('Delete my account') }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="text-danger">
                                {{ __('warning! This process cannot be undone.') }}
                            </div>
                            <div class="text-danger">
                                {{ __(' Enter your password to continue') }}
                            </div>
                            <div class="mt-4">
                                <label for="password" class="form-label">
                                    {{ __('Password') }}
                                </label>

                                <input type="password" id="password" class="form-control" name="password" required>

                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2"/>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="d-flex justify-content-end mt-4 pt-4">
                                <button class="btn btn-sm btn-danger" type="submit">
                                    {{ __('Delete my account') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
