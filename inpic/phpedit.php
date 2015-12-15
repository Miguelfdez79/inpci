<?php
require '../clases/Autocarga.php';
$bd = new DataBase();
$gestor = new ManageFotografo($bd);
$gestorexpo = new ManageExposicion($bd);
$id = Request::post("pkID");
$nombre= Request::post("nombre");
$apellidos = Request::post("apellidos");
$sexo = Request::post("sexo");
$edad = Request::post("edad");
$nacionalidad = Request::post("nacionalidad");
$nombreexpo = Request::post("nombreexpo");
$direccion = Request::post("direccion");
$fecha = Request::post("fecha");
$idfotografo = Request::post("idfotografo");
$archivo = $_FILES["archivo2"]["name"];

$exposicioneditada = new Exposicion ($id, $nombreexpo, $direccion, $fecha, $idfotografo, $archivo);
//$exposicioneditada = new Exposicion ($id, $nombreexpo, $direccion, $fecha, $idfotografo);
$fotografo = new Fotografo($id, $nombre, $apellidos, $sexo, $edad, $nacionalidad );
$subir = new UploadFile("archivo2");
$subir->setNombre($subir->getNombre());
$subir->setPolitica(UploadFile::RENOMBRAR);
$subir->setDestino("../imagenes/Exhibition/");

$subir->upload();

if(isset($nombreexpo)){
$r = $gestorexpo->set($exposicioneditada, $id); 
}
if(isset($nombre)){
$r = $gestor->set($fotografo, $id);
}

$bd->close();

header("Location:gestionadmin.php?op=edit&r=$r");