@php
    if(session('success'))   $type = 'success';
    if(session('info'))      $type = 'info';
    if(session('warning'))   $type = 'warning';
    if(session('danger'))    $type = 'danger';
@endphp

@if (isset($type))
<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
    <strong>{{ session($type) }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
