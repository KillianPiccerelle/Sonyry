<div class="form-group">
    <label for="{{$name}}">{{$label}}</label>
    <input type="{{ $type ?? 'text' }}" class="form-control" id="{{$name}}" name="{{$name}}" value="{{$value ?? ''}}" {{$attributes}}>
</div>


