@extends('template')

@section('title', 'categorias')

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
        <h1 class="mt-4 text-center" style="font-size: 40px;">Categorias</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Categorias</li>
            </ol>
            <a href="{{ route('categorias.create') }}">
                <button type="button" class="btn btn-primary">Añadir Nuevo
                    Categoria
                </button>
            </a>
        </nav>


    </div><!-- End Page Title -->

    <div class="card rounded-4">

        <div class="card-body">
            <h5 class="card-title">Tabla Categorias <span>| Hoy</span></h5>

            <table class="table table-hover datatable">
                <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>
                            {{ $categoria->caracteristica->nombre }}
                        </td>
                        <td>
                            {{ $categoria->caracteristica->descripcion }}
                        </td>
                        <td>
                            @if ($categoria->caracteristica->estado == 1)
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"> Activo</i></span>
                            @else
                                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                        Eliminado</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('categorias.edit', ['categoria' => $categoria]) }}" method="get">
                                    <!--Boton Editar -->
                                    <button type="submit" class="btn btn-success"><i
                                            class="bi bi-pencil-square"></i></button>
                                </form>

                                @if ($categoria->caracteristica->estado == 1)
                                    <!--Boton Eliminar -->
                                    <button type="button" class="btn btn-danger"
                                            data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $categoria->id }}">
                                        <i
                                            class="bi bi-trash-fill"></i></button>
                                @else
                                    <!--Boton Eliminar -->
                                    <button type="button" class="btn btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmModal-{{ $categoria->id }}"><i>Restaurar</i>
                                    </button>
                                @endif

                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="confirmModal-{{ $categoria->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Mensaje de Confirmacion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{asset('stikers/NoDeseo.png')}}" alt="">
                                    {{ $categoria->caracteristica->estado == 1 ? '¿Desea eliminar esta Categoria?' : '¿Desea restaurar esta Categoria?' }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No
                                        deseo
                                    </button>
                                    <form action="{{ route('categorias.destroy', ['categoria' => $categoria->id]) }}"
                                          method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Si deseo</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Vertically centered Modal-->
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection

@push('js')
@endpush
