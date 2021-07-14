{{-- <div class="message message-{{ $color }}">
    {{ $slot }}
</div> --}}
<div {{$attributes->merge(['class' => 'alert alert-'.$color])}}>
    {{ $slot }}
</div>