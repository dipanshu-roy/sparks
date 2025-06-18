@extends('web.layouts.app')
@section('content')
    <div class="container py-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="bg-success alert-success py-4">
                    <h2 class="mb-3 text-white">🎉 Congratulations!</h2>
                    <p class="lead text-white">Your school registration has been <strong>successfully completed.</strong></p>
                    <p class="text-white">An email/SMS has been sent with detailed instructions. Please check your inbox or phone.</p>
                </div>
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-white">Your Login Details</h4>
                    </div>
                    <div class="card-body text-start">
                        <p><strong>School URL:</strong> <a href="{{ $schoolUrl }}" target="_blank">{{ $schoolUrl }}</a></p>
                        <p><strong>School ID:</strong> {{ $schoolId }}</p>
                        <p><strong>Temporary Password:</strong> {{ $tempPassword }}</p>
                    </div>
                </div>
                <a href="{{ $schoolUrl }}" target="_blank" class="btn btn-success mt-4">Go to School Portal</a>
            </div>
        </div>
    </div>
@endsection