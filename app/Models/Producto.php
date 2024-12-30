<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;


use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function compras(){
        return $this->belongsToMany(Compra::class)->withTimestamps()->withPivot('cantidad','precio_compra','precio_venta');
    }

    public function ventas(){
        return $this->belongsToMany(Venta::class)->withTimestamps()->withPivot('cantidad','precio_venta','descuento');
    }

    public function categorias(){
        return $this->belongsToMany(Categoria::class)->withTimestamps();
    }

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function presentacione(){
        return $this->belongsTo(Presentacione::class);
    }

    protected $fillable = ['codigo','nombre','descripcion','fecha_ingreso','marca_id','presentacione_id','img_path'];

    public function handleUploadImage($image)
    {
        $file = $image;
        $name = time() . $file->getClientOriginalName();
        //$file->move(public_path() . '/img/productos/', $name);
        Storage::disk('public')->putFileAs('productos', $file, $name);

        return $name;
    }

}
