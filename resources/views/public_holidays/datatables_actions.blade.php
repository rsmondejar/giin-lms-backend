{!! Form::open(['route' => ['public-holidays.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('show public holidays')
    <a href="{{ route('public-holidays.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    @endcan
    @can('edit public holidays')
    <a href="{{ route('public-holidays.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    @endcan
    @can('destroy public holidays')
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'

    ]) !!}
    @endcan
</div>
{!! Form::close() !!}
