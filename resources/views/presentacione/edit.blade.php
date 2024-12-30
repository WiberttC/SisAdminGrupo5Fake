@extends('template')

@section('title', 'Editar presentacion')

@push('css')
@endpush

@section('content')
    <div class="pagetitle">
        <h1 class="mt-4 text-center" style="font-size: 40px;">Editar Marca</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('presentaciones.index') }}">Presentaciones</a></li>
                <li class="breadcrumb-item active">Editar presentacion</li>
            </ol>
        </nav>

        <div class="card rounded-4">
            <div class="card-body">
                <h5 class="card-title">Formulario Presentacion</h5>

                <!-- General Form Elements -->
                <form action="{{ route('presentaciones.update', ['presentacione' => $presentacione]) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control"
                                value="{{ old('nombre', $presentacione->caracteristica->nombre) }}">
                            @error('nombre')
                                <small class="text-danger">{{ '>:( ' . $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" style="height: 100px">{{ old('descripcion', $presentacione->caracteristica->descripcion) }}</textarea>
                            @error('descripcion')
                                <small class="text-danger">{{ '>:( ' . $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="reset" class="btn btn-secondary">Reiniciar</button>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </div><!-- End Page Title -->

@endsection

@push('js')
@endpush
