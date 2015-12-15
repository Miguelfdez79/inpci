<?php
require '../clases/Autocarga.php';
$bd = new DataBase();
$gestorexpo = new ManageExposicion($bd);
$id = Request::post("pkID");
$nombreexpo = Request::post("nombreexpo");
$direccion = Request::post("direccion");
$fecha = Request::post("fecha");
$idfotografo = Request::post("idfotografo");
$archivo = $_FILES["archivo"]["name"];
$exposicioneditada = new Exposicion ($id, $nombreexpo, $direccion, $fecha, $idfotografo, $archivo);

$r = $gestorexpo->insert($exposicioneditada); 

$subir = new UploadFile("archivo");
$subir->setNombre($subir->getNombre());
$subir->setPolitica(UploadFile::RENOMBRAR);
$subir->setDestino("../imagenes/Exhibition/");

$subir->upload();

$bd->close();
header("Location:gestionadmin.php?op=edit&r=$r");