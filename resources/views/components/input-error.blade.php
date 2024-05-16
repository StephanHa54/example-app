@props(['messages'])

@if ($messages)
    <ul class="input-error">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
