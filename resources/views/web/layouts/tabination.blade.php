@php
    $schoolid = Session::get('schoolid');
    $school = App\Models\SchoolDetails::where('registration_id', $schoolid)->exists();
    $head_of_school = App\Models\Headofschool::where('registration_id', $schoolid)->exists();
    $spark_cordinator = App\Models\SparkCordinator::where('registration_id', $schoolid)->exists();
    $school_enrolment = App\Models\Schoolenrolment::where('registration_id', $schoolid)->exists();
@endphp

<div class="services-list">
    <a href="{{ route('school.create') }}" class="{{ Request::is('school-create') ? 'active' : '' }}">
        @if($school)
            <i class="fa fa-check" style="font-size:20px;color:rgb(87 183 42)"></i>
        @endif
        School Profile
    </a>

    <a href="{{ route('head.of.school') }}" class="{{ Request::is('head-of-school-info') ? 'active' : '' }}">
        @if($head_of_school)
            <i class="fa fa-check" style="font-size:20px;color:rgb(87 183 42)"></i>
        @endif
        Head Of School
    </a>

    <a href="{{ route('spark.cordinator') }}" class="{{ Request::is('spark-cordinator') ? 'active' : '' }}">
        @if($spark_cordinator)
            <i class="fa fa-check" style="font-size:20px;color:rgb(87 183 42)"></i>
        @endif
        Spark Coordinator
    </a>

    <a href="{{ route('school_enroll.create') }}" class="{{ Request::is('school-enroll') ? 'active' : '' }}">
        @if($school_enrolment)
            <i class="fa fa-check" style="font-size:20px;color:rgb(87 183 42)"></i>
        @endif
        Computers Available
    </a>
</div>
