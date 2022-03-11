<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArticuloCategoria;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id' ,
        'nombre',
        'descripcion'
    ];

    /**
     * Obtiene el listado de todas las categorias registradas en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/11 
     */
    public function getCategoriasAll(){          
        $categorias = Categoria::select("categorias.id", "categorias.nombre", "categorias.descripcion")                      
                     ->get();                   
        return $categorias;        
    }

     /**
     * Obtiene el registro de una unica categoria registrada en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/11
     */
    public function getCategoriaById(int $id){  
        $categorias = Categoria::select("categorias.id", "categorias.nombre", "categorias.descripcion")
                     ->where('categorias.id', $id)
                     ->get();        
        return $categorias;
    }

    /**
     * Agrega el registro de una nueva categoria en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/11
     */
    public function saveCategoria(Request $request){
        $data = null;
        $categoria = new Categoria(); 
        if (isset($request->nombre) && $request->nombre!=""){ $categoria->nombre = $request->nombre; }
        if (isset($request->descripcion) && $request->descripcion!=""){ $categoria->descripcion = $request->descripcion; }        
        $categoria->save();
        $data = $categoria->getCategoriaById($categoria->id);                        
        return $data;
    }

    /**
     * Edita el registro de una categoria en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/11
     */
    public function updateCategoria(int $id, Request $request){
        $data = null;
        $categoria = Categoria::find($id);
        if (!is_null($categoria)){
            if (isset($request->nombre) && $request->nombre!=""){ $categoria->nombre = $request->nombre; }
            if (isset($request->descripcion) && $request->descripcion!=""){ $categoria->descripcion = $request->descripcion; }            
            $categoria->save();
            $data = $categoria->getCategoriaById($categoria->id);
        }
        return $data;
    }

    /**
     * Elimina el registro de una categoria en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/11
     */
    public function deleteCategoria(int $id){
        $data = null;
        $categoria = Categoria::find($id);
        if (!is_null($categoria)){                        
            $categoria->destroy($categoria->id);
            $data = "";
        }
        return $data;
    }



}
