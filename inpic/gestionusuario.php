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
$Identificacion = $gestorfotografo->getName($user->getNombre());
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
                <h2>Welcome <?php  echo $user->getNombre() ?></h2>
            <form action="phpinsertphotouser.php" method="POST" enctype="multipart/form-data" class="formuser">
                <span class="titulo2">Upload new photo</span><input type="file" name="archivo" />
                <span class="titulo">Título</span><input type="text" name="titulo" value=""/><br/>
                <span class="titulo">Categoria</span><select name="categoria">
  <option value="Abstract">Abstract</option>
  <option value="Animal">Animal</option>
  <option value="Architecture">Architecture</option>
  <option value="Adventure">Adventure</option>
  <option value="Landscapes">Landscapes</option>
  <option value="Horror">Horror</option>
  <option value="Macro">Macro</option>
  <option value="People">People</option>
</select><br/>
                  <span class="titulo">Fecha</span><input type="date" name="fecha" value="" /><br>   
                  <span class="titulo2"></span><input type="hidden" name="pkID" value="<?php echo $Identificacion[0]->getId(); ?>" /><br/>
            <span class="titulo2"></span><input type="submit" value="send" id="enviocambios2" />
        </form>
                <div class="divisor"></div>
                <h2>User Information</h2>
             <form action="phpedituser.php" method="POST"  class="formuser">
            <span class="titulo">Nombre</span><input type="text" name="nombre" value="<?php echo $Identificacion[0]->getNombre(); ?>"/><br/>
            <span class="titulo">Apellidos</span><input type="text" name="apellidos" value="<?php echo $Identificacion[0]->getApellidos(); ?>" /><br/>
            <span class="titulo">Sexo</span><input type="text" name="sexo" value="<?php echo $Identificacion[0]->getSexo(); ?>" /><br/>
            <span class="titulo">Edad</span><input type="number" name="edad" value="<?php echo $Identificacion[0]->getEdad(); ?>" /><br/>
            <span class="titulo">Nacionalidad</span><input type="text" name="nacionalidad" value="<?php echo $Identificacion[0]->getNacionalidad(); ?>" /><br/>
            <span class="titulo"></span><input type="hidden" name="pkID" value="<?php echo $Identificacion[0]->getId(); ?>" /><br/>
            <span class="titulo"></span><input type="submit" value="send" id="enviocambios" />
        </form> 
            </div>
            <div id="lateralD">
                <h2>Gallery</h2> 
                <div id="ultimas">
                    <?php
                    foreach ($fotos as $indice => $foto) {
                      $rutadelafoto = $foto->getRuta(); 
                        $id = $foto->getIdautor();
                        $autorfoto = $gestorfotografo->get($id);
                        if($autorfoto->getNombre() === $user->getNombre()){
                        echo "<div class='contenedorfotos'><div class='foto'><a href='../imagenes/$rutadelafoto'><img src='../imagenes/$rutadelafoto' alt='no se pudo mostrar la imagen
                        ' class='fotografia'></a></div><span class='nombrefotografo'>".$autorfoto->getNombre().
                        "</span><a class='borrar' href='phpdeleteuser.php?idfoto=".$foto->getId()."'>Borrar</a></div>";
                        }
                     
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

