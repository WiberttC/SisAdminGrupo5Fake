@extends('template')

@section('title','Ver compra')

@push('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('content')
    <h1 class="mt-4 text-center" style="font-size: 40px;">Ver Compra</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('compras.index') }}">Compras</a></li>
            <li class="breadcrumb-item active">Ver Compra</li>
        </ol>
    </nav>

    <div class="card rounded-4 ">
        <div class="card-body row g-3">
            <h5 class="card-title">Formulario Categoria</h5>

            <!-- Tipo de comprobante -->
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-file-earmark-fill"></i></span>
                    <input disabled type="text" class="form-control" value="Tipo de comprobante: ">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input disabled type="text" class="form-control" value="{{$compra->comprobante->tipo_comprobante}}">
                </div>
            </div>

            <!-- Numero comprobante -->
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-file-earmark-fill"></i></span>
                    <input disabled type="text" class="form-control" value="Numero comprobante: ">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input disabled type="text" class="form-control" value="{{$compra->numero_comprobante}}">
                </div>
            </div>

            <!-- Proveedor -->
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-people-fill"></i></span>
                    <input disabled type="text" class="form-control" value="Proveedor: ">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input disabled type="text" class="form-control"
                           value="{{$compra->proveedore->persona->razon_social}}">
                </div>
            </div>

            <!-- Fecha -->
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-calendar"></i></span>
                    <input disabled type="text" class="form-control" value="Fecha: ">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input disabled type="text" class="form-control"
                           value="{{\Carbon\Carbon::parse($compra->fecha_hora)->format('d-m-Y')}}">
                </div>
            </div>

            <!-- Hora -->
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-clock-fill"></i></span>
                    <input disabled type="text" class="form-control" value="Hora: ">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input disabled type="text" class="form-control"
                           value="{{\Carbon\Carbon::parse($compra->fecha_hora)->format('H:i')}}">
                </div>
            </div>

            <!-- Impuesto -->
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-coin"></i></span>
                    <input id="input_impuesto" disabled type="text" class="form-control" value="Impuesto: ">
                </div>
            </div>

            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input disabled type="text" class="form-control" value="{{$compra->impuesto}}">
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabla de detalle de la compra
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead class="bg-primary text-white">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($compra->productos as $item)
                            <tr>
                                <td>
                                    {{$item->nombre}}
                                </td>
                                <td>
                                    {{$item->pivot->cantidad}}
                                </td>
                                <td>
                                    {{$item->pivot->precio_compra}}
                                </td>
                                <td>
                                    {{$item->pivot->precio_venta}}
                                </td>
                                <td class="td-subtotal">
                                    {{($item->pivot->cantidad) * ($item->pivot->precio_compra)}}
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="5"></th>
                        </tr>
                        <tr>
                            <th colspan="4">Sumas:</th>
                            <th id="th-suma"></th>
                        </tr>
                        <tr>
                            <th colspan="4">IGV:</th>
                            <th id="th-igv"></th>
                        </tr>
                        <tr>
                            <th colspan="4">Total:</th>
                            <th id="th-total"></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        //Variables
        let filasSubtotal = document.getElementsByClassName('td-subtotal');
        let cont = 0;
        let impuesto = $('#input-impuesto').val();

        $(document).ready(function() {
            calcularValores();
        });

        function calcularValores() {
            for (let i = 0; i < filasSubtotal.length; i++) {
                cont += parseFloat(filasSubtotal[i].innerHTML);
            }

            $('#th-suma').html(cont);
            $('#th-igv').html(impuesto);
            $('#th-total').html(round(cont + parseFloat(impuesto)));
        }

        function round(num, decimales = 2) {
            var signo = (num >= 0 ? 1 : -1);
            num = num * signo;
            if (decimales === 0) //con 0 decimales
                return signo * Math.round(num);
            // round(x * 10 ^ decimales)
            num = num.toString().split('e');
            num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
            // x * 10 ^ (-decimales)
            num = num.toString().split('e');
            return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
        }
        //Fuente: https://es.stackoverflow.com/questions/48958/redondear-a-dos-decimales-cuando-sea-necesario
    </script>
@endpush
