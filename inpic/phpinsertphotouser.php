<?php
require '../clases/Autocarga.php';
$bd = new DataBase();
$nuevafoto = new ManageFoto($bd);
$sesion = new Session();
if(!$sesion->isLogged()){
    $sesion->sendRedirect("index.php");     
}else{
$user = new Usuario();
$user = $sesion->getUser();
}
$id = Request::post("pkID");
$titulo = Request::post("titulo");
$categoria = Request::post("categoria");
$fecha = Request::post("fecha");
$idfotografo = Request::post("idfotografo");
$archivo = $_FILES["archivo"]["name"];
$fotografia= new Foto (null, $id, $titulo, $categoria, $fecha, $archivo);
$r = $nuevafoto->insert($fotografia);

$subir = new UploadFile("archivo");
$subir->setNombre($subir->getNombre());
$subir->setPolitica(UploadFile::RENOMBRAR);
$subir->setDestino("../imagenes/");

$subir->upload();

$bd->close();
header("Location:gestionusuario.php?op=edit&r=$r");