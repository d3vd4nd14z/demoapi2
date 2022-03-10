<?php

namespace App\Models;

use DB;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id' ,
        'nombre',
        'nickname',
        'email'
    ];

    /**
     * Obtiene el listado de todos los autores registrados en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/10 
     */
    public function getAutoresAll(){          
        $autor = Autor::select("autores.id", "autores.nombre", "autores.nickname", "autores.email", DB::raw("CONCAT('[', GROUP_CONCAT(JSON_OBJECT('id', categorias.id,
                                                                                                                                                  'nombre', categorias.nombre
                                                                                                                                                 )
                                                                                                                                     ), 
                                                                                                                    ']') categorias"))
                     ->join('autor_categorias', 'autores.id', '=', 'autor_categorias.autor')
                     ->join('categorias', 'autor_categorias.categoria', '=', 'categorias.id')                    
                     ->groupBy('autores.id','autores.nombre','autores.nickname', 'autores.email')
                     ->get();
        if (!$autor->isEmpty()){           
            foreach ($autor as $a)         
                $a->categorias = json_decode($a->categorias);                        
        }
                
        return $autor;        
    }

    /**
     * Obtiene el registro de un unico autor registrado en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/10
     */
    public function getAutorById(int $id){  
        $autor = Autor::select("autores.id", "autores.nombre", "autores.nickname", "autores.email", DB::raw("CONCAT('[', GROUP_CONCAT(JSON_OBJECT('id', categorias.id,
                                                                                                                                                  'nombre', categorias.nombre )), ']') categorias"))
                     ->leftJoin('autor_categorias', 'autores.id', '=', 'autor_categorias.autor')
                     ->leftJoin('categorias', 'autor_categorias.categoria', '=', 'categorias.id')                    
                     ->where('autores.id', $id)
                     ->groupBy('autores.id','autores.nombre','autores.nickname','autores.email')
                     ->get();
        if (!$autor->isEmpty()){           
            foreach ($autor as $a)         
                $a->categorias = json_decode($a->categorias);                        
        }                
        return $autor;
    }

    /**
     * Agrega el registro de un nuevo autor en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/10
     */
    public function saveAutor(Request $request){
        $data = null;
        $autor = new Autor(); 
        if (isset($request->nombre) && $request->nombre!=""){ $autor->nombre = $request->nombre; }
        if (isset($request->nickname) && $request->nickname!=""){ $autor->nickname = $request->nickname; }
        if (isset($request->email) && $request->email!=""){ $autor->email = $request->email; }                       
        $autor->save();
        $data = $autor->getAutorById($autor->id);                        
        return $data;
    }

    /**
     * Edita el registro de un autor en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/10
     */
    public function updateAutor(int $id, Request $request){
        $data = null;
        $autor = Autor::find($id);
        if (!is_null($autor)){
            if (isset($request->nombre) && $request->titulo!=""){ $autor->nombre = $request->nombre; }
            if (isset($request->nickname) && $request->nickname!=""){ $autor->nickname = $request->nickname; }
            if (isset($request->email) && $request->email!=""){ $autor->email = $request->email; }                 
            $autor->save();
            $data = $autor->getAutorById($autor->id);
        }
        return $data;
    }

    /**
     * Elimina el registro de un autor en la base de datos
     * @author: @d4nd14z
     * @since: 2022/03/10
     */
    public function deleteAutor(int $id){
        $data = null;
        $autor = Autor::find($id);
        if (!is_null($autor)){
            $autor->destroy($autor->id);
            $data = "";
        }
        return $data;
    }


}
