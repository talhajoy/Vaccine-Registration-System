@extends('layouts.app')

@section('title', 'Welcome - Vaccine Registration System')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron bg-white p-5 rounded shadow-sm text-center">
                <h1 class="display-4">
                    <i class="fas fa-shield-virus text-primary me-3"></i>
                    Vaccine Registration System
                </h1>
                <p class="lead">Register for COVID-19 vaccination quickly and safely</p>
                <hr class="my-4">
                <p>Get vaccinated to protect yourself and your community. Register now to schedule your vaccination appointment.</p>

                @guest
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <a class="btn btn-primary btn-lg me-md-2" href="{{ route('register') }}" role="button">
                        <i class="fas fa-user-plus me-2"></i>Register Now
                    </a>
                    <a class="btn btn-outline-primary btn-lg" href="{{ route('login') }}" role="button">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                </div>
                @else
                <a class="btn btn-primary btn-lg" href="{{ route('dashboard') }}" role="button">
                    <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                </a>
                @endguest
            </div>

            <div class="row mt-5">
                <div class="col-md-4 text-center">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-calendar-check fa-3x text-primary mb-3"></i>
                            <h5 class="card-title">Easy Scheduling</h5>
                            <p class="card-text">Schedule your vaccination appointment at your preferred time and location.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-hospital fa-3x text-success mb-3"></i>
                            <h5 class="card-title">Multiple Centers</h5>
                            <p class="card-text">Choose from various vaccination centers near you for convenience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-certificate fa-3x text-warning mb-3"></i>
                            <h5 class="card-title">Digital Certificate</h5>
                            <p class="card-text">Get your digital vaccination certificate after completion.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection