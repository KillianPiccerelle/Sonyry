<form method="post" action="{{ route($route,$parameters ?? '') }}" class="comment-form contact-form" enctype="multipart/form-data" {{$attributes}}>
@csrf
{{ $slot }}
    @if(!isset($noButton))
        <x-forms.button></x-forms.button>
    @endif
</form>
