
@extends('layouts.admin')
 @section('content')

 <!-- DataTables CSS -->



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
                                            <table class="table" id="schoolTable">
                                                    <thead>
                                                        <tr>
                                                            <th>S.NO.</th>
                                                            <th>registered mobile<br/> number / email</th>
                                                            <th>School<br/>  Details </th>                   
                                                            <th>Head of School <br/>Details</th>
                                                            <th>Sprak Cordinator<br/> Details</th>
                                                            <th>Enrollment/Lab <br/>Details </th>
                                                            <th>Form <br/> Submitted </th>
                                                            <th>Last Updated <br/>Date </th>
                                                            <th>Action</th>                                                                                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $sr=1; @endphp
                                                        @foreach($data as $m)
                                                        <tr>
                                                            <td>{{$sr++}}</td>
                                                            <td>{{$m->email=='' ? $m->mobileno : $m->email}}</td>
                                                            
                                                             @if($m->bregistration_id === null)
                                                                <td><i class="fa fa-close text-danger text-center" aria-hidden="true"></i></td>  
                                                             @else
                                                                <td><i class="fa fa-check text-success text-center" aria-hidden="true"></i></td>  
                                                             @endif

                                                             @if($m->cregistration_id === null)
                                                                <td><i class="fa fa-close text-danger text-center" aria-hidden="true"></i></td>  
                                                             @else
                                                                <td><i class="fa fa-check text-success text-center" aria-hidden="true"></i></td>  
                                                             @endif

                                                             @if($m->dregistration_id === null)
                                                                <td><i class="fa fa-close text-danger text-center" aria-hidden="true"></i></td>  
                                                             @else
                                                                <td><i class="fa fa-check text-success text-center" aria-hidden="true"></i></td>  
                                                             @endif 

                                                             @if($m->eregistration_id === null)
                                                                <td><i class="fa fa-close text-danger text-center" aria-hidden="true"></i></td>  
                                                             @else
                                                                <td><i class="fa fa-check text-success text-center" aria-hidden="true"></i></td>  
                                                             @endif 

                                                             @if($m->fregistration_id === null)
                                                                <td><i class="fa fa-close text-danger text-center" aria-hidden="true"></i></td>  
                                                             @else
                                                                <td><i class="fa fa-check text-success text-center" aria-hidden="true"></i></td>  
                                                             @endif  

                                                             <td>{{$m->updated_at}}</td>
                                                            <td>
                                                            <a href="#"> <i class="fa fa-edit btn-primary fa-2x"></i>    </a>
                                                            <a href="{{route('manage.school.view',['id'=>$m->id])}}"> <i class="fa fa-eye btn-warning fa-2x"></i>    </a>
                                                               </td>
                                                                                                                        
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
 @push('scripts')
 <script>
    $(document).ready(function() {
        $('#schoolTable').DataTable({
            responsive: true,
            "pageLength": 10,
            "order": [[ 0, "asc" ]], // Sort by first column (S.NO.)
        });
    });
</script>

@endpush