<div class="card" {{ $attributes }}>
    @if(isset($img))
    <img src="{{$img}}" class="card-img-top">
    @endif
    <div class="card-body bg-primary">
        <h5 class="card-title">{{$title ?? ''}}</h5>
        <p class="card-text">
        {{$slot}}
    </div>
</div>
