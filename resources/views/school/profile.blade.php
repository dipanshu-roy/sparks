@extends('layouts.school')
@section('content')
	<!-- [ Main Content ] start -->
	<div class="pcoded-main-container">
		<div class="pcoded-wrapper">
			<div class="pcoded-content">
				<div class="pcoded-inner-content">
					<div class="main-body">
						<div class="page-wrapper">
							<!-- [ breadcrumb ] start -->
							<div class="page-header">
								<div class="page-block">
									<div class="row align-items-center">
										<div class="col-md-12">
											<div class="page-header-title">
												<h5>Profile</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="{{route('school.dashboard')}}"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="{{route('school.dashboard')}}">Home</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div> 

                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="card card-social">										 
                                        <div class="card-block">	
                                        <div class="row">
                                        <div class="col-md-8"> 
                                            <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label   class="form-label">Logo</label>
                                            <input type="file" class="form-control" name="image">
                                            </div>
                                            <div class="col-md-4 mt-4">
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                             </div>
                                            </form>
                                         </div>
                                         </div>
                                  </div>            
                                </div>            
                            </div>            

                            <div class="accordion" id="accordionExample">
                                

                                
                         

							  <div class="card"> 
                                 <div class="card-header" id="headingOne">
                                   <h5 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="">School Details</a></h5>
                                 </div>
                            
                        <div id="collapseOne" class="card-body collapse show" aria-labelledby="headingOne" data-parent="#accordionExample" style="">

                        <form action="{{ route('school.store') }}" method="POST">
                            <input type="hidden" name="registration_id_from_admin" value="{{$user->id}}">
                                @csrf
                            <div class="mb-3">
                            <label   class="form-label">Board</label>
                                <select name="board_id"   class="form-control"  required>
                                        <option value="">--Select Board--</option>
                                        @foreach($boards as $board)
                                            <option value="{{$board->id}}" {{ $board->id == $sd->board_id ? 'selected' : '' }} >{{$board->board}}</option>
                                        @endforeach
                                    </select>
                            </div>

                            <!-- Blade View (e.g., create.blade.php) -->
                            <div class="mb-3 position-relative">
                                <label for="school_name" class="form-label">School Name</label>
                                <input type="text" class="form-control" id="school_name" name="school_name" value="{{ $sd->school_name }}" placeholder="Enter School Name" autocomplete="off" required>
                                <div id="schoolList" class="list-group position-absolute w-100" style="z-index: 1000;"></div>
                            </div>


                            <div class="mb-3">
                                <label for="state-dropdown" class="form-label">State</label>
                                <select name="state_id" id="state-dropdown" class="form-control" required>
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                            <option value="{{$state->state_id}}" {{ $state->state_id == $sd->state_id ? 'selected' : '' }}>{{$state->state_title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="district-dropdown" class="form-label">District</label>
                                <select name="district_id" id="district-dropdown" class="form-control" required>
                                    <option value="">Select District</option>
                                    @foreach($district as $dis)
                                            <option value="{{$dis->districtid}}" {{ $dis->districtid == $sd->district_id ? 'selected' : '' }}>{{$dis->district_title}}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="mb-3">
                                <label for="city-dropdown" class="form-label">Village/Town/City</label>
                                <input type="text" class="form-control" name="city_id" placeholder="Village/Town/City" value="{{ $sd->city_id }}" required/>
                                
                            </div>

                            <div class="mb-3">
                                <label for="city-dropdown" class="form-label">Pin Code</label>
                                <input type="text" class="form-control" maxlength="6" required name="pin" placeholder="Pin Code" value="{{ $sd->pin }}" required/>            
                            </div>

                            
                            <button type="submit" class="btn btn-primary">Update</button>
                            
                    </form>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="headingTwo">
												<h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Head of School</a></h5>
											</div>
											<div id="collapseTwo" class="card-body collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="">
                                            <form action="{{ route('save.head.of.school') }}" method="POST">
    @csrf

    <input type="hidden" name="registration_id_from_admin" value="{{$user->id}}">
    <!-- Title ID -->
    <div class="mb-3">
        <label for="title_id" class="form-label">Title </label>
       <select name="title_id" id="title_id" class="form-control" id="title" required>
        <option value="">Select Title</option>
        @foreach($title as $t)
                    <option value="{{$t->id}}" {{ $t->id == $hs->title_id ? 'selected' : '' }}>{{$t->title}}</option>
        @endforeach
    </select>
        
    </div>

    <!-- First Name -->
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $hs->first_name }}" required placeholder="Enter First Name">
        
    </div>

    <!-- Second Name -->
    <div class="mb-3">
        <label for="second_name" class="form-label">Middle Name</label>
        <input type="text" class="form-control" name="second_name" id="second_name" value="{{ $hs->second_name }}" placeholder="Enter Middle Name" required>
        @error('second_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Last Name -->
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="third" value="{{ $hs->last_name }}" placeholder="Enter Last Name" required>
         
    </div>

    <!-- Mobile -->
    <div class="mb-3">
        <label for="mobile" class="form-label">Mobile</label>
        <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $hs->mobile }}" placeholder="Enter Mobile Number" required maxlength="10">
        
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{ $hs->email }}" placeholder="Enter Email Address" required>
        
    </div>

    <!-- Designation -->
    <div class="mb-3">
        <label for="designation" class="form-label">Designation</label> 
        <select name="designation" class="form-control" aria-label="Select Designation" require id="designation-dropdown">
            <option value="">--Select Designation--</option>
            @foreach($designation as $d)
                <option value="{{$d->id}}" {{ $d->id == $hs->designation ? 'selected' : '' }}>{{$d->designation}}</option>
            @endforeach
        </select>
         
    </div>    
    <button type="submit" class="btn btn-primary">Update</button>     
