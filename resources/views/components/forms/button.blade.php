<button type="{{$type ?? 'submit'}}" class="btn btn-{{$class ?? 'primary'}}" {{$attributes}}>
    <i class="fa fa-{{ $classIcon ?? 'check' }}" aria-hidden="true"></i>{{$text ?? ''}}
</button>
