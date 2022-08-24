@extends('company.base')
@section('title', 'Company Details')
@section('content')
    @if($editing==true and is_null($company))
        <p>Company not found. Do you like to create <a href="{{route('company.new')}}">new company</a>?</p>
    @else
        <div>
            <p><a href="{{url()->previous()}}">back</a></p>
            @include("company.form")
        </div>
    @endif
@endsection