</form>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="headingThree">
												<h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Spark Coordinator Details</a></h5>
											</div>
											<div id="collapseThree" class="card-body collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                            <form action="{{ route('save.spark.cordinator') }}" method="POST">
    @csrf

    <input type="hidden" name="registration_id_from_admin" value="{{$user->id}}">
    <!-- Title ID -->
    <div class="mb-3">
        <label for="title_id" class="form-label">Title </label>
       <select name="title_id" id="title_id" class="form-control" id="title" required>
        <option value="">Select Title</option>
        @foreach($title as $t)
                    <option value="{{$t->id}}" {{ $t->id == $sp->title_id ? 'selected' : '' }}>{{$t->title}}</option>
        @endforeach
    </select>
        
    </div>

    <!-- First Name -->
    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $sp->first_name }}" required placeholder="Enter First Name">
        
    </div>

    <!-- Second Name -->
    <div class="mb-3">
        <label for="second_name" class="form-label">Middle Name</label>
        <input type="text" class="form-control" name="second_name" id="second_name" value="{{ $sp->second_name }}" placeholder="Enter Middle Name" required>
        @error('second_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Last Name -->
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="third" value="{{ $sp->last_name }}" placeholder="Enter Last Name" required>
         
    </div>

    <!-- Mobile -->
    <div class="mb-3">
        <label for="mobile" class="form-label">Mobile</label>
        <input type="text" class="form-control" name="mobile" id="mobile" value="{{ $sp->mobile }}" placeholder="Enter Mobile Number" required maxlength="10">
        
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{ $sp->email }}" placeholder="Enter Email Address" >
        
    </div>

    <!-- Designation -->
    <div class="mb-3">
        <label for="designation" class="form-label">Designation</label> 
        <select name="designation" class="form-control" aria-label="Select Designation" require id="designation-dropdown">
            <option value="">--Select Designation--</option>
            @foreach($designation as $d)
                <option value="{{$d->id}}" {{ $d->id == $sp->designation ? 'selected' : '' }}>{{$d->designation}}</option>
            @endforeach
        </select>
         
    </div>    
    <button type="submit" class="btn btn-primary">Update</button>
