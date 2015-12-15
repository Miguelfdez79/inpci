<?php
require '../clases/Autocarga.php';
$bd = new DataBase();
$sesion = new Session();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>InPic</title>
        <link rel="stylesheet" type="text/css" href="../css/reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    </head>
    <body>
        <div id ="barradenavegacion">
            <div id="nav">
                <p id="logo">In<span id="logo2">Pic</span></p>
            </div>
            <div id="list">
                <ul class="menuH">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Photos.php">Photos</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="exhibitions.php">Exhibitions</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </div>         
        </div>

        <div id="contenedorformulario">
            <div id="formu">
                <form action="gestionadmin.php" method="post" enctype="multipart/form-data" id="formCongra">
                <fieldset>
                    <legend></legend>
                    <p id="encabezadologin">Please complete all fields</p>
                </fieldset>
                <div id="enviarX">
                    <input type="submit" id="botonenviar" class="boton" value="login" accesskey="e" tabindex="20" />
                </div>
                <div id="parrafooculto">
                    <p id="noregistrado"></p>
                </div>
                </form>
            </div>

        </div>
        <div id="footer">
            <p id="copy">Copyright INPIC 2015</p>
        </div>

    </body>
</html>
