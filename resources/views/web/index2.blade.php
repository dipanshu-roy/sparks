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
                        <h2 class="text-black">Enter OTP</h2>
                        <p>Enter the One-Time Password (OTP) sent to your mobile number or email. This will only take a moment.</p>
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('otp.verify') }}" method="POST">
                            @csrf
                            <input type="hidden" name="validate_details" value="{{ session('validate_details') }}">
                            <div class="mb-3">
                                <input type="text" id="otp-input" name="otp" maxlength="6" class="form-control" placeholder="Enter OTP" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                            @if(session('success') === 'OTP Verified!')
                                <a href="{{ route('school.create') }}" class="btn btn-success">Proceed Next</a>
                            @else
                                <button type="submit" id="verify-btn" class="btn btn-success">Verify</button>
                            @endif
                        </form>
                        @if(session('success') === 'OTP Verified!')
                            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title" id="successModalLabel">Success!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if(session('success'))
                                                <div class="alert alert-success">{{ session('success') }}</div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('school.create') }}" class="btn btn-success">Proceed Next</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    let duration = 2 * 60; // 2 minutes in seconds
    const timerDisplay = document.getElementById('otp-timer');
    const verifyBtn = document.getElementById('verify-btn');
    const otpInput = document.getElementById('otp-input');

    function startTimer() {
        const timer = setInterval(() => {
            const minutes = Math.floor(duration / 60);
            const seconds = duration % 60;
            timerDisplay.textContent = `OTP expires in: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            duration--;
            if (duration < 0) {
                clearInterval(timer);
                timerDisplay.textContent = "OTP has expired.";
                verifyBtn.disabled = true;
                otpInput.disabled = true;
                const otpExpiredModal = new bootstrap.Modal(document.getElementById('otpExpiredModal'));
                otpExpiredModal.show();
            }
        }, 1000);
    }
    startTimer();
    @if(session('success'))
        $(document).ready(function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    @endif
</script>
@endpush