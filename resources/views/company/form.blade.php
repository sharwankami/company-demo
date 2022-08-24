    <div class="">
        <form action="{{route('company.update', ['id'=>$company->id ?? ""])}}" method="post">
            @csrf
            @foreach($fields as $field)
                <x-form-input
                    :options="($field=='country')?App\Utils\Utils::getCountries():[]"
                    :type="($field=='country')? 'select' : 'input'"
                    :name="$field"
                    :label="App\Utils\Utils::titleCase($field)"
                    :value="old($field, $company->{$field} ?? '')"/>
            @endforeach
{{--
            <div class="mb-3">
                <label for="name">Organization Number</label>
                <input class="form-control" type ="text" name="organization_number" value="{{$company->organization_number ?? ""}}">
                @error('organization_number')
                <small class="form-text text-muted">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name">Street Name</label>
                <input class="form-control" type ="text" name="street_name" value="{{$company->street_name ?? ""}}">
                @error('street_name')
                <small class="form-text text-muted">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name">House Number</label>
                <input class="form-control" type ="text" name="house_number" value="{{$company->house_number ?? ""}}">
                @error('house_number')
                <small class="form-text text-muted">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name">Zipcode</label>
                <input class="form-control" type ="text" name="zip_code" value="{{$company->zip_code ?? ""}}">
                @error('zip_code')
                <small class="form-text text-muted">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name">Country</label>
                <select name="country" class="form-control">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{$country['code']}}" @if(old('country', $company->country) == $country['code']) selected @endif>{{$country['name']}}</option>
                    @endforeach
                </select>
                @error('country')
                <small class="form-text text-muted">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name">Phone</label>
                <input class="form-control" type ="text" name="phone" value="{{$company->phone ?? ""}}">
                @error('phone')
                <small class="form-text text-muted">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name">Email</label>
                <input class="form-control" type ="email" name="email" value="{{$company->email ?? ""}}">
                @error('email')
                <small class="form-text text-muted">{{ $message }}</small>
                @enderror
            </div>--}}
            <div class="mb-3">
                <input class="btn btn-primary" type ="submit" value="Save Company"/>
            </div>
        </form>
    </div>
