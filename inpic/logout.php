<?php

require "../clases/Autocarga.php";

$sesion = new Session();
$sesion ->destroy();
$sesion->sendRedirect("index.php");