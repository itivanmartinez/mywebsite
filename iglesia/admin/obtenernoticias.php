<?php
$directory="../img/";
include('connection.php');
$sql="SELECT * FROM noticias";
if (!$result=mysqli_query($connection,$sql)){
    echo "Se ha producido un error.".mysqli_error($connection);
    die();
}
while ($row=mysqli_fetch_array($result)){
    $imagen=$row['imagen'];
    $titulo=$row['titulo'];
    $descripcion=$row['descripcion'];
    $id=$row['id'];
    echo "<figure class=\"figure col-md-6 col-lg-4 border rounded \">
    <form action=\"\">
        <img src=\"$directory$imagen\" alt=\"\"
            class=\"figure-img img-fluid rounded mb-2 mt-2\">
        <button type='button' class=\"btn btn-block btn-primary mb-2\" data-toggle=\"modal\" data-target=\"#modalimagenes\" data-tipo='no' data-imgid='$id'>Cambiar Imagen</button>
        <label for=\"ntitle$id\">Titulo</label>
        <textarea name=\"ntitle$id\" rows=\"2\" class=\"form-control mb-2\">$titulo</textarea>
        <label for=\"ndescripccion$id\">Descripcion</label>
        <textarea name=\"ndescripccion$id\" rows=\"3\"
            class=\"form-control mb-2\">$descripcion</textarea>
        <button class=\"btn btn-block btn-primary mb-2\" onclick=\"actualizarimagencarrousel(ntitle$id,ndescripccion$id,$id,'no');\">Actualizar</button>
        <button type='button' class=\"btn btn-block btn-danger mt-2\" onclick=\"borrarimagencarrousel($id,'no');\">Borrar noticia</button> 
    </form></figure>";

}
mysqli_close($connection);
?>
        <div class="col-12">
            <button class="form-control btn btn-primary" type="button" onclick="agregarnoticia();">Agregar noticia</button>
        </div>

