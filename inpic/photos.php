<?php
require '../clases/Autocarga.php';
$bd = new DataBase();
$gestor = new ManageFoto($bd);
$gestorfotografo = new ManageFotografo($bd);
$foto = new Foto();
$autorfoto = new Fotografo();
$id= $foto->getIdautor();
$categoria = Request::get("categoria");
$page = Request::get("page");
if ($page === null || $page === "") {
    $page = 1;
}
if($categoria === null || $categoria === ""){
    $fotos = $gestor->getList($page, 18);
}else{
    $fotos = $gestor->getListCategoria($categoria, $page, 18);
}
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
            <div id="lateralI">
                <h2>Category</h2>
                    <ul class="menuV">
                    <li><a href="photos.php">All</a></li>
                    <li><a href="photos.php?categoria=Abstract">Abstract</a></li>
                    <li><a href="photos.php?categoria=Animal">Animal</a></li>
                    <li><a href="photos.php?categoria=Architecture">Architecture</a></li>
                    <li><a href="photos.php?categoria=Advenure">Advenure</a></li>
                    <li><a href="photos.php?categoria=Landscapes">Landscapes</a></li>
                    <li><a href="photos.php?categoria=Horror">Horror</a></li>
                    <li><a href="photos.php?categoria=Macro">Macro</a></li>
                    <li><a href="photos.php?categoria=People">People</a></li>
                </ul>  
            </div>
            <div id="lateralD">
                <h2>Gallery</h2> 
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
            <div class = "paginacion">                         
            <br/>           
            <a class='pag' href="page=1">First</a>
            <a class='pag' href="?page= <?php echo max(1, $page-1);?>">Back</a>
            <a class='pag' href="?page= <?php echo min($page+1, $paginas);?>">Next</a>
            <a class='pag' href="?page= <?php echo $paginas;?>">Last</a>
            </div> 
    
        <script src="../js/scripts.js"></script>

                </div>
            </div>  
        </div>
        <div id="footer">
            <p id="copy">Copyright INPIC 2015</p>
        </div>

    </body>
</html>
