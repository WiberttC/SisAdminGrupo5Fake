@extends('template')

@section('title', 'Editar producto')

@push('css')
    <style>
        #descripcion {
            resize: none;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('content')
    <div class="pagetitle">
        <h1 class="mt-4 text-center" style="font-size: 40px;">Crear Presentaciones</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
                <li class="breadcrumb-item active">Editar Producto</li>
            </ol>
        </nav>

        <div class="card rounded-4">
            <div class="card-body">
                <h5 class="card-title">Formulario Presentaciones</h5>

                <!-- General Form Elements -->
                <form action="{{route('productos.update',['producto'=>$producto])}}" method="POST" class="row g-3" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <!--Codigo-->
                    <div class="col-md-6">
                        <label for="codigo" class="col-sm-2 col-form-label">Codigo:</label>
                        <input type="text" name="codigo" id="codigo" class="form-control"
                               value="{{ old('codigo',$producto->codigo) }}">
                        @error('codigo')
                        <small class="text-danger">{{ '>:( ' . $message }}</small>
                        @enderror
                    </div>

                    <!--Nombre-->
                    <div class="col-md-6">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre',$producto->nombre) }}">
                        @error('nombre')
                        <small class="text-danger">{{ '>:( ' . $message }}</small>
                        @enderror
                    </div>

                    <!--Descripcion-->
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <label for="descripcion" class="col-sm-2 col-form-label">Descripcion:</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" style="height: 100px">{{ old('descripcion',$producto->descripcion) }}</textarea>
                            @error('descripcion')
                            <small class="text-danger">{{ '>:( ' . $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!--Fecha-->
                    <div class="col-md-6 mb-2">
                        <label for="fecha_vencimiento" class="col-sm-4 col-form-label">Fecha de Ingreso:</label>
                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso',$producto->fecha_ingreso) }}">
                        @error('fecha_ingreso')
                        <small class="text-danger">{{ '>:( ' . $message }}</small>
                        @enderror
                    </div>

                    <!--Imagen-->
                    <div class="col-md-6">
                        <label for="img_path" class="col-sm-2 col-form-label">Imagen:</label>
                        <input type="file" name="img_path" id="img_path" class="form-control" accept="Image/*" >
                        @error('img_path')
                        <small class="text-danger">{{ '>:( ' . $message }}</small>
                        @enderror
                    </div>

                    <!--Marca-->
                    <div class="col-md-6">
                        <label for="marca_id" class="col-sm-3 col-form-label">Marca:</label>
                        <select data-size="4" title="Selecione una marca" data-live-search="true" name="marca_id" id="marca_id" class="form-control selectpicker show-tick">
                            @foreach($marcas as $item)
                                @if($producto->marca_id == $item->id)
                                    <option selected value="{{$item->id}}" {{ old('marca_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                @else
                                    <option value="{{$item->id}}" {{ old('marca_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                @endif

                            @endforeach
                        </select>
                        @error('marca_id')
                        <small class="text-danger">{{ '>:( ' . $message }}</small>
                        @enderror
                    </div>

                    <!--Presentacion-->
                    <div class="col-md-6">
                        <label for="presentacione_id" class="col-sm-2 col-form-label">Presentacion:</label>
                        <select data-size="4" title="Selecione una presentacion" data-live-search="true" name="presentacione_id" id="presentacione_id" class="form-control selectpicker show-tick">
                            @foreach($presentaciones as $item)
                                @if($producto->presentacione_id ==$item->id)
                                    <option selected value="{{$item->id}}" {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                @else
                                    <option value="{{$item->id}}" {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('presentacione_id')
                        <small class="text-danger">{{ '>:( ' . $message }}</small>
                        @enderror
                    </div>

                    <!---Categorías---->
                    <div class="col-md-6">
                        <label for="categorias" class="col-sm-2 col-form-label">Categorías:</label>
                        <select data-size="4" title="Seleccione las categorías" data-live-search="true" name="categorias[]" id="categorias" class="form-control selectpicker show-tick" multiple>
                            @foreach ($categorias as $item)
                                @if(in_array($item->id,$producto->categorias->pluck('id')->toArray()))
                                    <option selected value="{{$item->id}}" {{ (in_array($item->id , old('categorias',[]))) ? 'selected' : '' }}>{{$item->nombre}}</option>
                                @else
                                    <option value="{{$item->id}}" {{ (in_array($item->id , old('categorias',[]))) ? 'selected' : '' }}>{{$item->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('categorias')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush
