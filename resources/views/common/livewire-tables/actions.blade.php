<div class='btn-group'>
    <a href="{{ $showUrl }}" class='btn btn-default btn-xs'>
        <em class="fa fa-eye"></em>
    </a>
    <a href="{{ $editUrl }}" class='btn btn-default btn-xs'>
        <em class="fa fa-edit"></em>
    </a>
    <a class='btn btn-danger btn-xs' wire:click="deleteRecord({{ $recordId }})"
       onclick="confirm('¿Estas seguro que quieres eliminar este registro?') || event.stopImmediatePropagation()">
        <em class="fa fa-trash"></em>
    </a>
</div>
