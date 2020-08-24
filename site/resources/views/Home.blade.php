
@extends('Layout.app')
@section('title','HomePage')
@section('content')
    @include('Component.HomeBanner')
    @include('Component.HomeService')
    @include('Component.HomeCoursc')
    @include('Component.HomeProject')
    @include('Component.Contact')
    @include('Component.Rivew')
@endsection

