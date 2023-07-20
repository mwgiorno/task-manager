<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4 text-center">{{ __('Create an account') }}</h5>

                        <form action="{{ route('register') }}"  method="POST">
                            @csrf

                            <div class="mb-3">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                            </div>

                            <button type="submit" class="btn btn-primary form-control">{{ __('Register') }}</button>
                            
                            <p class="mt-2">
                                {{ __('Already registered?') }}
                                <a href="{{ route('register') }}">{{ __('Sign In') }}</a>
                            </p>
                        </form>  
                    </div>       
                </div>             
            </div>
        </div>
    </div>
</x-guest-layout>
