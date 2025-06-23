
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
                                                <h5 class="m-b-10">Exam Date</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}"><i class="feather icon-home"></i></a></li>                                                
                                                <li class="breadcrumb-item"><a href="#!">Exam Date List</a></li>
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
                                            <h5>Exam Date List</h5> 
                                            <a href="{{route('create.exam.date')}}" class="btn btn-success float-right" title="" data-toggle="tooltip" data-original-title="btn btn-success">Add</a>
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>SR</th>
                                                            
                                                            <th>Class </th>
                                                            <th>Exam Fee </th>
                                                            <th>Discount </th>
                                                            <th>Exam Date </th>
                                                            <th>Exam Last Date </th>
                                                            <th>Action</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $sr=1;@endphp
                                                         @foreach ($dates as $dt) 
                                                             
                                                            <tr>
                                                                <td>{{$sr++}}</td> 
                                                                <td>{{$dt->class_names}}</td>
                                                                <td>{{$dt->exam_fee}}</td>
                                                                <td>{{$dt->discount}}</td>                                                            
                                                                <td>{{ date('d-m-Y', strtotime($dt->shedule_date)) }}</td>
                                                                <td>{{ date('d-m-Y', strtotime($dt->exam_end_date)) }}</td>
                                                                <td><a href="{{route('edit.exam.date',['id'=>$dt->id])}}" class="btn btn-primary" title="" data-toggle="tooltip" data-original-title="btn btn-primary">Edit</a></td>
                                                                
                                                            </tr>
                                                             @endforeach    
                                                    </tbody>
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