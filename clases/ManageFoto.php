<?php

class ManageFoto {
    
    private $bd = null;
    private $tabla = "fotos";
    
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
        $foto = new Foto();
        $foto->set($fila);
        return $foto;
    }
    
    function delete($id) {
        //borrar por id
        $parametros = array();
        $parametros["id"] = $id;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function deleteFotos($parametros){
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function erase(Foto $foto) {
        //borrar por nombre
        //dice ele numero de filas borratas
        return $this->delete($foto->getID());
    }
    
    function set(Foto $foto) {

        $parametrosSet = array();
        $parametrosSet["idautor"]=$foto->getIdautor();
        $parametrosSet["titulo"]=$foto->getTitulo();
        $parametrosSet["categoria"]=$foto->getCategoria();
        $parametrosSet["fecha"]=$foto->getFecha();
         $parametrosSet["rutafoto"]=$foto->getRuta();
        $parametrosWhere = array();
        $parametrosWhere["id"] = $foto->getID();
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }
    
    function insert(Foto $foto) {
        
  $parametros = $foto->getArray();
       var_dump($parametros);
        return $this->bd->insert($this->tabla, $parametros, false);
    }
    
    function getList( $pagina=1, $nrpp=Constants::NRPP) {
        $registroinicial = ($pagina-1) * $nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), "fecha",  " $registroinicial , $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()){
            $foto = new Foto();
            $foto->set($fila);
            $r[] = $foto;
        }
        return $r;
    }
    
     function getListCategoria($categoria, $pagina=1, $nrpp=Constants::NRPP) {
        $registroinicial = ($pagina-1) * $nrpp;
        $parametros = array();
        $parametros["categoria"] = $categoria; 
        $this->bd->select($this->tabla, "*", "categoria=:categoria", $parametros, "fecha",  " $registroinicial , $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()){
            $foto = new Foto();
            $foto->set($fila);
             $r[] = $foto;
        }
        return $r;
    }
    
       function getListUserById($usuario, $pagina=1, $nrpp=Constants::NRPP) {
        $registroinicial = ($pagina-1) * $nrpp;
        $parametros = array();
        $parametros["idautor"] = $usuario; 
        $this->bd->select($this->tabla, "*", "idautor=:idautor", $parametros, "fecha",  " $registroinicial , $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()){
            $foto = new Foto();
            $foto->set($fila);
             $r[] = $foto;
        }
        return $r;
    }
    
    
//       function getListInicial($pagina=1, $nrpp=Constants::NRPP) {
//        $registroinicial = ($pagina-1) * $nrpp;;
//        $this->bd->select($this->tabla, "*", "1=1", array(), "fecha",  "$registroinicial , $nrpp");
//        $r = array();
//        while ($fila = $this->bd->getRow()){
//            $foto = new Foto();
//            $foto->set($fila);
//            $r[] = $foto->getRuta();
//        }
//        return $r;
//    }    
    
    function getValuesSelect() {
        $this->bd->query($this->tabla, "id, titulo", array(), "titulo");
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
