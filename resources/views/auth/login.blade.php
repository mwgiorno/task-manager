<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4 text-center">{{ __('Log in to your account') }}</h5>

                        <form action="{{ route('login') }}"  method="POST">
                            @csrf

                            <div class="mb-3">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="password" name="password" class="form-control @error('email') is-invalid @enderror" placeholder="Password" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember_me" class="form-check-input" id="remember_me">
                                <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                            </div>

                            <button type="submit" class="btn btn-primary form-control">Log In</button>
                            
                            <p class="mt-2">
                                Do not have an account?
                                <a href="{{ route('register') }}">Register</a>
                            </p>
                        </form>  
                    </div>       
                </div>             
            </div>
        </div>
    </div>
</x-guest-layout>
