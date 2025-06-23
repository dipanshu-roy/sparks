@extends('web.layouts.app')
@section('content')
    <section id="hero" class="hero section accent-background">
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-5 justify-content-between">
                <div class="col-lg-6 d-none d-md-block">
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
                                <label id="label" class="text-black">Mobile Or Email</label>
                                <input type="text" id="mobile" name="mobileno" class="form-control" placeholder="Mobile Or Email" required autocomplete="off" />
                                <div id="mobile-error" class="text-danger small mt-1"></div>
                            </div>
                            <div id="otp-box" style="display:none; margin-top: 10px;">
                                <label for="otp" class="text-black">Enter OTP</label>
                                <input type="text" id="otp" name="otp" class="form-control" maxlength="6" placeholder="Enter 6-digit OTP" autocomplete="off">
                                <div id="otp-error" class="text-danger small mt-1"></div>
                            </div>
                            <div class="text-center mt-2 " style="display:none" id="show_counter"> 
                                <button type="button" id="resend-btn" class="btn btn-link" disabled>Resend OTP in <span id="countdown">30</span>s</button>
                                <div id="resend-status" class="text-success small mt-1"></div>
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
const otpInput = document.getElementById('otp');
const verifyBtn = document.getElementById('submit-btn');
otpInput.addEventListener('input', () => {
    const otp = otpInput.value.trim();
    if (/^\d{6}$/.test(otp)) {
        verifyBtn.disabled = false;
    } else {
        verifyBtn.disabled = true;
    }
});
document.getElementById('mobile').addEventListener('input', function () {
    const input = this.value.trim();
    const errorDiv = document.getElementById('mobile-error');
    const submitBtn = document.getElementById('submit-btn');

    const mobileRegex = /^[1-9][0-9]{9}$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    errorDiv.innerText = '';
    submitBtn.disabled = true;

    $('#show_counter').hide();
    $('#otp-box').slideUp();
    $('#contactForm').attr('action', "{{ route('register.store') }}");
    $('#submit-btn').text('Submit');

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
        errorDiv.innerText = 'Enter a valid email or a 10-digit mobile number (not starting with 0)';
    }
});

$('#contactForm').on('submit', function(e) {
    e.preventDefault();
    $('#mobile-error').text('');
    $('#otp-error').text('');
    $('#submit-btn').prop('disabled', true).text('Submitting...');
    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        beforeSend: function () {
            showloader();
            startResendCountdown();
        },
        success: function(response) {
            if (response?.otp) {
                if (response?.route) {
                    $('#resend-status').text(response.message);
                    window.location.href = response.route;
                }else{
                    $('#submit-btn').text('Verify');
                    $('#resend-status').text(response.message);
                }
            }else{
                if(response.status==200){
                    $('#otp-box').slideDown();
                    $('#show_counter').show();
                    $('#submit-btn').text('Verify');
                    $('#contactForm').attr('action', "{{ route('otp.verify') }}");
                }else{
                    $('#submit-btn').text('Submit').prop('disabled', false);
                }
            }
        },
        error: function(xhr) {
            $('#submit-btn').text('Submit').prop('disabled', false);
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                if (xhr.responseJSON.errors.mobileno) {
                    $('#mobile-error').text(xhr.responseJSON.errors.mobileno[0]);
                }
            } else {
                alert('An unexpected error occurred.');
            }
        },
        complete: function () {
            hideloader()
        }
    });
});

let resendDuration = 20;
let resendInterval = null;
let otpTimer = null;

const countdownEl = document.getElementById('countdown');
const resendBtn = document.getElementById('resend-btn');
const resendStatus = document.getElementById('resend-status');

function startResendCountdown() {
    clearInterval(resendInterval);
    let timeLeft = resendDuration;
    resendBtn.disabled = true;
    countdownEl.textContent = timeLeft;

    resendInterval = setInterval(() => {
        timeLeft--;
        countdownEl.textContent = timeLeft;
        if (timeLeft <= 0) {
            clearInterval(resendInterval);
            resendBtn.disabled = false;
            resendBtn.textContent = 'Resend OTP';
        }
    }, 1000);
}
startResendCountdown();

resendBtn.addEventListener('click', () => {
    resendBtn.disabled = true;
    resendBtn.textContent = 'Sending...';

    fetch("{{ route('otp.resend') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            validate_details: $('#mobile').val()
        })
    })
    .then(async res => {
        const contentType = res.headers.get('content-type') || '';
        if (!res.ok) throw new Error(await res.text());
        if (!contentType.includes('application/json')) throw new Error('Expected JSON');
        return res.json();
    })
    .then(data => {
        if (data.status === 200) {
            resendStatus.innerHTML = data.message;
            resendBtn.innerHTML = 'Resend OTP in <span id="countdown">' + resendDuration + '</span>s';
            const newCountdownEl = document.getElementById('countdown');
            clearInterval(resendInterval);
            let timeLeft = resendDuration;
            resendBtn.disabled = true;
            resendInterval = setInterval(() => {
                timeLeft--;
                newCountdownEl.textContent = timeLeft;
                if (timeLeft <= 0) {
                    clearInterval(resendInterval);
                    resendBtn.disabled = false;
                    resendBtn.textContent = 'Resend OTP';
                }
            }, 1000);
        } else {
            throw new Error(data.message || "Unexpected response.");
        }
    })
    .catch(err => {
        $('#submit-btn').text('Verify');
        console.error('Resend OTP error:', err);
        resendStatus.innerHTML = '<span class="text-danger">Failed to resend OTP.</span>';
        resendBtn.disabled = false;
        resendBtn.textContent = 'Resend OTP';
    });
});
function showloader(){
    const preloader = document.querySelector('#preloader');
    preloader.style.display = 'flex';
}
function hideloader(){
    const preloader = document.querySelector('#preloader');
    preloader.style.display = 'none';
}
</script>

@endpush
