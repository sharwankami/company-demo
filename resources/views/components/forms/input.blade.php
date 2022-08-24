<div class="mb-3">
    <label for="{{$name}}">{{$label}}</label>
    @if($type=='select')
        <select id="{{$name}}" name="{{$name}}" class="form-control @error($name) border-danger @enderror">
            <option value="">Select {{$label}}</option>
            @foreach($options as $option)
                <option value="{{$option['code']}}" @if($value == $option['code']) selected @endif>{{$option['name']}}</option>
            @endforeach
        </select>
    @else
        <input id="{{$name}}" name="{{$name}}" type="{{$type}}" value="{{$value}}" class="form-control @error($name) border-danger @enderror" />
    @endif

    @error($name)
    <small class="form-text text-danger">{{$message}}</small>
    @enderror
</div>
