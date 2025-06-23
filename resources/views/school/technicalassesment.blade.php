@extends('layouts.school')
@section('content')
<style>
  .services-list a.active {
    font-weight: bold;
    color: #0d6efd;
  }

  .card-style {
    border: 1px solid #ccc;
    padding: 15px;
    border-radius: 8px;
    background-color: #fff;
    margin-bottom: 15px;
  }

  .lab-checkbox-grid {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .checkbox-row {
    display: flex;
    justify-content: flex-start;
    gap: 10px;
  }

  .checkbox-container {
    position: relative;
    width: 100%;
    height: 35px;
  }

  .checkbox-container input[type="checkbox"] {
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    position: absolute;
    left: 0;
    top: 0;
    z-index: 2;
  }

  .check-icon {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 11px;
    background-color: #f0f0f0;
    border: 2px solid #ccc;
    border-radius: 5px;
    color: red;
    z-index: 1;
  }

  .check-icon.checked {
    color: green;
  }

  







  .checkbox-container {
        display: inline-block;
        margin: 4px;
    }

    .checkbox-container input[type="checkbox"] {
        display: none;
    }

    .check-icon {
        display: inline-block;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f0f0f0;
        font-weight: bold;
        color: black;
        transition: background-color 0.2s;
    }

    .check-icon.checked {
        background-color: #4CAF50;
        color: white;
    }
</style>

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
												<h5>Technical Assessment</h5>
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
											<ul class="nav nav-tabs" role="tablist">
												@for($i = 0; $i < $enrollment_details->total_com_labs; $i++)
													<li class="nav-item">
														<a class="nav-link text-uppercase {{ $i == 0 ? 'active' : '' }}"
														id="tab-{{ $i }}-tab"
														data-toggle="tab"
														href="#tab-{{ $i }}"
														role="tab"
														aria-controls="tab-{{ $i }}"
														aria-selected="{{ $i == 0 ? 'true' : 'false' }}">
															Lab - {{ $i + 1 }}
														</a>
													</li>
												@endfor
											</ul>

												<div class="tab-content" id="myTabContent">
													@for($i = 0; $i < $enrollment_details->total_com_labs; $i++)
														<div class="tab-pane fade {{ $i == 0 ? 'show active' : '' }}"
															id="tab-{{ $i }}"
															role="tabpanel"
															aria-labelledby="tab-{{ $i }}-tab">
															
															{!! Genrate_dynamic_box("Lab".$i + 1) !!}
														 
														</div>
													@endfor
												</div>
												<div class="tab-content text-right">
												<button class="btn btn-primary">Certify selected computer</button>


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
	@push('scripts')

	<script>
    function toggleIcon(id) {
        // Uncheck all checkboxes in the row
        const checkboxes = document.querySelectorAll('.checkbox-container input[type="checkbox"]');
        checkboxes.forEach(cb => {
            if (cb.id !== id) {
                cb.checked = false;
                document.getElementById('icon-' + cb.id).textContent = '✖';
                document.getElementById('icon-' + cb.id).classList.remove('checked');
            }
        });

        // Toggle current checkbox
        const checkbox = document.getElementById(id);
        const icon = document.getElementById('icon-' + id);

        if (checkbox.checked) {
            icon.textContent = '✔';
            icon.classList.add('checked');
        } else {
            icon.textContent = '✖';
            icon.classList.remove('checked');
        }
    }
</script>


	 @endpush