<?php
$directory="../img/";
$imagenes=scandir($directory);
echo '<div class="container-fluid">';
echo '<div class="row">';
foreach ($imagenes as $imagen => $value) {
    if($imagen>1){
    $imagenName=$directory.$imagenes[$imagen];
    echo "<div class=\"col-4 mt-3\">
        <div class=\"card d-block h-100\">
        <img src=\"$imagenName\"  class=\"card-img-top h-100 img-effect-hover\" onclick=\"seleccionarImagen('$imagenes[$imagen]');\">
        </div>
    </div>"; 
    }

}
echo '</div>';
echo '</div>';

?>