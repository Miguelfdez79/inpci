<?php
require '../clases/Autocarga.php';
$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageFoto($bd);
$gestorfotografo = new ManageFotografo($bd);
$foto = new Foto();
$id= $foto->getIdautor();
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
            <div id="cabecero">
                <img src="../imagenes/header.jpg" alt="no se pudo mostrar la imagen" class="imagen">   
            </div>
            <div id="cuerpofotos">
                <h2> LATEST UPLOADS</h2> 
                <div id="ultimas">
                    <?php
                    foreach ($fotos as $indice => $foto) {
                        $rutadelafoto = $foto->getRuta();
                        $id = $foto->getIdautor();
                        $autorfoto = $gestorfotografo->get($id);
                        echo "<div class='contenedorfotos'><div class='foto'><a href='../imagenes/$rutadelafoto'><img src='../imagenes/$rutadelafoto' alt='no se pudo mostrar la imagen
                        ' class='fotografia'></a></div><span class='nombrefotografo'>".$autorfoto->getNombre()."</span></div>";
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
