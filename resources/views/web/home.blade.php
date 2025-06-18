@extends('web.layouts.app')
@section('content')
    <section id="hero" class="hero section accent-background">
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-5 justify-content-between">
                <div class="col-lg-6 ">
                    <img src="{{ asset('web/assets/img/hero-img.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 form-css">
                    <div class="registration-box text-left">
                        <h2 class="text-black">School Registration</h2>
                        <p>Fill in the registration data. It will take a couple of minutes. All you need is a mobile number or a e-mail</p>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="contactForm" method="POST" action="{{ route('register.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label id="label">Mobile Or Email</label>
                                <input type="text" id="mobile" name="mobileno" class="form-control" placeholder="Mobile Or Email" required autocomplete="off" />
                                <div id="mobile-error" class="text-danger small mt-1"></div>
                            </div>
                            <div class="privacy-box">
                                <i class="bi bi-lock-fill"></i>
                                <span class="text-black">We take privacy issues seriously. You can be sure that your personal data is securely protected.</span>
                            </div>
                            <button type="submit" id="submit-btn" class="btn btn-primary" disabled>Submit</button>
                        </form>
                        <div class="footer-text text-black text-center">
                            Already have an account? <a href="{{ route('school-login') }}">LOGIN</a>
                        </div>
                        <div class="footer-links">
                            <a href="#">Privacy Policy</a>
                            <a href="#">Terms & Conditions</a>
                        </div>
                        <div class="copyright">
                            SPARK OLYMPIADS © 2025. All rights reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.getElementById('mobile').addEventListener('input', function () {
    const input = this.value.trim();
    const errorDiv = document.getElementById('mobile-error');
    const submitBtn = document.getElementById('submit-btn');

    const mobileRegex = /^[1-9][0-9]{9}$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    errorDiv.innerText = '';
    submitBtn.disabled = true;

    if (input === '') {
        errorDiv.innerText = 'Mobile or Email is required.';
    } else if (input.startsWith('+91')) {
        errorDiv.innerText = 'Remove +91. Enter 10-digit mobile only.';
    } else if (input.includes('@') && input.includes('.')) {
        if (emailRegex.test(input)) {
            submitBtn.disabled = false;
        } else {
            errorDiv.innerText = 'Please enter a valid email address.';
        }
    } else if (mobileRegex.test(input)) {
        submitBtn.disabled = false;
    } else {
        errorDiv.innerText = 'Enter a valid 10-digit mobile (not starting with 0) or valid email.';
    }
});
</script>


@endpush
