<div class="card text-center" {{ $attributes }}>
    <div class="card-header">
        <h5 class="card-title">{{$title ?? ''}}</h5>
    </div>

    <div class="card-body">
        @if(isset($img))
            <img src="{{$img}}" class="card-img-top" height="{{ $heightImage }}" width="{{ $widthImage }}">
        @endif
    </div>
    <div class="card-footer">

    </div>
</div>
