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
$fotografo = new Fotografo($id, $nombre, $apellidos, $sexo, $edad, $nacionalidad );

$r = $gestor->set($fotografo, $id);

$bd->close();
$sesion = new Session();
$user = new Usuario();
$user->setNombre($nombre);
$user->setClave($apellidos);
$sesion->setUser($user);

header("Location:gestionusuario.php?op=edit&r=$r");