@extends('adminlte::page')

@section('title', $content_header)

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $content_header }}</h3>
        </div>
        {{ Form::open(['route' => 'usuarios.update', 'id' => 'form_usuario']) }}
            <div class="box-body">
                <div class="form-group col-md-6">
                    {{ Form::label('Nome:', null, ['class' => 'control-label']) }}
                    {{ Form::text('name', (isset($usuario->name) && !empty($usuario->name) ? $usuario->name : ''), ['class' => 'form-control', 'id' => 'name']) }}
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('Email:', null, ['class' => 'control-label']) }}
                    {{ Form::text('email', (isset($usuario->email) && !empty($usuario->email) ? $usuario->email : ''), ['class' => 'form-control', 'id' => 'email', 'readonly' => true]) }}
                </div>

                <div class="form-group col-md-6">
                    {{ Form::label('Senha:', null, ['class' => 'control-label']) }}
                    {{ Form::password('password', ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="box-footer">
                <input type="hidden" name="id" value="{{ (isset($usuario->id) && !empty($usuario->id) ? $usuario->id : '') }}" />
                {{ Form::button('Salvar', ['class' => 'btn btn-primary', 'id' => 'btn-salvar', 'type' => 'button']) }}
                {{ link_to_route('muambas.index', 'Cancelar', null, ['class' => 'btn btn-warning']) }}
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/usuarios/form.js') }}"></script>
@stop
