@extends('company.base')
@section('title', 'Company Details')
@section('content')
    <p><a href="{{url()->previous()}}">back</a></p>
    @if (is_null($company))
        Company does not exists. Please check the id provided.
    @else
        <div>
            <dl>
                <dt>Company name</dt><dd>{{$company->name}} </dd>
                <dt>Organization number</dt><dd>{{$company->organization_number}} </dd>
                <dt>Street name</dt><dd>{{$company->street_name}} </dd>
                <dt>House number</dt><dd>{{$company->house_number}} </dd>
                <dt>Zipcode</dt><dd>{{$company->zip_code}} </dd>
                <dt>Country</dt><dd>{{$company->country}} </dd>
                <dt>Phone</dt><dd>{{$company->phone}} </dd>
                <dt>Email</dt><dd>{{$company->email}} </dd>
            </dl>

        </div>
    @endif

@endsection
