<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    // Reporte de Ventas por Día
    public function ventasPorDia()
    {
        $ventas = DB::table('ventas')
            ->selectRaw('DATE(created_at) as fecha, SUM(total) as total')
            ->groupBy('fecha')
            ->orderBy('fecha', 'desc')
            ->get();

        return view('reportes.ventasPorDia', compact('ventas'));
    }

    // Reporte de Ventas por Cliente
    public function ventasPorCliente()
    {
        $ventas = DB::table('ventas')
            ->join('clientes', 'ventas.cliente_id', '=', 'clientes.id')
            ->join('personas', 'clientes.persona_id', '=', 'personas.id') // Unión con personas
            ->selectRaw('personas.razon_social as cliente, SUM(ventas.total) as total') // Campo razon_social
            ->groupBy('personas.razon_social')
            ->orderBy('total', 'desc')
            ->get();

        return view('reportes.ventasPorCliente', compact('ventas'));
    }

    // Reporte de Ventas por Producto
    public function ventasPorProducto()
    {
        $ventas = DB::table('producto_venta')
            ->join('productos', 'producto_venta.producto_id', '=', 'productos.id')
            ->selectRaw('productos.nombre as producto, SUM(producto_venta.cantidad) as cantidad')
            ->groupBy('productos.nombre')
            ->orderBy('cantidad', 'desc')
            ->get();

        return view('reportes.ventasPorProducto', compact('ventas'));
    }
}
