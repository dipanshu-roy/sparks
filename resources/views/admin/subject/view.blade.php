
@extends('layouts.admin')
 @section('content')

 <section class="pcoded-main-container">
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
                                                <h5 class="m-b-10">Subject</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>                                                
                                                <li class="breadcrumb-item"><a href="#!">Subject List</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ breadcrumb ] end -->
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!-- [ basic-table ] start -->
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Subject List</h5> 
                                            <a href="{{route('subject.create')}}" class="btn btn-success float-right" title="" data-toggle="tooltip" data-original-title="btn btn-success">Add</a>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>SR</th>
                                                            <th>Subject </th>
                                                            <th>Class </th>
                                                            <th>Action</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $sr=1;@endphp
                                                    @foreach ($subjects as $subject) 
                                                             
                                                        <tr>
                                                            <td>{{$sr++}}</td>
                                                            <td>{{$subject->subject_name}}</td>
                                                            <td>{{$subject->class_names}}</td>
                                                            <td><a href="{{ route('subject.edit', ['subject' => $subject->id]) }}" class="btn btn-primary" title="" data-toggle="tooltip" data-original-title="btn btn-primary">Edit</a></td>
                                                             
                                                        </tr>
                                                   @endforeach     
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ basic-table ] end -->
                                <!-- [ inverse-table ] start -->
                             
                                
                                
                                        </div>
                                    </div>
                                </div>
                                <!-- [ Background-Utilities ] end -->
                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                 
    </section>
   


 @endsection