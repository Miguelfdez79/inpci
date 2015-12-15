<?php
require '../clases/Autocarga.php';
$bd = new DataBase();
$gestor = new ManageExposicion($bd);
$gestorfotografo = new ManageFotografo($bd);
$autorexpo = new Fotografo();
$page = Request::get("page");
if ($page === null || $page === "") {
    $page = 1;
}
$expos = $gestor->getList($page, 999);
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

        <div id="contenedorcart">
            <div id="lateralC">
                <h2 class="titulazo">Exhibitions</h2>
                <div id="contenedorexpos">
                     <?php
                    foreach($expos as $indice => $expo) { 
                     $nombredelaexpo = $expo->getNombreexpo();
                     $rutadelaexpo = $expo->getRuta();
                     $id = $expo->getIdfotografo();
                     $idexposicion = $expo->getIdfotografo();
                    $autorexpo = $gestorfotografo->get($id);
                     echo "<div class='contenedorexpo'>";
                     echo "<h3>Name: ". $nombredelaexpo."</h3>";
                     echo "<h3>Photographer: ". $autorexpo->getNombre()."</h3>";
                     echo "<h3>Date: ". $expo->getFecha()."</h3>";
                     echo "<h3>Address: ". $expo->getDireccion()."</h3>";
                     echo "<img src='../imagenes/Exhibition/$rutadelaexpo' alt='no se pudo mostrar la imagen
                        ' class='expo'></a></div><span class='nombrefotografo'>";
                     echo "</div>";
                    }
                    ?> 
                    
                </div>
 
            </div>
        </div>
        <div id="footer">
            <p id="copy">Copyright INPIC 2015</p>
        </div>
 
    </body>
</html>
