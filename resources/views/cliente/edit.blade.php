@extends('template')

@section('title', 'Editar cliente')

@push('css')
@endpush

@section('content')
    <div class="pagetitle">
        <h1 class="mt-4 text-center" style="font-size: 40px;">Editar Cliente</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Cliente</a></li>
                <li class="breadcrumb-item active">Editar Cliente</li>
            </ol>
        </nav>

        <div class="card rounded-4">
            <div class="card-body">
                <h5 class="card-title">Formulario Clientes</h5>

                <!--  -->
                <form action="{{route('clientes.update',['cliente' => $cliente])}}" class="row g-3" method="POST">
                    @method('PATCH')
                    @csrf
                    <!--Tipo Persona-->
                    <div class="col-md-12">
                        <label for="tipo_persona" class="col-sm-2 col-form-label">Tipo Cliente: <span
                                class="fw-bolder">{{strtoupper($cliente->persona->tipo_persona)}}</span></label>
                    </div>

                    <!--Razon Social-->
                    <div class="cold-md-12" id="box-razon-social">
                        @if($cliente->persona->tipo_persona == 'natural')
                            <label id="label-natural" for="razon_social" class="form-label">Nombres y Apellidos</label>
                        @else
                            <label id="label-juridica" for="razon_social" class="form-label">Nombre de la
                                empresa</label>
                        @endif

                        <input required type="text" name="razon_social" id="razon_social" class="form-control"
                               value="{{old('razon_social',$cliente->persona->razon_social)}}">

                        @error('razon_social')
                        <small class="text-danger">{{ '>:( ' . $message }}</small>
                        @enderror
                    </div>

                    <!--Direccion-->
                    <div class="cold-md-6">
                        <label id="direccion" class="form-label">Direccion</label>
                        <input type="text" name="direccion" id="direccion" class="form-control"
                               value="{{old('direccion',$cliente->persona->direccion)}}">
                        @error('direccion')
                        <small class="text-danger">{{ '>:( ' . $message }}</small>
                        @enderror
                    </div>

                    <!--Documento-->

                    <div class="col-md-6">
                        <label for="documento_id" class=" col-form-label">Tipo de Documento:</label>
                        <select class="form-select" name="documento_id" id="documento_id">

                            @foreach($documentos as $item )
                                @if($cliente->persona->documento_id == $item->id)
                                    <option selected
                                            value="{{$item->id}}" {{old('documento_id') == $item->id ? 'selected' : '' }}>{{$item->tipo_documento}}</option>
                                @else
                                    <option
                                        value="{{$item->id}}" {{old('documento_id') == $item->id ? 'selected' : '' }}>{{$item->tipo_documento}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('documento_id')
                        <small class="text-danger">{{">:( ".$message}}</small>
                        @enderror
                    </div>


                    <!--Numero Documento-->
                    <div class="col-md-6 mb-2">
                        <label id="numero_documento" class=" col-form-label">Numero Documento</label>
                        <input type="text" name="numero_documento" id="numero_documento" class="form-control"
                               value="{{old('numero_documento',$cliente->persona->numero_documento)}}">
                        @error('numero_documento')
                        <small class="text-danger">{{ '>:( ' . $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div><!-- End Page Title -->

@endsection

@push('js')

@endpush
