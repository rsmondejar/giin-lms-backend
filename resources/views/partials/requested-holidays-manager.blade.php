<div class="card">
    <div class="card-body">
        <div class="row">
            <h2 class="h4">Listado de vacaciones solicitadas</h2>

            <table class="table table-striped table-bordered table-condensed" aria-label="Listado de vacaciones">
                <thead>
                <tr>
                    <th>Id.</th>
                    <th>Usuario</th>
                    <th>Responsable</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Días</th>
                    <th>Comentario</th>
                    <th>Eliminar?</th>
                </tr>
                </thead>
                <tbody>
                @foreach($leaves as $leave)
                    <tr>
                        <td>{!! $leave->id !!}</td>
                        <td>{!! $leave->user->name !!}</td>
                        <td>{!! $leave->manager->name !!}</td>
                        <td>{!! $leave->type->name !!}</td>
                        <td>{!! $leave->state->name !!}</td>
                        <td>
                            <ol>
                                @foreach($leave->dates as $date)
                                    <li>{!! $date->date->format('d/m/Y') !!}</li>
                                @endforeach
                            </ol>
                        </td>
                        <td>{!! $leave->comment !!}</td>
                        <td>
                            {!! Form::open(['route' => ['team-holidays.approve', $leave->id], 'method' => 'put']) !!}
                            {!! Form::button('<i class="fa fa-check"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-info btn-xs',
                                'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'

                            ]) !!}
                            {!! Form::close() !!}

                            {!! Form::open(['route' => ['team-holidays.reject', $leave->id], 'method' => 'put']) !!}
                            {!! Form::button('<i class="far fa-window-close"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'

                            ]) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