</form>
											</div>
										</div>
                                        <div class="card">
											<div class="card-header" id="headingThree">
												<h5 class="mb-0"><a href="#!" class="collapsed" data-toggle="collapse" data-target="#collapseThree1" aria-expanded="false" aria-controls="collapseThree1">School Enrollment/Lab Details</a></h5>
											</div>
            <div id="collapseThree1" class="card-body collapse" aria-labelledby="headingThree" data-parent="#accordionExample">

            <form action="{{ route('school_enroll.save') }}" method="POST">
                    @csrf
                    <input type="hidden" name="registration_id_from_admin" value="{{$user->id}}">
                    <!-- Total Enrollment -->
                    <div class="mb-3">
                        <label for="total_enrollment" class="form-label">Total Enrollment</label>
                        <input type="number" class="form-control" id="total_enrollment" name="total_enrollment" value="{{ $se->total_enrollment }}" required placeholder="Total Enrollment">
                        @error('total_enrollment')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Class 1 to 8 Enrollment -->
                    <div class="mb-3">
                        <label for="class_1_to_8_enroll" class="form-label">Class 1 to 8 Enrollment</label>
                        <input type="number" class="form-control" id="class_1_to_8_enroll" name="class_1_to_8_enroll" value="{{ $se->class_1_to_8_enroll }}" required placeholder="Class 1 to 8 Enrollment">
                        @error('class_1_to_8_enroll')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div id="class_enroll_error" class="text-danger"></div>
                    </div>
                    <!-- Total Computer Labs -->
                    <div class="mb-3">
                <label for="total_com_labs" class="form-label">Total Computer Labs</label>
                <input type="number" class="form-control" id="total_com_labs" name="total_com_labs" value="{{ $se->total_com_labs }}" required min="1" placeholder="Total Computer Labs">
                @error('total_com_labs')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div> 
                    <!-- Submit Button -->
                    <button type="submit" id="submit-button" class="btn btn-primary">Update</button>
            </form>
 
                                            <div class="table-responsive mt-3">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr</th>
                                                            <th>Lab Info</th>
                                                            <th>Number of Computers</th>                                                             
                                                            <th>Action</th>                                                             
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $sr=1;@endphp
                                                        @foreach($ld as $l)
                                                        <form action="{{ route('school_enroll.edit', ['id' => $l->id]) }}" method="post">
                                                            @csrf
                                                        <tr>
                                                            <td>{{$sr++}}</td>
                                                            <td><input type="text" class="form-control" name="labs_name" value="{{$l->labs_name}}"></td>
                                                            <td><input type="text" class="form-control" name="computer_qty" value="{{$l->computer_qty}}"></td>   
                                                            <td>
                                                            <button type="submit" id="submit-button" class="btn btn-primary">Update</button>                                                                   
                                                            </td>  
                                                            </form>                                                       
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>                                         
                                        <div>
                                   <div>                                                                                 
							 </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ Main Content ] end -->
	@endsection

    @push('scripts')
<script>
$(document).ready(function () {
    $('#school_name').on('keyup', function () {
        let query = $(this).val();

        if (query.length > 1) {
            $.ajax({
                url: '{{ route('schools.autocomplete') }}',
                type: 'GET',
                data: { query: query },
                success: function (data) {
                    $('#schoolList').html(data).show();
                }
            });
        } else {
            $('#schoolList').hide();
        }
    });

    // Set clicked suggestion to input
    $(document).on('click', '.school-suggestion', function () {
        $('#school_name').val($(this).text());
        $('#schoolList').fadeOut();
    });

    // Hide on click outside
    $(document).click(function(e) {
        if (!$(e.target).closest('#school_name, #schoolList').length) {
            $('#schoolList').fadeOut();
        }
    });
});
</script>

<script>
     
$('#state-dropdown').on('change', function () {
    var stateID = this.value;
    console.log("Selected State ID:", stateID); // Debug line
    $("#district-dropdown").html('');
        $.ajax({
            url: "{{ url('get-districts') }}/" + stateID,
            type: "GET",
            success: function (res) {
                $('#district-dropdown').html('<option value="">Select District</option>');
                $.each(res, function (key, value) {
                    $('#district-dropdown').append('<option value="' + value.districtid + '">' + value.district_title + '</option>');
                });
            }
        });
    });


    $('#district-dropdown').on('change', function () {
        var districtID = this.value;
        $("#city-dropdown").html('');
        $.ajax({ 
            url: "{{ url('get-cities') }}/" + districtID,
            type: "GET",
            success: function (res) {
                $('#city-dropdown').html('<option value="">Select City</option>');
                $.each(res, function (key, value) {
                    $('#city-dropdown').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });



</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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

        // Attach validation to keyup events
        totalEnrollmentInput.addEventListener('keyup', validateEnrollment);
        classEnrollInput.addEventListener('keyup', validateEnrollment);
    });
</script>
@endpush
