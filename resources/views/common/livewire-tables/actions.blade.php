<div class='btn-group'>
    <a href="{{ $showUrl }}" class='btn btn-default btn-xs'>
        <em class="fa fa-eye"></em>
    </a>
    <a href="{{ $editUrl }}" class='btn btn-default btn-xs'>
        <em class="fa fa-edit"></em>
    </a>
    <a class='btn btn-danger btn-xs' wire:click="deleteRecord({{ $recordId }})"
       onclick="confirm('Are you sure you want to remove this Record?') || event.stopImmediatePropagation()">
        <em class="fa fa-trash"></em>
    </a>
</div>
