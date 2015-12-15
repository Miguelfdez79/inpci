<?php

require "../clases/Autocarga.php";
$array = array("admin" => "admin");
$usuario = Request::post("usuario");
$pass = Request::post("password");
$sesion = new Session();
$user = new Usuario();
$user->setNombre($usuario);
$user->setClave($pass);
$bd = new DataBase();
$gestorfotografo = new ManageFotografo($bd);
$fotografo = new Fotografo();
$fotografos = $gestorfotografo->getListAll();



if ($usuario == "admin" && $pass == "admin") {
    $sesion->setUser($user);
    //Usar el apellido
    $sesion->sendRedirect("gestionadmin.php"); // cambiar por admin
} else {
    if (isset($usuario) && isset($pass)) {
        foreach ($fotografos as $indice => $fotografo) {
            $nombredelfotografo = $fotografo->getNombre();
            $apellidos = $fotografo->getApellidos();
            if ($usuario === $nombredelfotografo && $pass === $apellidos) {
                $sesion->setUser($user);
                $sesion->sendRedirect("gestionusuario.php");
            }
        }
        $sesion->sendRedirect("gestionerrores.php");
    } else {
        $sesion->destroy();
        $sesion->sendRedirect("Location:login.php");
    }
}


