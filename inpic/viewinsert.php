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
if(!$sesion->isLogged()){
    $sesion->sendRedirect("index.php");     
}else{
$user = new Usuario();
$user = $sesion->getUser();
}
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
            <div id="lateralI">
                <h2>Usuarios</h2>
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
                <h2>Edit Field</h2> 
                    <div id="contenedorform">                          
                        <form action="phpinsert.php" method="POST" enctype="multipart/form-data">
            <span class="titulo">Nombre Expo</span><input type="text" name="nombreexpo" value=""/><br/>
            <span class="titulo">Direccion</span><input type="text" name="direccion" value="" /><br/>
            <span class="titulo">Fecha</span><input type="date" name="fecha" value="" /><br/>
             <span class="titulo">Identificador</span><?php echo Util::getSelect("idfotografo", $gestorfotografo->getValuesSelect(), $fotografo = $gestorfotografo->get($id), false); ?><br/>
<!--            <span class="titulo">Identificador</span><input type="number" name="idfotografo" value="" /><br/>-->
            <span class="titulo">Cartel</span><input type="file" name="archivo" />
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

