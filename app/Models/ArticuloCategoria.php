<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloCategoria extends Model
{
    use HasFactory;

    protected $table = 'articulos_categorias';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id' ,
        'articulo',
        'categoria'
    ];

    /**
     * Elimina los registros de una categoria en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/10
     */
    public function deleteByCategoria(int $categoria){
        $result = false;
        if (ArticuloCategoria::where("categoria", $categoria)->delete()){
            $result = true;
        }
        return $result;
    }
}
