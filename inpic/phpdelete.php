<?php
require '../clases/Autocarga.php';
$bd = new DataBase();
$gestor = new ManageFotografo($bd);
$gestorfoto = new ManageFoto($bd);
$gestorexpo = new ManageExposicion($bd);
$id = Request::get("id");
$idfoto = Request::get("idfoto");
$idexpo = Request::get("idexpo");
$r = $gestor->delete($id);
$rr = $gestorfoto->delete($idfoto);
$rrr = $gestorexpo->delete($idexpo);

$bd->close();

header("Location:gestionadmin.php?op=delete&r=$r");