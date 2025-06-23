
@extends('web.layouts.app')
@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-10">
                        <h1>Computers Available</h1>
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

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form id="enrollForm" method="POST">
                            @csrf
                            <input type="hidden" name="registration_id" value="{{ Session::get('schoolid') }}">
                            <!-- Total Enrollment -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="total_enrollment" class="form-label">School's Total Strength 
                                        <i class="fa fa-info text-black ms-1 information"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="right"
                                            title="Enter your enrollment number.">
                                        </i>
                                    </label>
                                    <input type="number" class="form-control" id="total_enrollment" name="total_enrollment" @if(!empty($school_enrolment)) value="{{ $school_enrolment->total_enrollment }}" @endif required placeholder="Enter school's total strength">
                                    @error('total_enrollment')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="class_1_to_8_enroll" class="form-label">Student Strength - Class 1 - 8
                                        <i class="fa fa-info text-black ms-1 information"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="right"
                                            title="Enter Student Strength - Class 1 - 8.">
                                        </i>
                                    </label>
                                    <input type="number" class="form-control" id="class_1_to_8_enroll" name="class_1_to_8_enroll" @if(!empty($school_enrolment)) value="{{ $school_enrolment->class_1_to_8_enroll }}" @endif required placeholder="Enter student strength - class 1 - 8">
                                    @error('class_1_to_8_enroll')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="class_enroll_error" class="text-danger"></div>
                                </div>
                            </div>
                            <!-- Total Computer Labs -->
                            <div class="mb-3">
                                <label for="total_com_labs" class="form-label">Number of computers in each lab
                                    <i class="fa fa-info text-black ms-1 information"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="right"
                                        title="Enter your computer labs min 1 and max 10.">
                                    </i>
                                </label>
                                <input type="number" class="form-control" id="total_com_labs" name="total_com_labs" @if(!empty($school_enrolment)) value="{{ $school_enrolment->total_com_labs }}" @endif required min="1" max="25"
                                    placeholder="Enter number of computers in each lab" oninput="if(this.value > 25) this.value = 25;">
                                @error('total_com_labs')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="labs_table_container"></div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <a href="{{ route('spark.cordinator') }}" class="btn btn-outline-primary w-100"><i class="fa fa-arrow-left"></i> Back</a>
                                </div>
                                <div class="col-sm-8">
                                    <button type="submit" id="submit-button" class="btn btn-primary w-100">Save & Proceed <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form action="{{ route('finel.save') }}" method="POST" id="myForm">
        @csrf
        <input type="hidden" name="registration_id" value="{{ Session::get('schoolid') }}">
    </form>
    @if (session('success'))
        <div class="modal fade" id="successModals" tabindex="-1" aria-labelledby="successModalsLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="successModalsLabel">Success!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        {{-- <a href="{{ route('school_enroll.create') }}" class="btn btn-success">Proceed Next</a> --}}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview Your Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="previewContainer"></div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const labDetails = @json($lab_details);
        const totalLabsInput = document.getElementById('total_com_labs');
        const container = document.getElementById('labs_table_container');
        function renderLabsTable(count) {
            container.innerHTML = '';
            if (!isNaN(count) && count > 0) {
                const table = document.createElement('table');
                table.className = 'table table-bordered';

                const thead = document.createElement('thead');
                const headerRow = document.createElement('tr');
                ['Lab Info', 'Number of Computers'].forEach(text => {
                    const th = document.createElement('th');
                    th.innerText = text;
                    headerRow.appendChild(th);
                });
                thead.appendChild(headerRow);
                table.appendChild(thead);

                const tbody = document.createElement('tbody');
                for (let i = 1; i <= count; i++) {
                    const row = document.createElement('tr');

                    const labNumberCell = document.createElement('td');
                    labNumberCell.innerText = `Computers In Lab - ${i}`;
                    row.appendChild(labNumberCell);

                    const capacityCell = document.createElement('td');
                    const capacityInput = document.createElement('input');
                    capacityInput.type = 'number';
                    capacityInput.name = `labs[${i}][capacity]`;
                    capacityInput.className = 'form-control';
                    capacityInput.min = '1';
                    capacityInput.max = '200';
                    capacityInput.oninput = function () {
                        if (this.value > 200) this.value = 200;
                    };
                    if (labDetails[i - 1]) {
                        capacityInput.value = labDetails[i - 1].computer_qty;
                    }

                    capacityCell.appendChild(capacityInput);
                    row.appendChild(capacityCell);
                    tbody.appendChild(row);
                }

                table.appendChild(tbody);
                container.appendChild(table);
            }
        }

        // Trigger on load if value already set
        document.addEventListener('DOMContentLoaded', function () {
            const count = parseInt(totalLabsInput.value);
            if (!isNaN(count)) {
                renderLabsTable(count);
            }
        });

        // Update table when labs input changes
        totalLabsInput.addEventListener('input', function () {
            const count = parseInt(this.value);
            renderLabsTable(count);
        });
    </script>

    {{-- @if (session('success'))
        <script>
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to submit the form?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'I want to review'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('myForm').submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = '/review-page';
                }
            });
        </script>
    @endif --}}
    <script>
        document.getElementById('enrollForm').addEventListener('submit', function(e) {
            e.preventDefault();
            buttonDisable(true);
            const form = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to submit the form?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'Preview'
            }).then((result) => {
                if (result.isConfirmed) {
                    buttonDisable(false);
                    showloader();
                    ajaxSave(form,1);
                    setTimeout(() => {
                        $('#myForm').submit();
                    },5000);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    buttonDisable(false);
                    ajaxSave(form,2);
                    $.ajax({
                        url: "{{ url('preview') }}",
                        type: 'GET',
                        beforeSend: function () {
                            showloader();
                        },
                        success: function (response) {
                            $('#previewContainer').html(response);
                            $('#previewModal').modal('show');
                        },
                        error: function () {
                            alert("Something went wrong while checking verification.");
                        },
                        complete: function () {
                            hideloader()
                        }
                    });
                    // Swal.fire({
                    //     title: 'Success!',
                    //     text: 'Your form has been saved as draft.',
                    //     icon: 'success',
                    //     confirmButtonText: 'OK'
                    // }).then((result) => {
                    //     if (result.isConfirmed) {
                    //         ajaxSave(form,2)
                    //     }
                    // });

                }
            });
        });
        function ajaxSave(form,$id){
            $.ajax({
                url: "{{ url('school-enroll-save') }}",
                type: 'POST',
                data: $(form).serialize(),
                success: function (response) {
                    if (response.status == 'success') {
                        if($id==2){
                            setTimeout(() => {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Your form has been saved as draft.',
                                    icon: 'success',
                                });
                            },1000);
                        }
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Try again.',
                        icon: 'succerroress',
                    })
                }
            });
        }
        function buttonDisable(disable) {
            if (disable) {
                $('#submit-button').attr('disabled', true);
            } else {
                $('#submit-button').removeAttr('disabled');
            }
        }
        function showloader(){
            const preloader = document.querySelector('#preloader');
            preloader.style.display = 'flex';
            const message = document.createElement('div');
            message.className = 'preloader-message';
            message.textContent = 'Please wait, we are registering you...';
            preloader.appendChild(message);
        }
        function hideloader(){
            const preloader = document.querySelector('#preloader');
            preloader.style.display = 'none';
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalEnrollmentInput = document.getElementById('total_enrollment');
            const classEnrollInput = document.getElementById('class_1_to_8_enroll');
            const classEnrollError = document.getElementById('class_enroll_error');
            const submitButton = document.getElementById('submit-button');

            function validateEnrollment() {
                const total = parseInt(totalEnrollmentInput.value, 10);
                const classEnroll = parseInt(classEnrollInput.value, 10);

                classEnrollError.textContent = '';
                submitButton.disabled = false;

                if (!isNaN(total) && !isNaN(classEnroll)) {
                    if (classEnroll > total) {
                        classEnrollError.textContent = 'Class 1 to 8 Enrollment cannot be greater than Total Enrollment.';
                        submitButton.disabled = true;
                    }
                }
            }
            totalEnrollmentInput.addEventListener('keyup', validateEnrollment);
            classEnrollInput.addEventListener('keyup', validateEnrollment);
        });
    </script>
@endpush
