<?php
require '../clases/Autocarga.php';
$bd = new DataBase();
$sesion = new Session();

$gestor = new ManageFoto($bd);
$gestorfotografo = new ManageFotografo($bd);
$foto = new Foto();
$id = $foto->getIdautor();
$autorfoto = new Fotografo();
$page = Request::get("page");
if ($page === null || $page === "") {
    $page = 1;
}
$fotos = $gestor->getList($page);
$registros = $gestor->count();
$paginas = ceil($registros / Constants::NRPP);
$op = Request::get("op");
$r = Request::get("r");
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>InPic</title>
        <link rel="stylesheet" type="text/css" href="../css/reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    </head>
    <body>
                    <?php
                    if (!$sesion->isLogged()) {
            ?>
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
            <form action="phplogin.php" method="post" enctype="multipart/form-data" id="formContactar">
                <fieldset>
                    <legend></legend>
                    <p id="encabezadologin">Welcome Photographer!</p>
                    <label for="login"></label>
                    <input type="text" size="30" name="usuario" placeholder="login" id="login" /><br/>
                    <label for="pass"></label>
                    <input type="password" size="30" name="password" placeholder="password" id="pass" /><br/>
                </fieldset>

                <div id="enviar1">
                    <input type="submit" id="botonenviar" class="boton" value="login" accesskey="e" tabindex="20" />

                </div>
                <div id="parrafooculto">
                    <p id="noregistrado"></p>
                </div>
                </form>
                <form action="viewalta.php" method="post" enctype="multipart/form-data" id="formContactar">
                <div id="enviar2">
                    <p id="encabezadoregister">Not a member? Register here</p>
                    <input type="submit" id="botonregistrar" class="boton" value="Sign up!" accesskey="e" tabindex="20" />
                </div>
            </form>
            </div>

        </div>
        <div id="footer">
            <p id="copy">Copyright INPIC 2015</p>
        </div>
                            <?php
        } else {
            if($sesion->getUser() == "admin"){
            $sesion->sendRedirect("gestionadmin.php");
            
            }else{
                $sesion->sendRedirect("gestionusuario.php");  
            }
        }
        ?>
    </body>
</html>
