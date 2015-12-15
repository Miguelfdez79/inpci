<?php

class ManageFotografo {
    
    private $bd = null;
    private $tabla = "fotografo";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($id) {
        //devuelve el objeto de la fila cuyo id coincide con el id que le estoy pasando
        //devuelve el objeto entero
        $parametros = array();
        $parametros["id"] = $id;
        $this->bd->select($this->tabla, "*", "id =:id", $parametros);
        $fila = $this->bd->getRow();
        $fotografo = new Fotografo();
        $fotografo->set($fila);
        return $fotografo;
    }
    
    function delete($id) {
        //borrar por id
        //borrar por id
        $parametros = array();
        $parametros["id"] = $id;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
        function forzarDelete($id) {
        $parametros = array();
        $parametros['idautor'] = $id;
        $gestor = new ManageFoto($this->bd);
        $gestor->deleteFotos($parametros);
        $this->bd->delete("exposiciones", $parametros);
        $parametros = array();
        $parametros["idautor"] = $id;
        return $this->delete($this->tabla, $parametros);
    }
    
    function erase(Foto $foto) {
        //borrar por nombre
        //dice ele numero de filas borratas
        return $this->delete($foto->getID());
    }
    
    function set(Fotografo $fotografo, $pkid/*vieja*/) {
        //update de todos los campos 
        //pasamos el codigo que tenia y como en este si se puede cambiar el codigo, cambiamos todos los campos
        //dice el numero de filas modificades
        $parametros = $fotografo->getArray();
        $parametrosWhere = array();
        $parametrosWhere["id"] = $pkid;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }
    
    function insert(Fotografo $fotografo) {
        //se le pasa un objeto City y lo inserta en la tabla
        //dice el numero de filas insertadas;
        //En este momento es donde se validan los datos;
        $parametros = $fotografo->getArray();
        return $this->bd->insert($this->tabla, $parametros, false);
    }
    
    function getList($pagina=1, $nrpp=Constants::NRPP) {
        $registroinicial = ($pagina-1) * $nrpp;;
        $this->bd->select($this->tabla, "*", "1=1", array(), "nombre, apellidos, id", " $registroinicial , $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()){
            $fotografo = new Fotografo();
            $fotografo->set($fila);
            $r[] = $fotografo;
        }
        return $r;
    }
    
        function getListAll() {
        $this->bd->select($this->tabla, "*", "1=1", array(), "nombre, apellidos, id");
        $r = array();
        while ($fila = $this->bd->getRow()){
            $fotografo = new Fotografo();
            $fotografo->set($fila);
            $r[] = $fotografo;
        }
        return $r;
    }
    
        function getName($usuario) {
        $parametros = array();
        $parametros["nombre"] = $usuario;    
        $this->bd->select($this->tabla, "*", "nombre=:nombre",  $parametros, "nombre, apellidos, id");
        $r = array();
        while ($fila = $this->bd->getRow()){
            $fotografo = new Fotografo();
            $fotografo->set($fila);
            $r[] = $fotografo;
        }
        return $r;
    }
    
//       function getListUser($usuario, $pagina=1, $nrpp=Constants::NRPP) {
//        $registroinicial = ($pagina-1) * $nrpp;
//        $parametros = array();
//        $parametros["usuario"] = $categoria; 
//        $this->bd->select($this->tabla, "*", "usuario=:usuario", $parametros, "nombre",  " $registroinicial , $nrpp");
//        $r = array();
//        while ($fila = $this->bd->getRow()){
//            $foto = new Foto();
//            $foto->set($fila);
//             $r[] = $foto;
//        }
//        return $r;
//    }
    
    
    
    function getValuesSelect() {
        $this->bd->query($this->tabla, "id, nombre", array(), "nombre");
        $array = array();
        while ($fila = $this->bd->getRow()){
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }
    
            function count($condicion="1=1", $parametros=array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }
    

}
