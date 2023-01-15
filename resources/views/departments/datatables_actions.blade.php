{!! Form::open(['route' => ['departments.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('show departments')
    <a href="{{ route('departments.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    @endcan
    @can('edit departments')
    <a href="{{ route('departments.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    @endcan
    @can('destroy departments')
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'

    ]) !!}
    @endcan
</div>
{!! Form::close() !!}
