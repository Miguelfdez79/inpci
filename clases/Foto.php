<?php


class Foto {
    private $id, $idautor, $titulo, $categoria, $fecha, $rutafoto;
    function __construct($id = null, $idautor= null, $titulo= null,
            $categoria= null, $fecha = null, $rutafoto = null) {
        $this->id = $id;
        $this->idautor = $idautor;
        $this->titulo = $titulo;
        $this->categoria = $categoria;
        $this->fecha = $fecha;
        $this->rutafoto = $rutafoto;
    }
    function getId() {
        return $this->id;
    }

    function getIdautor() {
        return $this->idautor;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getRuta() {
        return $this->rutafoto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdautor($idautor) {
        $this->idautor = $idautor;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setRuta($rutafoto) {
        $this->rutafoto = $rutafoto;
    }


    public function getJson() {
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '"' . ':' . '"' . $valor . '"' . ',' ;
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }
    
    function set($valores, $inicio=0) {
        $i = 0;
        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i+$inicio];
            $i++;
        }
    }
    
    public function __toString() {
        $r = '';
        foreach ($this as $key => $valor){
            $r .= "$valor ";
        }
        return $r;
    }
    
    public function getArray($valores=true) {
        $array = array();
        foreach ($this as $key => $valor) {
            if($valores===true){
                $array[$key] = $valor;
            }else{
                $array[$key] = null;
            }
        }
        return $array;
    }
    
    function read() {
        foreach ($this as $key => $valor){
            $this->$key = Request::req($key);
        }
    }

}
