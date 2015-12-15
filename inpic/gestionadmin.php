<?php
require '../clases/Autocarga.php';
$sesion = new Session();
if(!$sesion->isLogged()){
    $sesion->sendRedirect("index.php");     
}else{
$user = new Usuario();
$user = $sesion->getUser();
}
$bd = new DataBase();
$gestor = new ManageFoto($bd);
$gestorfotografo = new ManageFotografo($bd);
$gestorexpos = new ManageExposicion($bd);
$foto = new Foto();
$id= $foto->getIdautor();
$autorfoto = new Fotografo(); 
$usuario = Request::get("usuario");
$page = Request::get("page");
if ($page === null || $page === "") {
    $page = 1;
}
$expos = $gestorexpos->getList($page, 999);
 $autorfoto = $gestorfotografo->getList($page);
if($usuario === null || $usuario === ""){
    $fotos = $gestor->getList($page, 18);
}else{
     $fotos = $gestor->getListUserById($usuario, $page, 18);
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
                <h2>Users</h2>
                    <ul class="menuV">
                      <?php      
                        foreach ($autorfoto as $indice => $autor) {
                        $nombredelfotografo = $autor->getNombre(); 
                        $idautor = $autor->getId();
                        echo  "<li><a href='gestionadmin.php?usuario=$idautor'>".$autor->getNombre()." ". $autor->getApellidos()."</a></li>";
                        echo "<a class='borrar' href='phpdelete.php?id=".$autor->getId()."'>Borrar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo "<a class='editar' href='viewedit.php?id=".$autor->getId()."'>Editar</a>";
                        }
                    ?>   
                </ul>
                <div class="divisor"></div>
                <h2>Exhibitions</h2>
                
                <h4><a href="viewinsert.php"><span class="tamaño">+</span> New Exhibition</a> </h4>
                <ul class="menuV">
                <?php
                    foreach($expos as $indice => $expo) { 
                     $nombredelaexpo = $expo->getNombreexpo();        
                     echo "<h3 class='expoedit'>Name: ". $nombredelaexpo."</h3>";
                     echo "<a class='borrar' href='phpdelete.php?idexpo=".$expo->getId()."'>Borrar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                     echo "<a class='editar' href='viewedit.php?idexpo=".$expo->getId()."'>Editar</a>";
       
                    }
                    ?>  
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
                        ' class='fotografia'></a></div><span class='nombrefotografo'>".$autorfoto->getNombre().
                        "</span><a class='borrar' href='phpdelete.php?idfoto=".$foto->getId()."'>Borrar</a></div>";
                      
                     
                    }
                    ?>
            <div class = "paginacion">                         
            <br/>           
            <a class='pag' href="page=1">First</a>
            <a class='pag' href="?page= <?php echo max(1, $page-1);?>">Back</a>
            <a class='pag' href="?page= <?php echo min($page+1, $paginas);?>">Next</a>
            <a class='pag' href="?page= <?php echo $paginas;?>">Last</a>
            </div> 
    
        <script src="../js/script.js"></script>

                </div>
            </div>
            <div id="salir"><p id="cierre"><a href="logout.php">LogOut</a></p></div>
        </div>
        <div id="footer">
            <p id="copy">Copyright INPIC 2015</p>
        </div>

    </body>
</html>

