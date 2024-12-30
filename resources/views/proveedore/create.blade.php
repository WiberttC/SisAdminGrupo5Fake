@extends('template')

@section('title', 'Crear Proveedor')

@push('css')
    <style>
        #box-razon-social{
            display: none;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('content')
    <div class="pagetitle">
        <h1 class="mt-4 text-center" style="font-size: 40px;">Crear Proveedores</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
                <li class="breadcrumb-item active">Crear Proveedor</li>
            </ol>
        </nav>

        <div class="card rounded-4">
            <div class="card-body">
                <h5 class="card-title">Formulario Proveedor</h5>

                <!--  -->
                <form action="{{route('proveedores.store')}}" class="row g-3" method="POST">
                    @csrf
                    <!--Tipo Persona-->
                        <div class="col-md-12">
                            <label for="tipo_persona" class="col-sm-2 col-form-label">Tipo Proveedor:</label>
                            <select class="form-select" name="tipo_persona" id="tipo_persona">
                                <option value="" selected disabled>Selecciona una Opcion</option>
                                <option value="natural" {{old('tipo_persona') == 'natural' ? 'selected' : '' }}>Persona natural</option>
                                <option value="juridica" {{old('tipo_persona') == 'juridica' ? 'selected' : '' }}>Persona juridica</option>
                            </select>
                            @error('tipo_persona')
                            <small class="text-danger">{{">:( ".$message}}</small>
                            @enderror
                        </div>

                    <!--Razon Social-->
                    <div class="cold-md-12" id="box-razon-social">
                        <label id="label-natural" for="razon_social" class="form-label">Nombres y Apellidos</label>
                        <label id="label-juridica" for="razon_social" class="form-label">Nombre de la empresa</label>

                        <input required type="text" name="razon_social" id="razon_social" class="form-control" value="{{old('razon_social')}}">

                        @error('razon_social')
                        <small class="text-danger">{{ '>:( ' . $message }}</small>
                        @enderror
                    </div>

                    <!--Direccion-->
                    <div class="cold-md-6" >
                        <label id="direccion" class="form-label">Direccion</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion')}}">
                        @error('direccion')
                        <small class="text-danger">{{ '>:( ' . $message }}</small>
                        @enderror
                    </div>

                    <!--Documento-->

                        <div class="col-md-6">
                            <label for="documento_id" class=" col-form-label">Tipo de Documento:</label>
                            <select class="form-select" name="documento_id" id="documento_id">
                                <option value="" selected disabled>Selecciona una Opcion</option>
                                @foreach($documentos as $item )
                                    <option value="{{$item->id}}" {{old('documento_id') == $item->id ? 'selected' : '' }}>{{$item->tipo_documento}}</option>
                                @endforeach
                            </select>
                            @error('documento_id')
                            <small class="text-danger">{{">:( ".$message}}</small>
                            @enderror
                        </div>


                    <!--Numero Documento-->
                    <div class="col-md-6 mb-2" >
                        <label id="numero_documento" class=" col-form-label">Numero Documento</label>
                        <input type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{old('numero_documento')}}">
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
    <script>
        $(document).ready(function(){
            $('#tipo_persona').on('change',function (){
                let selectValue = $(this).val();

                if(selectValue == 'natural'){
                    $('#label-juridica').hide();
                    $('#label-natural').show();
                }else{
                    $('#label-natural').hide();
                    $('#label-juridica').show();
                }

                $('#box-razon-social').show();
            });
        });
    </script>
@endpush
