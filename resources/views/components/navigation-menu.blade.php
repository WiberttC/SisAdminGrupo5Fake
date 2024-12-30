<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('panel') }}">
                <i class="bi bi-grid"></i>
                <span>Panel</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Modulos</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('categorias.index') }}">
                <i class="bi bi-tag-fill"></i>
                <span>Categorias</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('marcas.index') }}">
                <i class="bi bi-bag-plus-fill"></i>
                <span>Marcas</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('presentaciones.index') }}">
                <i class="bi bi-pin-angle-fill"></i>
                <span>Presentaciones</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('productos.index') }}">
                <i class="bi bi-basket2-fill"></i>
                <span>Productos</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('clientes.index') }}">
                <i class="bi bi-people-fill"></i>
                <span>Clientes</span>
            </a>
        </li><!-- Clientes -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('proveedores.index') }}">
                <i class="bi bi-inbox-fill"></i>
                <span>Proveedores</span>
            </a>
        </li><!-- Proveedores -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-shop-window"></i><span>Compras</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('compras.index') }}">
                        <i class="bi bi-circle"></i><span>Ver</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('compras.create') }}">
                        <i class="bi bi-circle"></i><span>Crear</span>
                    </a>
                </li>
            </ul>
        </li><!-- Compras -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#collapsedVentas" data-bs-toggle="collapse" href="#">
                <i class="bi bi-cart-fill"></i><span>Ventas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="collapsedVentas" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('ventas.index') }}">
                        <i class="bi bi-circle"></i><span>Ver</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('ventas.create') }}">
                        <i class="bi bi-circle"></i><span>Crear</span>
                    </a>
                </li>
            </ul>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('reportes.ventasPorDia') }}">
                <span> Ventas por Día</span>
            </a>
        </li><!-- Clientes -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('reportes.ventasPorCliente') }}">
                <span> Ventas por Cliente</span>
            </a>
        </li><!-- Proveedores -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('reportes.ventasPorProducto') }}">
                <span> Ventas por Producto</span>
            </a>
        </li><!-- Clientes -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('reportes.ventasPorProducto') }}">
                <span> Registro de redes</span>
            </a>
        </li><!-- Registro de redes  -->

        </li><!-- Ventas -->


    </ul>



    <div class="sb-sidenav-footer md-4">
        <div class="small">Bienvenido:</div>
        {{ auth()->user()->name }}
    </div>

</aside><!-- End Sidebar-->
