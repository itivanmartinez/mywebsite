<?php
$directory="../img/";
include('connection.php');
$sql="SELECT * FROM img_carrousel";
if (!$result=mysqli_query($connection,$sql)){
    echo "Se ha producido un error.".mysqli_error($connection);
    die();
}
while ($row=mysqli_fetch_array($result)){
    $imagen=$row['imagen'];
    $titulo=$row['titulo'];
    $descripccion=$row['descripccion'];
    $id=$row['id'];
    echo "<figure class=\"figure col-md-6 col-lg-4 border rounded ml-auto mr-auto\">
    <form>
        <img src=\"$directory$imagen\" alt=\"\"
            class=\"figure-img img-fluid rounded mb-2 mt-2\">
        <button type=\"button\" class=\"btn btn-block btn-primary mb-2\" data-toggle=\"modal\" data-target=\"#modalimagenes\" data-tipo='ca' data-imgid='$id'>Cambiar Imagen</button>
        <label for=\"imgtitle$id\">Titulo</label>
        <textarea id=\"imgtitle$id\" rows=\"1\" class=\"form-control mb-2 \">$titulo</textarea>
        <label for=\"imgdescripccion\">Descripcion</label>
        <textarea id=\"imgdescripccion$id\" rows=\"3\"
            class=\"form-control mb-2\">$descripccion</textarea>
        <button type='button' class=\"btn btn-block btn-primary mb-2\" onclick=\"actualizarimagencarrousel(imgtitle$id,imgdescripccion$id,$id,'ca');\">Actualizar</button>
        <button type='button' class=\"btn btn-block btn-danger mt-2\" onclick=\"borrarimagencarrousel($id,'ca');\">Borrar Imagen</button> 
    </form>
</figure>";
}
        
mysqli_close($connection);
        ?>
        <div class="col-12">
            <button class="form-control btn btn-primary" type="button" onclick="agregarcarrousel();">Agregar al carrousel</button>
        </div>