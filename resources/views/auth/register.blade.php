@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center" style="margin-top: 80px">
    <div class="col-lg-5">
        <main class="form-registration">
            <center>
            <img src="{{ asset('img/stimata.png') }}" alt="madarasah" height="200" width="200" style="margin-bottom: 20px">
            </center>
            <h1 class="h3 mb-2 fw-bold text-center">Inventarisasi Sarana Prasarana</h1>
            <h3 class="h3 mb-3 fw-normal text-center">STMIK PPKIA PRADNYA PARAMITA</h3>
            <h2 class="h3 mb-3 text-center">Malang</h2>

            <form action="{{ url('/register/create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                @if (Session::has('status'))
                    <div class="alert alert-danger" role="alert">{{ Session::get('message') }}</div>
                @endif
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" required>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <h6 class="text-danger mt-2" id="removable">Password Minimal 8 Karakter !!</h6>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn col-md-9 disabled btn-danger" id="btn-register">
                            {{ __('Register') }}
                        </button>

                        {{-- @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif --}}
                    </div>
                </div>
            </form>
                <div style="display: flex; width: 100%; justify-content: center; align-items: center;">
                <div style="width: fit-content; margin-top: 10px">
                    <h4>Sudah Punya Akun? <a href="/login">Login</a></h4>
                </div>
                </div>
        </main>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script>
    let pass = document.querySelector('#password');
    pass.addEventListener("input", function () {
        let totalInput = pass.value.length;
        if(totalInput >= 8) {
            document.querySelector('#removable').classList.add('d-none');
            document.querySelector('#btn-register').classList.add('btn-primary');
            document.querySelector('#btn-register').classList.remove('disabled', 'btn-danger');
        } else {
            document.querySelector('#btn-register').classList.add('disabled', 'btn-danger');
            document.querySelector('#btn-register').classList.remove('btn-primary');
            document.querySelector('#removable').classList.remove('d-none');
        }
        console.log(totalInput);
    });
</script>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
