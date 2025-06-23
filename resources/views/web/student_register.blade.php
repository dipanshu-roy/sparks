
@extends('web.layouts.app')
@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-10">
                        <h1>Student Information Form</h1>
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

                <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('students.store') }}" method="POST" id="register_head">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Admission No.*</label>
                            <input type="text" class="form-control" readonly value="{{$admission_no}}" name="admission_no" required>
                        </div>
                        <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="Subject">Class*</label>
                            <select name="class" id="class-dropdown" class="form-control class-select" required>
                                <option>--select --</option>
                                @foreach($cc as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 mb-3"> 
                                <label for="section">Section</label>                             
                                <input type="text" class="form-control" placeholder="Section" name="section" required>
                        </div>
                        </div>
 
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject*</label>
                            <select name="subject_id[]" id="subject" class="form-select" required multiple>
                                <option value="">Select Subject</option>
                            </select>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="full_name" class="form-label">First Name*</label>
                                <input type="text" class="form-control" placeholder="First Name" name="full_name" required>
                            </div>

                            <div class="col-sm-4 mb-3">
                                <label for="full_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" placeholder="Middle Name" name="middle_name">
                            </div>

                            <div class="col-sm-4 mb-3">
                                <label for="full_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                            </div>
                        </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="father_name" class="form-label">Relation*</label>
                                <select id="relation"  class="form-control" name="relation" required>
                                    <option value="">-- Select Relation --</option>
                                    <option value="father">Father</option>
                                    <option value="mother">Mother</option>
                                    <option value="guardian">Guardian</option>
                                    <option value="brother">Brother</option>
                                    <option value="sister">Sister</option>
                                    <option value="uncle">Uncle</option>
                                    <option value="aunt">Aunt</option>
                                    <option value="grandfather">Grandfather</option>
                                    <option value="grandmother">Grandmother</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="father_name" class="form-label">Relative Name*</label>
                                <input type="text" class="form-control" placeholder="Relative Name" name="father_name" required>
                            </div>
                        </div>

                         <div class="row">
                         <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile*
                                        <!-- <i class="fa fa-info text-black ms-1 information"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="right"
                                            title="Enter your mobile number and validate.">
                                        </i> -->
                                    </label>
                                    <input type="text" class="form-control" name="mobile" id="mobile" @if(!empty($head_of_school)) value="{{ $head_of_school->mobile }}" @endif placeholder="Enter Mobile Number" pattern="^[1-9][0-9]{9}$" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" {{ isset($head_of_school) && $head_of_school->is_mobile_validate == 1 ? 'readonly' : '' }} required>
                                    @if(empty($head_of_school->is_mobile_validate))
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
                                    <label for="email" class="form-label">Email*
                                        <!-- <i class="fa fa-info text-black ms-1 information"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="right"
                                            title="Enter your email address and validate.">
                                        </i> -->
                                    </label>
                                    <input type="email" class="form-control" name="email" id="email" @if(!empty($head_of_school)) value="{{ $head_of_school->email }}" @endif placeholder="Enter Email Address" {{ isset($head_of_school) && $head_of_school->is_validate == 1 ? 'readonly' : '' }} required>
                                    @if(empty($head_of_school->is_validate))
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
                        

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
$(document).ready(function () {
    $('#class-dropdown').on('change', function () {
    var stateID = this.value;
    console.log("Selected State ID:", stateID); // Debug line
    $("#subject").html('');
        $.ajax({
            url: "{{ url('get-subject') }}/" + stateID,
            type: "GET",
            success: function (res) {
                $('#subject').html('<option value="">Select Subject</option>');
                $.each(res, function (key, value) {
                    $('#subject').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
});

document.getElementById('mobile').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 0 && value.charAt(0) === '0') {
        value = value.slice(1);
    }
    e.target.value = value.slice(0, 10);
});
</script>

<script>
  $(document).ready(function() {
    $('#subject').select2({      
      placeholder: "Select class first",
      allowClear: true
    });
  });
</script>




<script>
        document.getElementById('register_head').addEventListener('submit', function(e) {
            e.preventDefault();
            @if(!empty($head_of_school))
                @if($head_of_school->is_mobile_validate==0 && $head_of_school->is_validate==0)
                    var title = "Mobile Number and Email Not Verified";
                    var decription = "Do you want to proceed without verifying your mobile number and email address?";
                @elseif($head_of_school->is_validate==0)
                    var title = "Email Not Verified";
                    var decription = "Do you want to proceed without verifying your email address?";
                @elseif($head_of_school->is_mobile_validate==0)
                    var title = "Mobile Number Not Verified";
                    var decription = "Do you want to proceed without verifying your mobile number?";
                @else
                this.submit();
                @endif
            @else
                var title = "Mobile Number and Email Not Verified";
                var decription = "Do you want to proceed without verifying your mobile number and email address?";
            @endif
            Swal.fire({
                title: title,
                text: decription,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
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
                page: 'head-of-school-info',
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
                page: 'head-of-school-info',
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
                    setTimeout(() => {
                        location.reload();
                    },1000);
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
                page: 'head-of-school-info',
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
                page: 'head-of-school-info',
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
                    setTimeout(() => {
                        location.reload();
                    },1000);
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