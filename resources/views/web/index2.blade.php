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

                        <form action="{{ route('otp.verify') }}" method="POST" id="otp-form">
                            @csrf
                            <input type="hidden" name="validate_details" value="{{ session('validate_details') }}">
                            
                            <div class="mb-3">
                                <input type="text" id="otp-input" name="otp" maxlength="6" class="form-control" placeholder="Enter OTP" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                            <div class="mb-3">
                                <button type="submit" id="verify-btn" class="btn btn-success w-100">Verify</button>
                            </div>
                            @if(session('success') === 'OTP Verified!')
                                <a href="{{ route('school.create') }}" class="btn btn-success">Proceed Next</a>
                            @endif
                            <div class="text-center mt-2">
                                <button type="button" id="resend-btn" class="btn btn-link" disabled>Resend OTP in <span id="countdown">30</span>s</button>
                                <div id="resend-status" class="text-success small mt-1"></div>
                            </div>
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
<div class="modal fade" id="otpExpiredModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-body text-center">
                <h5 class="text-danger">OTP has expired!</h5>
                <p>Please resend OTP to continue.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // ----------------- OTP Expiry Timer (2 minutes) -----------------
    // let duration = 2 * 60;
    // const timerDisplay = document.getElementById('otp-timer');
    // const verifyBtn = document.getElementById('verify-btn');
    // const otpInput = document.getElementById('otp-input');
    // let otpTimer = null;

    // function startOtpExpiryTimer() {
    //     let remaining = duration;
    //     otpTimer = setInterval(() => {
    //         const minutes = Math.floor(remaining / 60);
    //         const seconds = remaining % 60;
    //         timerDisplay.textContent = `OTP expires in: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    //         remaining--;
    //         if (remaining < 0) {
    //             clearInterval(otpTimer);
    //             timerDisplay.textContent = "OTP has expired.";
    //             verifyBtn.disabled = true;
    //             otpInput.disabled = true;

    //             const otpExpiredModal = new bootstrap.Modal(document.getElementById('otpExpiredModal'));
    //             otpExpiredModal.show();
    //         }
    //     }, 1000);
    // }

    // startOtpExpiryTimer(); // Initial start

    let resendDuration = 10;
    const countdownEl = document.getElementById('countdown');
    const resendBtn = document.getElementById('resend-btn');
    const resendStatus = document.getElementById('resend-status');
    let resendInterval = null;

    function startResendCountdown() {
        let timeLeft = resendDuration;
        resendBtn.disabled = true;
        countdownEl.textContent = timeLeft;

        resendInterval = setInterval(() => {
            timeLeft--;
            countdownEl.textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(resendInterval);
                resendBtn.disabled = false;
                resendBtn.innerHTML = 'Resend OTP';
            }
        }, 1000);
    }

    startResendCountdown(); // Initial countdown

    resendBtn.addEventListener('click', () => {
        resendBtn.disabled = true;
        resendBtn.innerText = 'Sending...';

        fetch("{{ route('otp.resend') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                validate_details: "{{ session('validate_details') }}"
            })
        })
        .then(res => res.json())
        .then(data => {
            resendStatus.innerHTML = 'OTP resent successfully!';
            
            // Restart resend countdown
            resendBtn.innerHTML = 'Resend OTP in <span id="countdown">30</span>s';
            countdownEl.textContent = resendDuration;
            startResendCountdown();

            // Optionally restart the OTP expiry timer
            verifyBtn.disabled = false;
            otpInput.disabled = false;
            clearInterval(otpTimer);
            startOtpExpiryTimer();
        })
        .catch(err => {
            resendStatus.innerHTML = '<span class="text-danger">Failed to resend OTP.</span>';
            resendBtn.disabled = false;
            resendBtn.innerHTML = 'Resend OTP';
        });
    });
</script>

@endpush