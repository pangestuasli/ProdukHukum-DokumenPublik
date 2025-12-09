@extends('layouts.auth.app')

@section('content')
    <div class="bg-white shadow border-0 rounded p-4 w-100 fmxw-500">

        <div class="text-center mb-4">
            <h1 class="h3">Sign in to your account</h1>
        </div>

        {{-- Error handling --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM LOGIN --}}
        <form action="{{ route('login') }}" method="POST" class="mt-4">
            @csrf

            {{-- Email --}}
            <div class="form-group mb-4">
                <label for="email">Your Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="mdi mdi-email"></i>
                    </span>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        placeholder="example@company.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>
            </div>

            {{-- Password --}}
            <div class="form-group mb-4">
                <label for="password">Your Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="mdi mdi-lock"></i>
                    </span>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Password"
                        required
                    >
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
            </div>

            {{-- Button --}}
            <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </form>

        <div class="d-flex justify-content-center align-items-center mt-4">
            <span class="fw-normal">
                Not registered?
                <a href="#" class="fw-bold">Create account</a>
            </span>
        </div>
    </div>
@endsection
