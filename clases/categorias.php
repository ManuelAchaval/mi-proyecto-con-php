<?php
define("DRIVER", 'mysql');
define("DB", 'miproyecto2');
define("HOST", '127.0.0.1');
define("USER", 'root');
define("PASS", '');
define("TABLE", 'categorias');
class Categorias{
    protected $id;
    public $nombre;
    private $exists=false;

    function __construct($id = null){
        if($id!=null){
            $db= new database(DRIVER,DB,HOST,USER,PASS);
            $response = $db-> select(TABLE, "id=?", array($id));

            if(isset($response[0]['id'])){
                $this->id=$response[0]['id'];
                $this->nombre=$response[0]['nombre-categoria'];
                $this->exists=true;
            }
        }else{return false;}

    }

    public function category_show(){
        echo'<pre>';
        print_r($this);
        echo'</pre>';
    }

    public function guardar(){
        if($this->exists){
            return $this->category_update();
        }else{return $this->category_insert();}
    }
    public function eliminar(){
        $db= new database(DRIVER,DB,HOST,USER,PASS);
        return $db->delete(TABLE,"id= ".$this->id);
    }
    public function category_insert(){
        $db= new database(DRIVER,DB,HOST,USER,PASS);
        return $db->insert(TABLE,"nombre-categoria=? ","id=?",array($this->nombre));
        
        if($response){
            $this->id=$response;
            $this->exists=true;
            return true;
        }else{return false;}
    }

    public function category_update(){
        $db= new database(DRIVER,DB,HOST,USER,PASS);
        return $db->update(TABLE,"nombre-categoria=? ","id=?",array($this->nombre));
        
    }
    static public function category_select(){
        $db= new database(DRIVER,DB,HOST,USER,PASS);
        return $db->select(TABLE);
        
    }
}