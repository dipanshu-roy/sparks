@extends('web.layouts.app')
@section('content')
<div class="page-title">
    <div class="heading">
        <div class="container">
            <div class="row d-flex justify-content-center text-center">
                <div class="col-lg-10">
                    <h1>School Profile</h1>
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
                <h3>Welcome !</h3>
                <p>welcome message</p>
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
                    <form action="{{ route('school.store') }}" method="POST">
                        <input type="hidden" name="registration_id" value="{{ Session::get('schoolid') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Board* 
                                <i class="fa fa-info text-black ms-1 information"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="right"
                                    title="Select the educational board your school is affiliated with, such as CBSE, ICSE, or State Board.">
                                </i>
                            </label>
                            <div class="d-flex justify-content-between">
                                @foreach ($boards as $board)
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="board_id" id="board_{{ $board->id }}" value="{{ $board->id }}" required {{ isset($school) && $school->board_id == $board->id ? 'checked' : '' }}>
                                        <label class="form-check-label" for="board_{{ $board->id }}">{{ $board->board }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="school_name" class="form-label">School Name*
                                <i class="fa fa-info text-black ms-1 information"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="right"
                                    title="Please enter the full official name of your school as it appears on records.">
                                </i>
                            </label>
                            <input type="text" class="form-control" id="school_name" name="school_name"
                                @if(!empty($school)) value="{{ $school->school_name }}" @endif placeholder="Enter School Name" autocomplete="off"
                                required>
                            <div id="schoolList" class="list-group position-absolute w-100" style="z-index: 1000;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city-dropdown" class="form-label">Village/Town/City*</label>
                                    <input type="text" class="form-control" name="city_id" placeholder="Village/Town/City" @if(!empty($school)) value="{{ $school->city_id }}" @endif required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="state-dropdown" class="form-label">State*</label>
                                    <select name="state_id" id="state-dropdown" class="form-select" required>
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                        <option value="{{ $state->state_id }}" @if(!empty($school)) @if($school->state_id == $state->state_id) selected @endif @endif>{{ $state->state_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="district-dropdown" class="form-label">District*</label>
                                    <select name="district_id" id="district-dropdown" class="form-select" required>
                                        <option value="">Select District</option>
                                        @foreach ($city as $city)
                                            <option value="{{ $city->districtid }}" selected>{{ $city->district_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city-dropdown" class="form-label">Pin Code*</label>
                                    <input type="text" class="form-control" name="pin" id="otp_check" placeholder="Pin Code" @if(!empty($school)) value="{{ $school->pin }}" @endif pattern="[0-9]*" maxlength="6" minlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <button type="submit" class="btn btn-primary w-100">Save & Proceed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    
    $('#state-dropdown').on('change', function() {
        var stateID = this.value;
        console.log("Selected State ID:", stateID); // Debug line
        $("#district-dropdown").html('');
        $.ajax({
            url: "{{ url('get-districts') }}/" + stateID,
            type: "GET",
            success: function(res) {
                $('#district-dropdown').html('<option value="">Select District</option>');
                $.each(res, function(key, value) {
                    $('#district-dropdown').append('<option value="' + value.districtid +'">' + value.district_title + '</option>');
                });
            }
        });
    });


    $('#district-dropdown').on('change', function() {
        var districtID = this.value;
        $("#city-dropdown").html('');
        $.ajax({
            url: "{{ url('get-cities') }}/" + districtID,
            type: "GET",
            success: function(res) {
                $('#city-dropdown').html('<option value="">Select City</option>');
                $.each(res, function(key, value) {
                    $('#city-dropdown').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
</script>
@if (session('success'))
    <script>
        $(document).ready(function() {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    </script>
@endif
<script>
    $(document).ready(function() {
        $('#school_name').on('keyup', function() {
            let query = $(this).val();

            if (query.length > 1) {
                $.ajax({
                    url: '{{ route('schools.autocomplete') }}',
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#schoolList').html(data).show();
                    }
                });
            } else {
                $('#schoolList').hide();
            }
        });
        $(document).on('click', '.school-suggestion', function() {
            $('#school_name').val($(this).text());
            $('#schoolList').fadeOut();
        });
        $(document).click(function(e) {
            if (!$(e.target).closest('#school_name, #schoolList').length) {
                $('#schoolList').fadeOut();
            }
        });
    });
</script>

<script>
    const oldStateId = '{{ old('state_id') }}';
    const oldDistrictId = '{{ old('district_id') }}';

    document.addEventListener('DOMContentLoaded', function() {
        if (oldStateId) {
            document.getElementById('state-dropdown').value = oldStateId;
            fetchDistricts(oldStateId, oldDistrictId);
        }

        document.getElementById('state-dropdown').addEventListener('change', function() {
            fetchDistricts(this.value);
        });
    });
    function fetchDistricts(stateId, selectedDistrictId = '') {
        fetch(`/get-districts/${stateId}`)
            .then(response => response.json())
            .then(data => {
                const districtDropdown = document.getElementById('district-dropdown');
                districtDropdown.innerHTML = '<option value="">Select District</option>';
                data.forEach(district => {
                    let selected = selectedDistrictId == district.id ? 'selected' : '';
                    districtDropdown.innerHTML +=
                        `<option value="${district.id}" ${selected}>${district.name}</option>`;
                });
            });
        }
</script>
@endpush
