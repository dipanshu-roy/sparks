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
												<h5>Student Verification</h5>
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

                                             
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Total Students - {{$total_student}}</h5>                                            
                                             
                                    
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                            @php
                                                $sr = 1;
                                                $grandTotal = 0;
                                            @endphp

                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>SR NO.</th> 
                                                        <th>Admission No.</th>
                                                        <th>Full Name</th>
                                                        <th>Class</th>
                                                        <th>Subject</th>
                                                        <th>Fee</th>            
                                                        <th>Details Verify</th>              
                                                        <th>Fee Status</th>                                                            
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($students as $st)
                                                    @php
                                                        $subject = count(array_filter(array_map('trim', explode(',', $st->subject_names))));
                                                        $total_fee = $subject >= 4
                                                            ? ($st->exam_fee * $subject) - $st->discount
                                                            : ($st->exam_fee * $subject);

                                                        $grandTotal += $total_fee;
                                                    @endphp 
                                                    <tr>
                                                        <td>{{ $sr++ }}</td> 
                                                        <td>{{ $st->admission_no }}</td>   
                                                        <td>{{ $st->full_name }} {{ $st->middle_name }} {{ $st->last_name }}</td>
                                                        <td>{{ $st->class_name }} ({{ $st->section }})</td>  
                                                        <td>{{ $st->subject_names }}</td>  
                                                        <td>{{ number_format($total_fee, 2) }}</td>
                                                        <td><input type="checkbox" class="form-control" name="details_verify"/></td>
                                                        <td><input type="checkbox" class="form-control" name="fee_status"/></td>
                                                        
                                                    </tr>
                                                @endforeach

                                                {{-- Total Fee Row --}}
                                                <tr>
                                                    <td colspan="5" class="text-end fw-bold">Total Fee</td>
                                                    <td class="fw-bold">{{ number_format($grandTotal, 2) }}</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>

                                                </tbody>
                                            </table>

                                            </div>
                                        </div>
                                    </div>
                               


                                        
                                            </div>
                                    
                                        </div>
                                </div>
						    </div>                              
					    </div>
				    </div>
			    </div>
		    </div>
	    </div>
	</div>

 
	<!-- [ Main Content ] end -->
	@endsection
	 