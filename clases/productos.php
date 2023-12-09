<?php
define("DRIVER", 'mysql');
define("DB", 'miproyecto2');
define("HOST", '127.0.0.1');
define("USER", 'root');
define("PASS", '');
define("TABLE", 'productos');
class Productos{
    protected $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $categoria;
    public $imagen;
    private $exists= false;

    function __construct($id=null){
        $db = new database(DRIVER,DB, HOST, USER,PASS);
        $response=$db->select(TABLE,"id=?", array($id));
        
        if(isset($response[0]['id'])){
            $this->id= $response[0]['id'];
            $this-> nombre = $response[0]['nombre-producto'];
            $this-> descripcion = $response[0]['descripcion-producto'];
            $this-> precio = $response[0]['precio-producto'];
            $this-> categoria = $response[0]['categoria-producto'];
            $this-> imagen = $response[0]['imagen-producto'];
            $this-> xists = true;
        }else{
            return false;
        }
    }

    public function product_show(){
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }

    public function guardar(){
        if ($this->$exists){
            return $this->product_update();
        }else{
            return $this->product_insert();
        }
    }

    public function eliminar(){
        $db= new database(DRIVER,DB,HOST,USER,PASS);
        return $db ->delete(TABLE, "id= ".$this->id);

    }

    private function product_insert(){
        $db= new database(DRIVER,DB,HOST,USER,PASS);
        $response= $db ->insert(TABLA, "nombre-producto=?, descripcion-producto=?,
        precio-producto=?, categoria-producto, imagen-producto=?","?,?,?,?",array($this->nombre,$this->descripcion,$this->precio,$this->categoria, $this->imagen));

        if($response){
            $this->id=$response;
            $this->exists=true;
            return true;
        }else{
            return false;
        }
    }
    private function product_update(){
        $db= new database(DRIVER,DB,HOST,USER,PASS);
        return $db-> update(TABLE,"nombre-producto=?, descripcion-producto=?,
        precio_producto=?, categoria-producto, imagen-producto=?","?,?,?,?",array($this->nombre,$this->descripcion,$this->precio,$this->categoria, $this->imagen));

    }

    static public function product_select(){
        $db= new database(DRIVER,DB,HOST,USER,PASS);
        return $db ->select("productos");
    }
}