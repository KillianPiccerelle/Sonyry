<form method="post" action="{{ route($route) }}" class="comment-form contact-form" enctype="multipart/form-data">
@csrf
{{ $slot }}
    @if(!isset($noButton))
        <x-forms.button></x-forms.button>
    @endif
</form>
