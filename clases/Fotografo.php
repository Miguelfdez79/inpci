<?php
//Clase POJO - Clase Plain, plana, tonta
//Solo sirve para almacenar información
class Fotografo {
    private $id, $nombre, $apellidos, $sexo, $edad, $nacionalidad, $rutafotografo;
    
    //1º constructor -> null
    function __construct($id = null, $nombre = null, $apellidos = null, $sexo = null,
            $edad = null, $nacionalidad = null, $rutafotografo = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->sexo = $sexo;
        $this->edad = $edad;
        $this->nacionalidad = $nacionalidad;
        $this->rutafotografo = $rutafotografo;
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getEdad() {
        return $this->edad;
    }

    function getNacionalidad() {
        return $this->nacionalidad;
    }

    function getRutafotografo() {
        return $this->rutafotografo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }

    function setRutafotografo($rutafotografo) {
        $this->rutafotografo = $rutafotografo;
    }

            //3º metodo getJson
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
