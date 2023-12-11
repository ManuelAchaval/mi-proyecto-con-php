<?php
// try {
//     $conector = new PDO("mysql:dbname=miproyecto2;host=127.0.0.1", "root", "");
//     echo"Conexion exitosa";
// } catch (Exception $ex) {
//     echo "Falló de conexion" . $ex->getMessage();
// }

class database {
    private $gbd;

    function __construct($driver,$database,$host,$user,$pass){
        $conection = $driver . ":dbname=".$database .";host=$host";
        $this-> gbd = new PDO($conection,$user,$pass);

        if(!$this->gbd) throw new Exception("No se ha podido conectar\n\n
        Revisar:\n\t- Parametros de acceso;\n\t- Credenciales.");
    }
    
    function select($tabla,$filtros=null, $arr_prepare=null,$order=null, $limit=null) {
        $sql ="SELECT * FROM " . $tabla;

        if($filtros!=null){$sql .= " WHERE " . $filtros;}
        if($order!=null){$sql .= " ORDER BY " . $order;}
        if($limit!=null) {$sql .= " LIMIT " .$limit;}
        $resource=$this->gbd->prepare($sql);
        $resource->execute($arr_prepare);

        if ($resource){return $resource ->fetchAll(PDO:: FETCH_ASSOC);}
        else{
            echo '<pre>';
            print_r($this->gbd->errorInfo());
            echo '</pre>';

            throw new Exception('No se ha podido realizar la consulta.');
        }
    }
    function delete($tabla, $filtros=null,$arr_prepare=null ) {
        $sql= "DELETE FROM " . $tabla . " WHERE " . $filtros;

        $resource =$this ->gbd ->prepare($sql);
        $resource->execute($arr_prepare);

        if($resource) {return $resource-> fetchAll(PDO::FETCH_ASSOC);}
        else{
            echo '<pre>';
            print_r($this->gbd -> errorInfo());
            echo '</pre>';

            throw new Exception('Error al eliminar.');
        }
    }
    function insert($tabla, $campos,$valores,$arr_prepare = null) {
        $sql = "INSERT INTO " . $tabla . "(" . $campos . ") VALUES ( ". $valores .")";
        
        $resource=$this->gbd-> prepare(sql);
        $resource->execute($arr_prepare);

        if($resource){
            $this->gbd->lastInsertId();
            return $resource->fetchAll(PDO::FETCH_ASSOC);
        }else {
            echo '<pre>';
            print_r($this ->gbd->errorInfo());
            echo '</pre>';

            throw new Exception('error al insertar los datos');
        }
    }
    function update($tabla,$campo,$valor, $filtros,$arr_prepare=null) {

        $sql="UPDATE ".$tabla." SET " . $campo ." = ".$valor . " WHERE " .$filtros;

        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);

        if ($resource){
            return $resource->fetchAll(PDO::FETCH_ASSOC);
        }else{
            echo'<pre>';
            print_r($this->gbd->errorInfo());
            echo'</pre>';

            throw new Exception('Error al actualizar.');
        }
        
    }

}