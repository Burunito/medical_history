@if(!$record->deleted_at)
    @if(auth()->user()->hasPermission('Mostrar-'.$permission))
    <a href="{{url("/$url/$record->id")}}" class="btn btn-dutch" title="Ver">
        <i class="fa fa-search"></i>
    </a>
    @endif
    @if(auth()->user()->hasPermission('Actualizar-'.$permission))
    <a href='{{ url("/$url/$record->id/edit") }}'>
        <button type="submit" class="btn btn-primary start" title="Actualizar">
            <i class="fa fa-edit"></i>
        </button>
    </a>
    @endif
    @if(auth()->user()->hasPermission('Eliminar-'.$permission))
    <button class="btn btn-danger" onclick="eliminar({{ $record->id }}, '{{ $url }}')" title="Eliminar">
        <i class="fa fa-trash"></i>
    </button>
    @endif
@else
    @if(auth()->user()->hasPermission('Recuperar-'.$permission))
    <button class="btn btn-success" onclick="recuperar({{ $record->id }}, '{{ $url }}')" title="Recuperar">
        <i class="fa fa-history"></i>
    </button>
    @endif
@endif