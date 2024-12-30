@extends('template')

@section('title', 'Productos')

@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @if (session('success'))
        <script>
            let message = "{{ session('success') }}"
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: message,
            });
        </script>
    @endif


    <div class="pagetitle">
        <h1 class="mt-4 text-center" style="font-size: 40px;">Productos</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Productos</li>
            </ol>
            <a href="{{ route('productos.create') }}"><button type="button" class="btn btn-primary">Añadir Nuevo
                    Producto</button></a>
        </nav>


    </div><!-- End Page Title -->

    <div class="card rounded-4">

        <div class="card-body">
            <h5 class="card-title">Tabla Productos <span>| Hoy</span></h5>

            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Presentación</th>
                        <th scope="col">Categorias</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $item)
                        <tr>
                            <td>
                                {{$item->codigo}}
                            </td>
                            <td>
                                {{$item->nombre}}
                            </td>
                            <td>
                                {{$item->marca->caracteristica->nombre}}
                            </td>
                            <td>
                                {{$item->presentacione->caracteristica->nombre}}
                            </td>
                            <td>
                                @foreach($item->categorias as $category)
                                    <div class="container">
                                        <div class="row">
                                            <span class="badge rounded-pill bg-info text-dark m-1">{{$category->caracteristica->nombre}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                            <td>
                               @if ($item->estado ==1)
                                    <span class="badge rounded-pill bg-success text-white">ACTIVO</span>
                                @else
                                    <span class="badge rounded-pill bg-danger text-white">ElIMINADO</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <form action="{{route('productos.edit',['producto'=>$item])}}">
                                        <button type="submit" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>
                                    </form>

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#verModal-{{$item->id}}"><i class="bi bi-eye-fill"></i></button>
                                    @if($item->estado== 1)
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}"><i class="bi bi-trash-fill"></i></button>
                                    @else
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$item->id}}"><i>Restaurar</i></button>
                                    @endif
                                </div>
                            </td>

                            <div class="modal fade" id="verModal-{{$item->id}}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detalles del Producto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <label for=""><span class="fw-bolder">Descripcion:</span> {{$item->descripcion}}</label>
                                            </div>
                                            <div class="row mb-3">
                                                <label for=""><span class="fw-bolder">Fecha de Ingreso: {{$item->fecha_ingreso== '' ? 'No tiene' : $item->fecha_ingreso}}</span></label>
                                            </div>
                                            <div class="row mb-3">
                                                <label for=""><span class="fw-bolder">Stock</span>{{$item->stock}}</label>
                                            </div>
                                            <div class="row mb-3">
                                                <label>Imagen:</label>
                                                <div>
                                                    @if ($item->img_path != null)
                                                        <img src="{{ asset('storage/productos/' . $item->img_path) }}" alt="{{$item->nombre}}" class="img-fluid img-thumbnail border border-4 rounded">
                                                    @else
                                                        <img src="" alt="{{$item->nombre}}">
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Vertically centered Modal-->

                            <!--Modal  de confirmacion-->
                            <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Mensaje de Confirmacion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $item->estado == 1 ? '¿Desea eliminar el Producto?' : '¿Desea restaurar el producto?' }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No
                                                deseo</button>
                                            <form action="{{ route('productos.destroy', ['producto' => $item->id]) }}"
                                                  method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Si deseo</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Vertically centered Modal-->
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>



@endsection

@push('js')
@endpush
