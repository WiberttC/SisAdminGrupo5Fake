@extends('template')

@section('title', 'Crear marca')

@push('css')
    <style>
        #descripcion {
            resize: none;
        }
    </style>
@endpush

@section('content')
    <div class="pagetitle">
        <h1 class="mt-4 text-center" style="font-size: 40px;">Crear Marca</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('marcas.index') }}">Marcas</a></li>
                <li class="breadcrumb-item active">Crear Marca</li>
            </ol>
        </nav>

        <div class="card rounded-4">
            <div class="card-body">
                <h5 class="card-title">Formulario Marca</h5>

                <!-- General Form Elements -->
                <form action="{{ route('marcas.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control"
                                   value="{{ old('nombre') }}">
                            @error('nombre')
                            <small class="text-danger">{{ '>:( ' . $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" class="form-control"
                                      style="height: 100px">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                            <small class="text-danger">{{ '>:( ' . $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div><!-- End Page Title -->

@endsection

@push('js')
@endpush
