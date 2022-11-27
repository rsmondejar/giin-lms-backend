<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="roles-table" aria-label="roles table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Guard Name</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('roles.show', [$role->id]) }}"
                               class='btn btn-default btn-xs'>
                                <em class="far fa-eye"></em>
                            </a>
                            <a href="{{ route('roles.edit', [$role->id]) }}"
                               class='btn btn-default btn-xs'>
                                <em class="far fa-edit"></em>
                            </a>
                            {!! Form::button('<em class="far fa-trash-alt"></em>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('Are you sure?')"
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $roles])
        </div>
    </div>
</div>
