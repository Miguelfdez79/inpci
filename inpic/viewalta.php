<?php
require '../clases/Autocarga.php';
$bd = new DataBase();
$gestor = new ManageFoto($bd);
$gestorfotografo = new ManageFotografo($bd);
$gestorexpo = new ManageExposicion($bd);
$sesion = new Session();
$id = Request::get("id");
$idexpo = Request::get("idexpo");
$fotografo = $gestorfotografo->get($id);
$exposicion = $gestorexpo->get($idexpo);
$bd = new DataBase();
$autorfoto = new Fotografo(); 
$usuario = Request::get("usuario");
$page = Request::get("page");
if ($page === null || $page === "") {
    $page = 1;
}
$autorfoto = $gestorfotografo->getList($page);
$expos = $gestorexpo->getList($page, 999);
$registros = $gestor->count();
$paginas = ceil($registros / Constants::NRPP);
$op = Request::get("op");
$r = Request::get("r");


?>

<!DOCTYPE html>

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

        <div id="contenedor">
         <div id="lateraIC">
                <h2>New User</h2> 
                    <div id="contenedorform">                          
             <form action="phpaltauser.php" method="POST" enctype="multipart/form-data">
            <span class="titulo">Nombre</span><input type="text" name="nombre" value=""/><br/>
            <span class="titulo">Apellidos</span><input type="text" name="apellidos" value="" /><br/>
            <span class="titulo">Sexo</span><input type="text" name="sexo" value="" /><br/>
            <span class="titulo">Edad</span><input type="number" name="edad" value="" /><br/>
            <span class="titulo">Nacionalidad</span><input type="text" name="nacionalidad" value="" /><br/>
            <span class="titulo"></span><input type="hidden" name="pkID" value="" /><br/>
            <span class="titulo"></span><input type="submit" value="send" id="enviocambios" />
        </form> 

                </div>
            </div>  
        </div>
        <div id="footer">
            <p id="copy">Copyright INPIC 2015</p>
        </div>

    </body>
</html>

<?php
$bd->close();

