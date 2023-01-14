<div class="card">

    @include('adminlte-templates::common.errors')
    @include('flash::message')

    {!! Form::open(['route' => 'leaves.store']) !!}

    <div class="card-body">
        <div class="row">
            <h2 class="h4">Solicitar vacaciones</h2>
        </div>
        <div class="row">

            <div class="form-group col-sm-6">
                {!! Form::label('type_id', 'Seleccionar tipo:') !!}
                {!! Form::select('type_id', $leaveTypes, null, ['class' => 'form-control js-select2']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('requested_to_user_id', 'Seleccionar Responsable:') !!}
                {!! Form::select('requested_to_user_id', $managers, null, ['class' => 'form-control js-select2']) !!}
            </div>

            <div class="form-group col-sm-12">
                {!! Form::label('emails', 'Enviar email informativo:') !!}
                {!! Form::text('emails', null, [
                    'class' => 'form-control',
                    'required' => false,
                    'maxlength' => \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH,
                    'placeHolder' => 'Agregar direcciones de email si se desea',
                    'aria-describedby' => "emailsHelpBlock",
                ]) !!}
                <small id="emailsHelpBlock" class="form-text text-muted">
                    Opcional.
                    Longitud máxima: {!! \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH !!} caracteres.
                    Si se desea agregar varias direcciones de email, separar con ";".
                </small>
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('dates', 'Seleccionar días:') !!}
                {!! Form::text('dates', null,  [
                    'id' => 'datePick',
                    'class' => 'form-control',
                ]) !!}
            </div>

            <div class="form-group col-sm-12">
                {!! Form::label('comment', 'Comentario:') !!}
                {!! Form::text('comment', null, [
                    'class' => 'form-control',
                    'required' => false,
                    'maxlength' => \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH,
                    'placeHolder' => 'Indicar motivo',
                    'aria-describedby' => "commentHelpBlock",
                ]) !!}
                <small id="commentHelpBlock" class="form-text text-muted">
                    Opcional.
                    Longitud máxima: {!! \App\Providers\AppServiceProvider::DEFAULT_STRING_LENGTH !!} caracteres
                </small>
            </div>
        </div>
    </div>

    <div class="card-footer">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>

@push('page_scripts')
    <script type="module">
        $(function () {
            flatpickr("#datePick", {
                mode: "multiple",
                dateFormat: "Y-m-d",
                disable: {!! $datesToDisable !!},
            });
        });
    </script>
@endpush
