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
												<h5>Dashboard</h5>
											</div>
											<ul class="breadcrumb">
												<li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
												<li class="breadcrumb-item"><a href="#">Welcome {{$hs1->school_name}}</a></li>
											</ul>
										</div>
									</div>
								</div>
							</div> 
							<div class="row">

						

								<!-- product profit start -->
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-red">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Total Schools</h6>
													<h3 class="m-b-0 text-white">1</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-money-bill-alt text-c-red f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white d-none"><span class="label label-danger m-r-10">+11%</span>From Previous Month</p>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-blue">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Total Students</h6>
													<h3 class="m-b-0 text-white">1</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-database text-c-blue f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white d-none"><span class="label label-primary m-r-10">+12%</span>From Previous Month</p>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-green">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Total Cordinators</h6>
													<h3 class="m-b-0 text-white">1</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-dollar-sign text-c-green f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white d-none"><span class="label label-success m-r-10">+52%</span>From Previous Month</p>
										</div>
									</div>
								</div>

								<div class="col-xl-3 col-md-6">
									<div class="card prod-p-card bg-c-yellow">
										<div class="card-body">
											<div class="row align-items-center m-b-25">
												<div class="col">
													<h6 class="m-b-5 text-white">Total Computers/Labs</h6>
													<h3 class="m-b-0 text-white">1</h3>
												</div>
												<div class="col-auto">
													<i class="fas fa-tags text-c-yellow f-18"></i>
												</div>
											</div>
											<p class="m-b-0 text-white d-none"><span class="label label-warning m-r-10">+52%</span>From Previous Month</p>
										</div>
									</div>
								</div>
							 
								 
							 
								@if($hs->is_validate!=1)
							      <div class="col-md-12 col-xl-12">
									<div class="card card-social">										 
										<div class="card-block">										 
											<div class="row">
										@if($hs->is_validate!=1)

										<div class="alert alert-danger d-flex justify-content-between align-items-center col-md-6" role="alert">
    										<div><img src="{{asset('feathericons/alert-triangle.svg')}}">  <strong>Verify!</strong>  your Google Account
											</div>
    										<button type="button" class="btn btn-sm btn-warning">Verify Now</button>
  										</div> 
										
										@endif 
										
										@if($hs->is_mobile_validate !=1)
										<div class="alert alert-danger d-flex justify-content-between align-items-center col-md-6" role="alert">
    										<div> <img src="{{asset('feathericons/alert-triangle.svg')}}"> <strong>Verify!</strong> your Mobile Number.</div>
    										<button type="button" class="btn btn-sm btn-warning">Verify Now</button>
  											</div>
										</div>
										@endif

									</div>
									</div>
								</div>
								@endif
							</div>
							<div class="row">
 
 <div class="col-md-12 col-xl-12">
	  <div class="card card-social">										 
		  <div class="card-block">										 
		  <form id="shareForm" action="{{ route('store.school.share.link') }}" method="POST">
				  @csrf
				  <input type="hidden" class="form-control" id="link" name="link" readonly value="{{$url->school_url.'/st'}}">
				  <input type="hidden" class="form-control"  name="id" readonly value="{{ $links_list->id ?? '' }}">
				  <div class="row">
					  <div class="mb-3 col-xl-6">
						  <label class="form-label">Select Date </label><br>

						  @foreach($exam_shedule as $es)
							  <div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="date_id" id="date_{{$es->id}}" value="{{$es->id}}"
								  {{ ($links_list->date_id ?? null) == $es->id ? 'checked' : '' }}
								  >
								  <label class="form-check-label" for="date_{{$es->id}}">
									  {{ date('d-m-Y', strtotime($es->shedule_date)) }}
								  </label>
							  </div>
						  @endforeach
						   
						  <button type="button" id="generateBtn" class="btn btn-primary mt-3">Generate Link</button>

					  </div> 
				  </div>
			  </form>

		   @if($links_list)
				  <div class="mb-3 col-xl-12">
					  <label for="link" class="form-label">Link</label>
					  <input type="text"  class="form-control" id="link" name="link" placeholder="Enter text here" readonly value="{{$url->school_url.'/st'}}">
				  </div>

				  <div class="mb-3 col-xl-12">
				  <button id="btn" class="btn btn-success">Copy Link For Email/Whatsapp</button>
				  <button id="btn1" class="btn btn-success">Copy Link For SMS</button>
				  
				  </div>
				  @endif									 
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
	<div class="modal fade" id="linkModal" tabindex="-1" aria-labelledby="linkModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="linkModalLabel">Copy Link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="popupLink" class="form-control" readonly>
        <button class="btn btn-primary mt-3" onclick="copyPopupLink()">Copy</button>
        <div id="copyStatus" class="mt-2 text-success d-none">Copied!</div>
      </div>
    </div>
  </div>
</div>






<!-- Password Change Modal -->

@if ($user->fist_chanege_pass==0)
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('first.password.update') }}" id="passwordForm">
        @csrf
		@method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Change Your Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- New Password -->
                <div class="mb-3 position-relative">
                    <label for="password">New Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                            👁️
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3 position-relative">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation">
                            👁️
                        </button>
                    </div>
                    <small id="passwordError" class="text-danger d-none">Passwords do not match.</small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endif










	<!-- [ Main Content ] end -->
	@endsection
	@push('scripts')
	@if ($user->fist_chanege_pass==0)
	<script>
    document.addEventListener("DOMContentLoaded", function () {
        var passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'));
        passwordModal.show();

        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', function () {
                const input = document.getElementById(this.getAttribute('data-target'));
                input.type = input.type === 'password' ? 'text' : 'password';
            });
        });

        // Password match check
        const form = document.getElementById('passwordForm');
        const error = document.getElementById('passwordError');
        form.addEventListener('submit', function (e) {
            const pw = document.getElementById('password').value;
            const cpw = document.getElementById('password_confirmation').value;
            if (pw !== cpw) {
                e.preventDefault();
                error.classList.remove('d-none');
            } else {
                error.classList.add('d-none');
            }
        });
    });
</script>
@endif

	<script>
document.addEventListener("DOMContentLoaded", function() {
    const linkInput = document.getElementById("link");
    const popupLink = document.getElementById("popupLink");
    const copyStatus = document.getElementById("copyStatus");

    const modalElement = document.getElementById("linkModal");
    const bsModal = new bootstrap.Modal(modalElement);

    document.getElementById("btn").addEventListener("click", function () {
        const linkValue = linkInput.value;
        popupLink.value = linkValue;
        copyStatus.classList.add("d-none");
        bsModal.show();
    });

    document.getElementById("btn1").addEventListener("click", function () {
        const linkValue = linkInput.value;
        popupLink.value = linkValue;
        copyStatus.classList.add("d-none");
        bsModal.show();
    });
});

function copyPopupLink() {
    const copyText = document.getElementById("popupLink");
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
    navigator.clipboard.writeText(copyText.value).then(() => {
        document.getElementById("copyStatus").classList.remove("d-none");
    });
}


 
document.getElementById('generateBtn').addEventListener('click', function (e) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You are about to generate and share the link.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, generate it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('shareForm').submit();
        }
    });
}); 

</script>

     @endpush