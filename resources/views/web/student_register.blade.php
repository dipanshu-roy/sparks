
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
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Admission No.*</label>
                            <input type="text" class="form-control" readonly value="{{$admission_no}}" name="admission_no" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-4 mb-3">
                                <label for="full_name" class="form-label">First Name*</label>
                                <input type="text" class="form-control" placeholder="Full Name" name="full_name" required>
                            </div>

                            <div class="col-sm-4 mb-3">
                                <label for="full_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" placeholder="Full Name" name="middle_name">
                            </div>

                            <div class="col-sm-4 mb-3">
                                <label for="full_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="Full Name" name="last_name">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="father_name" class="form-label">Father Name*</label>
                            <input type="text" class="form-control" placeholder="Father Name" name="father_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="father_name" class="form-label">Email*</label>
                            <input type="text" class="form-control" placeholder="Email" name="email" required>
                        </div>

                        
                        <div class="mb-3">
                            <label for="father_name" class="form-label">Mobile*</label>
                            <input type="text" class="form-control" placeholder="Mobile" name="mobile" id="mobile" pattern="^[1-9][0-9]{9}$" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
                        </div>
                        <div class="mb-3">
                            <label for="Subject">Class*</label>
                            <select name="class" id="class-dropdown" class="form-control class-select" required>
                                <option>--select --</option>
                                @foreach($cc as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="section" class="form-label">Section*</label>
                            <input type="text" class="form-control" placeholder="Section" name="section" required>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject*</label>
                            <select name="subject" id="subject" class="form-select" required>
                                <option value="">Select Subject</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
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
@endpush