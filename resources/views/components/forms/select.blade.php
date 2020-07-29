<div class="form-group">
    <label for="exampleFormControlSelect1">{{$label}}</label>
    <select class="form-control" id="{{$name}}" name="{{$name}}">
        @foreach($items as $item)
            @if(isset($value) and $value==$item->id)
                <option value="{{$item->id}}" selected="">{{$item->title}}</option>
            @else
                <option value="{{$item->id}}">{{$item->label}}</option>
            @endif
        @endforeach
    </select>
</div>
