@extends('template')

@section('title', 'Realizar venta')

@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('content')
    <h1 class="mt-4 text-center" style="font-size: 40px;">Realizar Venta</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ventas.index') }}">Ventas</a></li>
            <li class="breadcrumb-item active">Realizar Venta</li>
        </ol>
    </nav>
    <form action="{{route('ventas.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <!-- Venta Producto -->
                <div class="card rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">Detalles de la venta</h5>

                        <form>
                            <div class="row mb-5">
                                <!--Producto -->
                                <div class="col-md-12 mb-2">
                                    <select name="producto_id" id="producto_id" class="form-control selectpicker"
                                            data-live-search="true" data-size="1" title="Buscar Producto">
                                        @foreach ($productos as $item)
                                            <option
                                                value="{{ $item->id }}-{{$item->stock}}-{{$item->precio_venta}}">{{ $item->codigo . '   ' . $item->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!--Stock -->
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="col-md-6 mb-2">
                                        <div class="row">
                                            <label for="stock" class="form-label col-sm-4">En stock:</label>
                                            <div class="col-sm-8">
                                                <input disabled type="text" id="stock" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Cantidad -->
                                <div class="col-md-4 mb-2">
                                    <label for="cantidad" class="form-label">Cantidad:</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control">
                                </div>

                                <!-- Precio de venta -->
                                <div class="col-md-4 mb-2">
                                    <label for="precio_venta" class="form-label">Precio de venta:</label>
                                    <input disabled type="number" name="precio_venta" id="precio_venta"
                                           class="form-control"
                                           step="0.1">
                                </div>

                                <!-- Descuento -->
                                <div class="col-md-4 mb-2">
                                    <label for="descuento" class="form-label">Descuento:</label>
                                    <input type="number" name="descuento" id="descuento" class="form-control"
                                           step="0.1">
                                </div>

                                <!-- Boton para agregar -->
                                <div class="col-md-12 mb-2 text-end">
                                    <button id="btn_agregar" class="btn btn-primary" type="button">Agregar</button>
                                </div>

                                <!-- Tabla de detalle de compra -->
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="tabla_detalle" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio venta</th>
                                                <th>Descuento</th>
                                                <th>Subtotal</th>
                                                <th></th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <th></th>
                                                <th colspan="4">Sumas</th>
                                                <th colspan="2"><span id="sumas">0</span></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th colspan="4">IGV %</th>
                                                <th colspan="2"><span id="igv">0</span></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th colspan="4">Total</th>
                                                <th colspan="2"><input type="hidden" name="total" value="0"
                                                                       id="inputTotal"> <span id="total">0</span></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>

                                <!-- Boton para cancelar venta -->
                                <div class="col-md-12 mb-2 text-end">
                                    <button id="cancelar" type="button" class="btn btn-danger"
                                            data-bs-toggle="modal" data-bs-target="#confirmModal">Cancelar
                                        venta
                                    </button>

                                </div>

                            </div>


                        </form>

                    </div>
                </div>

            </div>
            <!-- Venta -->
            <div class="col-lg-6">
                <div class="card rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">Datos generales</h5>

                        <!-- Datos Generales -->
                        <div class="row mb-5">
                            <!-- Cliente -->
                            <div class="col-md-12 mb-2">
                                <label for="cliente_id" class="form-label">Ciente:</label>
                                <select name="cliente_id" id="cliente_id"
                                        class="form-control selectpicker show-tick" data-live-search="true"
                                        title="Seleciona" data-size="2">
                                    @foreach ($clientes as $item)
                                        <option value="{{ $item->id }}">{{ $item->persona->razon_social }}</option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                <small class="text-danger">{{">:( ".$message}}</small>
                                @enderror
                            </div>

                            <!-- Tipo Comprobante -->
                            <div class="col-md-12 mb-2">
                                <label for="comprobante_id" class="form-label">Comprabante:</label>
                                <select name="comprobante_id" id="comprobante_id"
                                        class="form-control selectpicker show-tick" title="Seleciona">
                                    @foreach ($comprobantes as $item)
                                        <option value="{{ $item->id }}">{{ $item->tipo_comprobante }}</option>
                                    @endforeach
                                </select>
                                @error('comprobante_id')
                                <small class="text-danger">{{">:( ".$message}}</small>
                                @enderror
                            </div>

                            <!-- Numero Comprobante -->
                            <div class="col-md-12 mb-2">
                                <label for="numero_comprobante" class="form-label">Numero de Comprabante:</label>
                                <input required type="text" name="numero_comprobante" id="numero_comprobante"
                                       class="form-control">
                                @error('numero_comprobante')
                                <small class="text-danger">{{">:( ".$message}}</small>
                                @enderror
                            </div>

                            <!-- Impuesto -->
                            <div class="col-md-6 mb-2">
                                <label for="impuesto" class="form-label">Impuesto(IGV):</label>
                                <input readonly type="text" name="impuesto" id="impuesto"
                                       class="form-control border-success">
                                @error('impuesto')
                                <small class="text-danger">{{">:( ".$message}}</small>
                                @enderror
                            </div>

                            <!-- Fecha -->
                            <div class="col-md-6 mb-2">
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input readonly type="date" name="fecha" id="fecha"
                                       class="form-control border-success" value="<?php echo date('Y-m-d'); ?>">
                                    <?php

                                    use Carbon\Carbon;

                                    $fecha_hora = Carbon::now()->toDateTimeString();
                                    ?>
                                <input type="hidden" name="fecha_hora" value="{{$fecha_hora}}">
                            </div>
                            <!-- User -->
                            <input type="hidden" name="user_id" value="1">

                            <!--Botones-->
                            <div class="col-md-12 mb-2 text-center">
                                <button id="guardar" type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Modal para cancelar la venta -->
        <div class="modal fade" id="confirmModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mensaje de Confirmacion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que quiere cancelar la venta?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No deseo</button>
                        <button id="btnCancelarVenta" type="submit" class="btn btn-danger" data-bs-dismiss="modal">Si
                            deseo
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- End Vertically centered Modal-->
    </form>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>

        $(document).ready(function() {

            $('#producto_id').change(mostrarValores);


            $('#btn_agregar').click(function() {
                agregarProducto();
            });

            $('#btnCancelarVenta').click(function() {
                cancelarVenta();
            });

            disableButtons();

            $('#impuesto').val(impuesto + '%');
        });

        //Variables
        let cont = 0;
        let subtotal = [];
        let sumas = 0;
        let igv = 0;
        let total = 0;

        //Constantes
        const impuesto = 18;

        function mostrarValores() {
            let dataProducto = document.getElementById('producto_id').value.split('-');
            $('#stock').val(dataProducto[1]);
            $('#precio_venta').val(dataProducto[2]);
        }

        function agregarProducto() {
            let dataProducto = document.getElementById('producto_id').value.split('-');
            //Obtener valores de los campos
            let idProducto = dataProducto[0];
            let nameProducto = $('#producto_id option:selected').text();
            let cantidad = $('#cantidad').val();
            let precioVenta = $('#precio_venta').val();
            let descuento = $('#descuento').val();
            let stock = $('#stock').val();

            if (descuento == '') {
                descuento = 0;
            }

            //Validaciones
            //1.Para que los campos no esten vacíos
            if (idProducto != '' && cantidad != '') {

                //2. Para que los valores ingresados sean los correctos
                if (parseInt(cantidad) > 0 && (cantidad % 1 == 0) && parseFloat(descuento) >= 0) {

                    //3. Para que la cantidad no supere el stock
                    if (parseInt(cantidad) <= parseInt(stock)) {
                        //Calcular valores
                        subtotal[cont] = round(cantidad * precioVenta - descuento);
                        sumas += subtotal[cont];
                        igv = round(sumas / 100 * impuesto);
                        total = round(sumas + igv);

                        //Crear la fila
                        let fila = '<tr id="fila' + cont + '">' +
                            '<th>' + (cont + 1) + '</th>' +
                            '<td><input type="hidden" name="arrayidproducto[]" value="' + idProducto + '">' + nameProducto + '</td>' +
                            '<td><input type="hidden" name="arraycantidad[]" value="' + cantidad + '">' + cantidad + '</td>' +
                            '<td><input type="hidden" name="arrayprecioventa[]" value="' + precioVenta + '">' + precioVenta + '</td>' +
                            '<td><input type="hidden" name="arraydescuento[]" value="' + descuento + '">' + descuento + '</td>' +
                            '<td>' + subtotal[cont] + '</td>' +
                            '<td><button class="btn btn-danger" type="button" onClick="eliminarProducto(' + cont + ')"><i class="bi bi-trash-fill"></i></button></td>' +
                            '</tr>';

                        //Acciones después de añadir la fila
                        $('#tabla_detalle').append(fila);
                        limpiarCampos();
                        cont++;
                        disableButtons();

                        //Mostrar los campos calculados
                        $('#sumas').html(sumas);
                        $('#igv').html(igv);
                        $('#total').html(total);
                        $('#impuesto').val(igv);
                        $('#inputTotal').val(total);
                    } else {
                        showModal('Cantidad incorrecta');
                    }

                } else {
                    showModal('Valores incorrectos');
                }

            } else {
                showModal('Le faltan campos por llenar');
            }

        }

        function eliminarProducto(indice) {
            //Calcular valores
            sumas -= round(subtotal[indice]);
            igv = round(sumas / 100 * impuesto);
            total = round(sumas + igv);

            //Mostrar los campos calculados
            $('#sumas').html(sumas);
            $('#igv').html(igv);
            $('#total').html(total);
            $('#impuesto').val(igv);
            $('#InputTotal').val(total);

            //Eliminar el fila de la tabla
            $('#fila' + indice).remove();

            disableButtons();
        }

        function cancelarVenta() {
            //Elimar el tbody de la tabla
            $('#tabla_detalle tbody').empty();

            //Añadir una nueva fila a la tabla
            let fila = '<tr>' +
                '<th></th>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '</tr>';
            $('#tabla_detalle').append(fila);

            //Reiniciar valores de las variables
            cont = 0;
            subtotal = [];
            sumas = 0;
            igv = 0;
            total = 0;

            //Mostrar los campos calculados
            $('#sumas').html(sumas);
            $('#igv').html(igv);
            $('#total').html(total);
            $('#impuesto').val(impuesto + '%');
            $('#inputTotal').val(total);

            limpiarCampos();
            disableButtons();
        }

        function disableButtons() {
            if (total == 0) {
                $('#guardar').hide();
                $('#cancelar').hide();
            } else {
                $('#guardar').show();
                $('#cancelar').show();
            }
        }

        function limpiarCampos() {
            let select = $('#producto_id');
            select.selectpicker('val', '');
            $('#cantidad').val('');
            $('#precio_venta').val('');
            $('#descuento').val('');
            $('#stock').val('');
        }

        function showModal(message, icon = 'error') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: icon,
                title: message
            })
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
