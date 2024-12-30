@extends('template')

@section('title', 'roles')

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
        <h1 class="mt-4 text-center" style="font-size: 40px;">Roles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Clientes</li>
            </ol>
            <a href="{{ route('roles.create') }}">
                <button type="button" class="btn btn-primary">Añadir Nuevo
                    Rol
                </button>
            </a>
        </nav>


    </div><!-- End Page Title -->

    <div class="card rounded-4">

        <div class="card-body">
            <h5 class="card-title">Tabla Rol <span>| Hoy</span></h5>

            <table class="table table-hover datatable">
                <thead>
                <tr>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $item)
                    <tr>
                        <td>
                            {{$item->name}}
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{route('roles.edit',['role'=>$item])}}">
                                    <button type="submit" class="btn btn-warning">Editar</button>
                                </form>
                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#confirmModal-{{ $item->id }}">Eliminar</button>
                            </div>
                        </td>


                        <!--Modal de confirmacion-->
                        <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Mensaje de Confirmacion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro que quieres eliminar el rol?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No
                                            deseo
                                        </button>
                                        <form
                                            action="{{ route('roles.destroy', ['role' => $item->id]) }}"
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
