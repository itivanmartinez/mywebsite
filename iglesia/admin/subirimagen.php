<?php
if (isset($_FILES['imagen'])){
    
    $errores=array();
    $archivoNombre=basename($_FILES['imagen']['name']);
    $archivoSize=$_FILES['imagen']['size'];
    $archivoTmp=$_FILES['imagen']['tmp_name'];
    $archivoType=$_FILES['imagen']['type'];
    $targetFile="../img/".$archivoNombre;
    if($archivoSize>15400000){
        $errores[]="El archivo es demasiado largo";
    }
    if (file_exists($targetFile)) {
        $errores[]= "Sorry, file already exists.".$targetFile;
    }
    if(empty($errores)==true){
        if(move_uploaded_file($archivoTmp,$targetFile)==true){
            echo "true";
        }else{
            $errores[]="El archivo ya existe";
            print_r($errores);
        }
        
    }else{
        print_r($errores);
    }
}

?>