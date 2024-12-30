@extends('template')

@section('title', 'Crear Rol')

@push('css')
@endpush

@section('content')
    <div class="pagetitle">
        <h1 class="mt-4 text-center" style="font-size: 40px;">Crear Rol</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active">Crear Rol</li>
            </ol>
        </nav>

        <div class="card rounded-4">
            <div class="card-body">
                <h5 class="card-title">Formulario Categoria</h5>

                <!-- General Form Elements -->
                <form action="{{route('roles.store')}}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <!--Nombre de Rol-->
                        <div class="col-sm-10">
                            <label for="name" class="col-sm-2 col-form-label">Nombre del rol:</label>
                            <div class="col-sm-4">
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                            </div>

                            <div class="col-sm-6">
                                @error('name')
                                <small class="text-danger">{{">:( ".$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <!--Permisos-->
                        <div class="col-sm-10">
                            <label for="name" class="col-sm-2 col-form-label">Permisos para el rol:</label>
                            @foreach($permisos as $item)
                                <div class="form-check mb-2">
                                    <input type="checkbox" name="permission[]" id="{{$item->id}}" class="form-check-input" value="{{$item->id}}">
                                    <label for="{{$item->id}}" class="form-check-label">{{$item->name}}</label>
                                </div>
                            @endforeach
                            <div class="col-sm-6">
                                @error('permission')
                                <small class="text-danger">{{">:( ".$message}}</small>
                                @enderror
                            </div>
                        </div>


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
