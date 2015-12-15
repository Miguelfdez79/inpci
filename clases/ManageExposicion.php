<?php

class ManageExposicion {
    
    private $bd = null;
    private $tabla = "exposiciones";
    
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
        $exposicion = new Exposicion();
        $exposicion->set($fila);
        return $exposicion;
    }
    
    function delete($id) {
        //borrar por id
        //borrar por id
        $parametros = array();
        $parametros["id"] = $id;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
//        function forzarDelete($id) {
//        $parametros = array();
//        $parametros['idautor'] = $id;
//        $gestor = new ManageFoto($this->bd);
//        $gestor->deleteFotos($parametros);
//        $this->bd->delete("exposiciones", $parametros);
//        $parametros = array();
//        $parametros["idautor"] = $id;
//        return $this->delete($this->tabla, $parametros);
//    }
    
    function erase(Foto $foto) {
        //borrar por nombre
        //dice ele numero de filas borratas
        return $this->delete($foto->getID());
    }
    
    function set(Exposicion $exposicion, $pkid/*vieja*/) {
        //update de todos los campos 
        //pasamos el codigo que tenia y como en este si se puede cambiar el codigo, cambiamos todos los campos
        //dice el numero de filas modificades
        $parametros = $exposicion->getArray();
        $parametrosWhere = array();
        $parametrosWhere["id"] = $pkid;
        return $this->bd->update($this->tabla, $parametros, $parametrosWhere);
    }
    
    function insert(Exposicion $exposicion) {
        //se le pasa un objeto City y lo inserta en la tabla
        //dice el numero de filas insertadas;
        //En este momento es donde se validan los datos;
        $parametros = $exposicion->getArray();
   
        return $this->bd->insert($this->tabla, $parametros, false);
    }
    
    function getList($pagina=1, $nrpp=Constants::NRPP) {
        $registroinicial = ($pagina-1) * $nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), "nombreexpo, fecha, id", "$registroinicial , $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()){
            $exposicion = new Exposicion();
            $exposicion->set($fila);
            $r[] = $exposicion;
           
        }
        return $r;
    }
    
    function getValuesSelect() {
        $this->bd->query($this->tabla, "id, nombreexpo", array(), "nombreexpo");
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
