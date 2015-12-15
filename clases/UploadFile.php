<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadFile
 *
 * @author Miguel
 */
class UploadFile {

    const CONSERVAR = 1, REEMPLAZAR = 2, RENOMBRAR = 3;

      private $destino = "../imagenes/Exhibition/", $nombre = "", $tamaño = 710485760, $parametro;
    private $arrayDeTipos = array("JPG" => 1, "jpg" => 1, "JPEG" => 1, "jpeg" => 1);
    private $extension;
    private $error = false, $politica = self::RENOMBRAR;
    private $subido;

    function __construct($parametro) {

        if (isset($_FILES[$parametro]) && $_FILES[$parametro]["name"] !== "") {

            $this->parametro = $parametro;

            $nombre = $_FILES[$this->parametro]["name"];
            $trozos = pathinfo($nombre); // Array asociativo
            $extension = $trozos["extension"];
            $this->nombre = $trozos["filename"];
            $this->extension = $extension;
        } else {
            $this->error = true;
        }
    }

    function getPolitica() {
        return $this->politica;
    }

    function setPolitica($politica) {
        $this->politica = $politica;
    }

    function setDestino($destino) {
        $this->destino = $destino;
    }

    function setNombre($nombre) {
        $nombre  = str_replace(' ', '', $nombre);;
        $this->nombre = $nombre;
    }

    function setTamaño($tamaño) {
        $this->tamaño = $tamaño;
    }

    function getDestino() {
        return $this->destino;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTamaño() {
        return $this->tamaño;
    }

    public function upload() {
        if($this->subido){
            return false;   
        }
        
        if ($this->error) {
            return false;
        }

        if (!$this->isTipo($this->extension)) {
            return false;
        }

        if ($_FILES[$this->parametro]["error"] != UPLOAD_ERR_OK) {
            return false;
        }
        if ($_FILES[$this->parametro]["size"] > $this->tamaño) {
            return false;
        }

        if (!(is_dir($this->destino) && substr($this->destino, -1) === "/")) {
            return false;
        }

           $nombre = $this->nombre;
        if ($this->politica === self::CONSERVAR && file_exists($this->destino . $this->nombre . "." . $this->extension)) {
            return false;
        }
        
     
         if ($this->politica === self::RENOMBRAR && file_exists($this->destino . $this->nombre . "." . $this->extension)) {
             $nombre = $this->renombrar($nombre);
        }

        $this->subido=true;

//        echo $this->destino.$nombre . "." . $this->extension;
        return move_uploaded_file($_FILES[$this->parametro]["tmp_name"], $this->destino.$nombre . "." . $this->extension);
    }
    
    
    private function renombrar($nombre){
        $i=1;
        while(file_exists($this->destino.$nombre."_".$i.".".$this->extension)){
            $i++;
        }
        return $nombre.'_'.$i;
    }

    public function addTipo($tipo) {
        if (!$this->isTipo($tipo)) {
            $this->arrayDeTipos[$tipo] = 1;
            return true;
        }
        return false;
    }

    public function removeTipo($tipo) {
        if ($this->isTipo($tipo)) {
            unset($this->arrayDeTipos[$tipo]);
            return true;
        }
        return false;
    }

    public function isTipo($tipo) {
        return isset($this->arrayDeTipos[$tipo]);
    }

}
