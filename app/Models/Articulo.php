<?php

namespace App\Models;

use DB;
use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'titulo',
        'contenido',
        'autor'
    ];

    /**
     * Obtiene el listado de todos los articulos registrados en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/10 
     */
    public function getArticulosAll(){          
        $articulos = Articulo::select("articulos.id", "articulos.titulo", "articulos.contenido", DB::raw("JSON_OBJECT('id', autores.id, 
                                                                                                                       'nombre', autores.nombre,
                                                                                                                       'nickname', autores.nickname,
                                                                                                                       'email', autores.email) autor"))
                     ->join('autores', 'articulos.autor', '=', 'autores.id')                    
                     ->get();
        if (!$articulos->isEmpty()){           
            foreach ($articulos as $art)         
                $art->autor = json_decode($art->autor);                        
        }
                
        return $articulos;        
    }

    /**
     * Obtiene el registro de un unico articulo registrado en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/10
     */
    public function getArticuloById(int $id){        
        $articulo = Articulo::select("articulos.id", "articulos.titulo", "articulos.contenido", DB::raw("JSON_OBJECT('id', autores.id, 
                                                                                                                      'nombre', autores.nombre,
                                                                                                                      'nickname', autores.nickname,
                                                                                                                      'email', autores.email) autor"))
                     ->join('autores', 'articulos.autor', '=', 'autores.id')                    
                     ->where('articulos.id', $id)
                     ->get();
        if (!$articulo->isEmpty()){           
            foreach ($articulo as $art)         
                $art->autor = json_decode($art->autor);            
        }
        return $articulo;
    }

    /**
     * Agrega el registro de un nuevo articulo en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/10
     */
    public function saveArticulo(Request $request){
        $data = null;
        $articulo = new Articulo(); 
        if (isset($request->titulo) && $request->titulo!=""){ $articulo->titulo = $request->titulo; }
        if (isset($request->contenido) && $request->contenido!=""){ $articulo->contenido = $request->contenido; }               
        if (isset($request->autor) && $request->autor!=""){ 
            $autor = Autor::find($request->autor);
            if (!is_null($autor)){ $articulo->autor = $request->autor; } 
        }       
        $articulo->save();
        $data = $articulo->getArticuloById($articulo->id);        
        return $data;
    }

    /**
     * Edita el registro de un articulo en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/10
     */
    public function updateArticulo(int $id, Request $request){
        $data = null;
        $articulo = Articulo::find($id);
        if (!is_null($articulo)){
            if (isset($request->titulo) && $request->titulo!=""){ $articulo->titulo = $request->titulo; }
            if (isset($request->contenido) && $request->contenido!=""){ $articulo->contenido = $request->contenido; }
            if (isset($request->autor) && $request->autor!=""){ 
                $autor = Autor::find($request->autor);
                if (!is_null($autor)){ $articulo->autor = $request->autor; }                 
            }            
            $articulo->save();
            $data = $articulo->getArticuloById($articulo->id);
        }
        return $data;
    }

    /**
     * Elimina el registro de un articulo en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/10
     */
    public function deleteArticulo(int $id){
        $data = null;
        $articulo = Articulo::find($id);
        if (!is_null($articulo)){
            $articulo->destroy($articulo->id);
            $data = "";
        }
        return $data;
    }

}
