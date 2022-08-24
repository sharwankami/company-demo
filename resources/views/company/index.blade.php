@extends('company.base')
@section('title', 'Company List')
@section('content')
    @php
    $searchTerm=Request::get('q');
    @endphp
    <div class="card mb-3">
        <div class="card-header">Vue Component</div>
        <div class="card-body">
            <div id="app">
                <companylist token="{{csrf_token()}}" q="{{$searchTerm}}" base_route="{{route('company.index')}}" ></companylist>
            </div>
        </div>
    </div>

    <p>
        <a class="btn btn-primary" href="{{route('company.new')}}">Add New Company</a>
    </p>
    <form action="{{route('company.index')}}" method="get">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search by organization number" value={{$searchTerm}} >
            @if(!is_null($searchTerm)) <a class="btn btn-secondary" href="{{route('company.index')}}">Clear</a> @endif
            <input class="btn btn-secondary" type="submit" value="Search"/>
        </div>
    </form>

    <table class="table">
        <thead>
        <tr>
            <td>Name</td>
            <td>Organization Number</td>
            <td>Created At</td>
            <td>Last Updated At</td>
            <td></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <td><a href="{{route('company.show', ['id'=> $company->id])}}">{{$company->name}}</a></td>
                <td>{{$company->organization_number}}</td>
                <td>{{$company->created_at->format('d.m.Y')}}</td>
                <td>{{$company->updated_at->format('d.m.Y H:i')}}</td>
                <td><a class="btn btn-sm btn-secondary" href="{{route('company.edit', ['id'=>$company->id])}}">Edit</a></td>
                <td>
                    <form action="{{route('company.destroy', ['id'=>$company->id])}}" method="post" onsubmit="return confirm('Are you sure to delete the company {{$company->name}}?');">
                        @method('delete')
                        @csrf
                        <input type="submit" value="Delete" class="btn btn-primary btn-sm">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{ $companies->onEachSide($page_size)->links('pagination::bootstrap-4') }}
    </div>

@endsection
