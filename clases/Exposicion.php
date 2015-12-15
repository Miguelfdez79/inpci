<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Exposicion
 *
 * @author Miguel
 */
class Exposicion {

    private $id, $nombreexpo, $direccion, $fecha, $idfotografo, $ruta;
   

        function __construct($id = null, $nombreexpo = null, $direccion = null,
            $fecha = null, $idfotografo = null, $ruta=null) {
        $this->id = $id;
        $this->nombreexpo = $nombreexpo;
        $this->direccion = $direccion;
        $this->fecha = $fecha;
        $this->idfotografo = $idfotografo;
        $this->ruta = $ruta;
    }

     function getRuta() {
        return $this->ruta;
    }
    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

        function getId() {
        return $this->id;
    }

    function getNombreexpo() {
        return $this->nombreexpo;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getIdfotografo() {
        return $this->idfotografo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombreexpo($nombreexpo) {
        $this->nombreexpo = $nombreexpo;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setIdfotografo($idfotografo) {
        $this->idfotografo = $idfotografo;
    }

    public function getJson() {
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '"' . ':' . '"' . $valor . '"' . ',';
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
