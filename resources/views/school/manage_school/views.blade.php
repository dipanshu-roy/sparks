
@extends('layouts.admin')
 @section('content')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                                                <h5 class="m-b-10">Manage Schools</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>                                                
                                                <li class="breadcrumb-item"><a href="#!">School Registration List</a></li>
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
                                            <h5>School Registration List</h5> 
                                            <!-- <a href="#" class="btn btn-success float-right" title="" data-toggle="tooltip" data-original-title="btn btn-success">Add</a> -->
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                            <table class="table">
    <thead>
        <tr>
            <th>Field</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>ID</td><td>{{ $data->id }}</td></tr>
        <tr><td>Updated At</td><td>{{ $data->updated_at }}</td></tr>
        <tr><td>Email</td><td>{{ $data->email }}</td></tr>
        <tr><td>Mobile</td><td>{{ $data->mobile }}</td></tr>
        <tr><td>Board </td><td>{{ $data->school_board }}</td></tr>
        <tr><td>School Name</td><td>{{ $data->school_name }}</td></tr>
        <tr><td>State </td><td>{{ $data->school_state }}</td></tr>
        <tr><td>District </td><td>{{ $data->school_distric }}</td></tr>
        <tr><td>City </td><td>{{ $data->school_city }}</td></tr>
        <tr><td>Title </td><td>{{ $data->head_title }}</td></tr>
        <tr><td>First Name</td><td>{{ $data->first_name }}</td></tr>
        <tr><td>Second Name</td><td>{{ $data->second_name }}</td></tr>
        <tr><td>Last Name</td><td>{{ $data->last_name }}</td></tr> 
        <tr><td>Designation</td><td>{{ $data->head_designation }}</td></tr>
        <tr><td>Title </td><td>{{ $data->coordinator_title }}</td></tr>
        <tr><td>First Name</td><td>{{ $data->cfirst_name }}</td></tr>
        <tr><td>Second Name</td><td>{{ $data->csecond_name ?? 'N/A' }}</td></tr>
        <tr><td>Last Name</td><td>{{ $data->clast_name ?? 'N/A' }}</td></tr>
        <tr><td>Mobile</td><td>{{ $data->cmobile ?? 'N/A' }}</td></tr>
        <tr><td>Email</td><td>{{ $data->cemail ?? 'N/A' }}</td></tr>
        <tr><td>Designation</td><td>{{ $data->coordinator_designation }}</td></tr>
        <tr><td>Total Enrollment</td><td>{{ $data->total_enrollment }}</td></tr>
        <tr><td>Class 1 to 8 Enroll</td><td>{{ $data->class_1_to_8_enroll }}</td></tr>
        <tr><td>Total Computer Labs</td><td>{{ $data->total_com_labs }}</td></tr>
        <tr><td>School URL</td><td><a href="{{ $data->school_url }}" target="_blank">{{ $data->school_url }}</a></td></tr>
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


