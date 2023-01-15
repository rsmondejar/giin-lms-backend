{!! Form::open(['route' => ['businesses.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('show businesses')
    <a href="{{ route('businesses.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    @endcan
    @can('edit businesses')
    <a href="{{ route('businesses.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    @endcan
    @can('destroy businesses')
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'

    ]) !!}
    @endcan
</div>
{!! Form::close() !!}
