@extends('Layout.app')
@section('title','Home')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$contactData}}</h3>
                    <h3 class="count-card-text">Total contact</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$CourseData}}</h3>
                    <h3 class="count-card-text">Total Course</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$ProjectData}}</h3>
                    <h3 class="count-card-text">Total Project</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$RivewDAta}}</h3>
                    <h3 class="count-card-text">Total visitor</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$serviceData}}</h3>
                    <h3 class="count-card-text">Total service</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$visitorData}}</h3>
                    <h3 class="count-card-text">Total visitor</h3>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection
