
@extends('web.layouts.app')
@section('content')
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-10">
                        <h1>Student Enrollment</h1>
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

                        <form  method="GET" action="{{route('students.create')}}">
                            <input type="hidden" name="R&M" value="@php echo Str::random(150); @endphp">    
                            @csrf
                                <input type="hidden" name="school_id" value="{{$code}}">
                                <div class="mb-3">
                                <label id="label">Enter admission/enrollment no.</label>
                                <input type="text"  name="admno" class="form-control" placeholder="Enter admission/enrollment no." required autocomplete="off" />
                                <div id="mobile-error" class="text-danger small mt-1"></div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Proceed To Next</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush