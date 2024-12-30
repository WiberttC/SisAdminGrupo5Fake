@extends('template')

@section('title', 'ventas')

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
        <h1 class="mt-4 text-center" style="font-size: 40px;">Ventas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Ventas</li>
            </ol>
            <a href="{{ route('ventas.create') }}">
                <button type="button" class="btn btn-primary">Añadir Nueva
                    Venta
                </button>
            </a>
        </nav>


    </div><!-- End Page Title -->

    <div class="card rounded-4">

        <div class="card-body">
            <h5 class="card-title">Tabla Ventas <span>| Hoy</span></h5>

            <table class="table table-hover datatable">
                <thead>
                <tr>
                    <th>Comprobante</th>
                    <th>Cliente</th>
                    <th>Fecha y hora</th>
                    <th>Usuario</th>
                    <th>Total</th>
                    <th>Acciones</th>

                </tr>
                </thead>
                <tbody>
                @foreach($ventas as $item)
                    <tr>
                        <td>
                            <p class="fw-semibold mb-1">{{$item->comprobante->tipo_comprobante}}</p>
                            <p class="text-muted mb-0">{{$item->numero_comprobante}}</p>
                        </td>
                        <td>
                            <p class="fw-semibold mb-1"> {{ucfirst($item->cliente->persona->tipo_persona)}}</p>
                            <p class="text-muted mb-0">{{$item->cliente->persona->razon_social}}</p>
                        </td>
                        <td>
                            {{
                                \Carbon\Carbon::parse($item->fecha_hora)->format('d-m-Y') .' '.
                                \Carbon\Carbon::parse($item->fecha_hora)->format('H:i')
                            }}
                        </td>
                        <td>
                            {{$item->user->name}}
                        </td>
                        <td>
                            {{$item->total}}
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{route('ventas.show', ['venta'=>$item])}}" method="get">
                                    <button type="submit" class="btn btn-warning"><i class="bi bi-eye-fill"></i>
                                    </button>
                                </form>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}"><i class="bi bi-trash-fill"></i></button>
                            </div>
                        </td>
                    </tr>

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
                                    ¿Seguro que quiere eliminar el registro?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No deseo</button>
                                    <form
                                        action="{{ route('ventas.destroy', ['venta' => $item->id]) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Si deseo</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Vertically centered Modal-->

                @endforeach

                </tbody>
            </table>

        </div>

    </div>

@endsection

@push('js')
@endpush
