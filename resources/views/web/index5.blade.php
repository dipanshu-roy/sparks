



@extends('web.layouts.app')
@section('content')
<div class="page-title">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-10">
                    <h1>Spark Coordinator Details</h1>
                    <div class="rectangle">
                        <img src="{{ asset('web/assets/img/Rectangle 13.png') }}" class="img-fluid" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="service-details" class="service-details section">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                @include('web.layouts.tabination')
            </div>
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                <div class="form-container">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{ route('save.spark.cordinator') }}" method="POST">
                        @csrf
                        <input type="hidden" name="registration_id" value="{{Session::get('schoolid');}}">
                        <div class="row">
                            <div class="col-md-2 col-3">
                                <div class="mb-3">
                                    <label for="title_id" id="title_id" class="form-label">Title*</label>
                                    <select name="title_id" class="form-control" id="title" required>
                                        @foreach($title as $t)
                                            <option value="{{$t->id}}" {{ isset($spark_cordinator) && $spark_cordinator->title_id == $t->id ? 'selected' : '' }}>{{$t->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('title_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4 col-9">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name*</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" @if(!empty($spark_cordinator)) value="{{ $spark_cordinator->first_name }}" @endif placeholder="Enter First Name" required>
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="mb-3">
                                    <label for="second_name" class="form-label">Middle Name</label>
                                    <input type="text" name="second_name" id="second_name" class="form-control" @if(!empty($spark_cordinator)) value="{{ $spark_cordinator->second_name }}" @endif placeholder="Enter Middle Name">
                                </div>
                            </div>

                            <div class="col-md-3 col-6">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name*</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" @if(!empty($spark_cordinator)) value="{{ $spark_cordinator->last_name }}" @endif placeholder="Enter Last Name" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile
                                        <i class="fa fa-info text-black ms-1 information"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="right"
                                            title="Enter your mobile number and validate.">
                                        </i>
                                    </label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" @if(!empty($spark_cordinator)) value="{{ $spark_cordinator->mobile }}" @endif placeholder="Enter Mobile Number" pattern="^[1-9][0-9]{9}$" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" {{ isset($spark_cordinator) && $spark_cordinator->is_mobile_validate == 1 ? 'readonly' : '' }}>
                                    @if(empty($spark_cordinator->is_mobile_validate))
                                        <span id="verifyMobile" class="text-info cursor-pointer mt-1 float-end"><small>Verify</small></span>
                                        <div id="mobileStatus" class="font-size-12 mt-1 small"></div>
                                        <div id="mobileOtpWrapper" class="mt-2 d-none">
                                            <input type="text" id="mobileOtp" class="form-control mt-1" placeholder="Enter OTP">
                                            <button type="button" class="btn btn-success btn-sm mt-1" id="verifyMobileOtp" style="display:none">Verify OTP</button>
                                            <div id="mobileStatus" class="small mt-1"></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email
                                        <i class="fa fa-info text-black ms-1 information"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="right"
                                            title="Enter your email address and validate.">
                                        </i>
                                    </label>
                                    <input type="email" class="form-control" name="email" id="email" @if(!empty($spark_cordinator)) value="{{ $spark_cordinator->email }}" @endif placeholder="Enter Email Address" {{ isset($spark_cordinator) && $spark_cordinator->is_validate == 1 ? 'readonly' : '' }}>
                                    @if(empty($spark_cordinator->is_validate))
                                        <span id="verifyEmail" class="text-info cursor-pointer mt-1 float-end"><small>Verify</small></span>
                                        <div id="emailStatus" class="font-size-12 mt-1 small"></div>
                                        <div id="emailOtpWrapper" class="mt-2 d-none">
                                            <input type="text" id="emailOtp" class="form-control mt-1" placeholder="Enter OTP">
                                            <button type="button" class="btn btn-success btn-sm mt-1" id="verifyEmailOtp" style="display:none">Verify OTP</button>
                                            <div id="emailStatus" class="small mt-1"></div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="designation" class="form-label">Designation*
                                        <i class="fa fa-info text-black ms-1 information"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="right"
                                            title="Enter your designation.">
                                        </i>
                                    </label>
                                    <select name="designation" id="designation-dropdown" class="form-select" required>
                                        <option value="">--Select Designation--</option>
                                        @foreach($designation as $d)
                                            <option value="{{$d->id}}" {{ isset($spark_cordinator) && $spark_cordinator->designation == $d->id ? 'selected' : '' }}>{{$d->designation}}</option>
                                        @endforeach
                                    </select>
                                    @error('designation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 mb-3">
                                    <a href="{{ url('head-of-school-info') }}" class="btn btn-outline-primary w-100"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary w-100">Save & Proceed <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @if (session('success'))
        <script>
            $(document).ready(function() {
                var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const oldStateId = '{{ old('designation') }}';
            if (oldStateId) {
                // Trigger change to load districts if state was previously selected
                document.getElementById('designation-dropdown').value = oldStateId;
                fetchDistricts(oldStateId, oldDistrictId);
            }

            document.getElementById('state-dropdown').addEventListener('change', function() {
                fetchDistricts(this.value);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const oldStateId = '{{ old('title_id') }}';
            if (oldStateId) {
                // Trigger change to load districts if state was previously selected
                document.getElementById('title_id').value = oldStateId;
                fetchDistricts(oldStateId, oldDistrictId);
            }

            document.getElementById('state-dropdown').addEventListener('change', function() {
                fetchDistricts(this.value);
            });
        });
    </script>
    <script>
        document.getElementById('mobile').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
            if (value.length > 0 && value.charAt(0) === '0') {
                value = value.slice(1);
            }
            e.target.value = value.slice(0, 10);
        });
    </script>
<script>
$(document).ready(function () {
    $('#verifyMobile').on('click', function () {
        const mobile = $('#mobile').val().trim();
        const mobileStatus = $('#mobileStatus');
        if (!/^[1-9][0-9]{9}$/.test(mobile)) {
            mobileStatus.text('Enter a valid 10-digit mobile number (not starting with 0).').removeClass('text-success').addClass('text-danger');
            return;
        }
        $.ajax({
            url: '{{ url('send-otp-mobile') }}',
            type: 'POST',
            data: {
                mobile: mobile,
                page: 'spark-cordinator',
                _token: '{{ csrf_token() }}'
            },
            success: function (res) {
                if (res.status === 'ok') {
                    mobileStatus.text('OTP sent to your mobile number.').removeClass('text-danger').addClass('text-success');
                    $('#mobileOtpWrapper').removeClass('d-none');
                } else {
                    mobileStatus.text(res.message || 'Failed to send OTP.').removeClass('text-success').addClass('text-danger');
                }
            },
            error: function () {
                mobileStatus.text('Something went wrong while sending OTP.').removeClass('text-success').addClass('text-danger');
            }
        });
    });
    $('#verifyMobileOtp').on('click', function () {
        const mobile = $('#mobile').val().trim();
        const otp = $('#mobileOtp').val().trim();
        const mobileStatus = $('#mobileStatus');

        if (!otp) {
            mobileStatus.text('Please enter the OTP.').removeClass('text-success').addClass('text-danger');
            return;
        }
        $.ajax({
            url: '{{ url('verify-otp-mobile') }}',
            type: 'POST',
            data: {
                mobile: mobile,
                page: 'spark-cordinator',
                otp: otp,
                _token: '{{ csrf_token() }}'
            },
            success: function (res) {
                if (res.status === 'ok') {
                    mobileStatus.text('Mobile number verified successfully').removeClass('text-danger').addClass('text-success');
                    $('#verifyMobileOtp').prop('disabled', true);
                    $('#mobileOtpWrapper').addClass('d-none');
                    $('#mobile').prop('readonly', true);
                    $('#verifyMobile').addClass('d-none');
                } else {
                    mobileStatus.text('Invalid OTP').removeClass('text-success').addClass('text-danger');
                }
            },
            error: function () {
                mobileStatus.text('OTP verification failed.').removeClass('text-success').addClass('text-danger');
            }
        });
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const otpInput = document.getElementById('mobileOtp');
    const verifyButton = document.getElementById('verifyMobileOtp');
    verifyButton.style.display = 'none';
    otpInput.addEventListener('input', function () {
        if (otpInput.value.trim().length > 0) {
            verifyButton.style.display = 'inline-block';
        } else {
            verifyButton.style.display = 'none';
        }
    });
});
</script>

<script>
$(document).ready(function () {
    $('#verifyEmail').on('click', function () {
        const email = $('#email').val().trim();
        const emailStatus = $('#emailStatus');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            emailStatus.text('Enter a valid email address.').removeClass('text-success').addClass('text-danger');
            return;
        }

        $.ajax({
            url: '{{ url('send-otp-email') }}',
            type: 'POST',
            data: {
                email: email,
                page: 'spark-cordinator',
                _token: '{{ csrf_token() }}'
            },
            success: function (res) {
                if (res.status === 'ok') {
                    emailStatus.text('OTP sent to your email address.').removeClass('text-danger').addClass('text-success');
                    $('#emailOtpWrapper').removeClass('d-none');
                } else {
                    emailStatus.text(res.message || 'Failed to send OTP.').removeClass('text-success').addClass('text-danger');
                }
            },
            error: function () {
                emailStatus.text('Something went wrong while sending OTP.').removeClass('text-success').addClass('text-danger');
            }
        });
    });

    $('#verifyEmailOtp').on('click', function () {
        const email = $('#email').val().trim();
        const otp = $('#emailOtp').val().trim();
        const emailStatus = $('#emailStatus');
        if (!otp) {
            emailStatus.text('Please enter the OTP.').removeClass('text-success').addClass('text-danger');
            return;
        }
        $.ajax({
            url: '{{ url('verify-otp-email') }}',
            type: 'POST',
            data: {
                email: email,
                page: 'spark-cordinator',
                otp: otp,
                _token: '{{ csrf_token() }}'
            },
            success: function (res) {
                if (res.status === 'ok') {
                    emailStatus.text('Email verified successfully').removeClass('text-danger').addClass('text-success');
                    $('#verifyEmailOtp').prop('disabled', true);
                    $('#emailOtpWrapper').addClass('d-none');
                    $('#email').prop('readonly', true);
                    $('#verifyEmail').addClass('d-none');
                } else {
                    emailStatus.text('Invalid OTP').removeClass('text-success').addClass('text-danger');
                }
            },
            error: function () {
                emailStatus.text('OTP verification failed.').removeClass('text-success').addClass('text-danger');
            }
        });
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const otpInput = document.getElementById('emailOtp');
    const verifyButton = document.getElementById('verifyEmailOtp');
    verifyButton.style.display = 'none';
    otpInput.addEventListener('input', function () {
        if (otpInput.value.trim().length > 0) {
            verifyButton.style.display = 'inline-block';
        } else {
            verifyButton.style.display = 'none';
        }
    });
});
</script>
@endpush

