@foreach(['danger', 'warning', 'success', 'info'] as $message)
    @if(session()->has($message))
        <div class="alert alert-{{$message}}" role="alert">
            {{ session()->get($message) }}
        </div>
    @endif
@endforeach
