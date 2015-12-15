<?php

require '../clases/Autocarga.php';
$sesion =  new Session();
$user = new Usuario();
$user = $sesion->getUser();
$subir = new UploadFile("archivo");
$subir->setNombre($subir->getNombre());
$subir->setPolitica(UploadFile::RENOMBRAR);
$subir->setDestino("./imagenes/Exhibition/");
var_dump($subir);

if($subir->upload()){
    echo "Archivo subido";
    
}else{
    echo "Archivo subido";
}

