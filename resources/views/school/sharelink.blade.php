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
												<h5>Share Link</h5>
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
	</div>

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

	<!-- [ Main Content ] end -->
	@endsection
	@push('scripts')
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