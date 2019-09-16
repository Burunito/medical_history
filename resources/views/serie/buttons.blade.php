@if($record->activo)
    @if(auth()->user()->hasPermission('Desactivar-'.$permission))
    <button class="btn btn-error" onclick="eliminar({{ $record->id }}, '{{ $url }}')" title="Desactivar">
        <i class="fa fa-toggle-off"></i>
    </button>
    @endif
@else
    @if(auth()->user()->hasPermission('Reactivar-'.$permission))
    <button class="btn btn-success" onclick="recuperar({{ $record->id }}, '{{ $url }}')" title="Reactivar">
        <i class="fa fa-toggle-on"></i>
    </button>
    @endif
@endif