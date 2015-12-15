<?php
require '../clases/Autocarga.php';
$bd = new DataBase();
$gestor = new ManageFotografo($bd);
$id = Request::post("pkID");
$nombre = Request::post("nombre");
$apellidos = Request::post("apellidos");
$sexo = Request::post("sexo");
$edad = Request::post("edad");
$nacionalidad = Request::post("nacionalidad");
$nuevofotografo = new Fotografo ($id, $nombre, $apellidos, $sexo, $edad, $nacionalidad);
$r = $gestor->insert($nuevofotografo); 


$bd->close();
header("Location:congratulation.php?op=edit&r=$r");