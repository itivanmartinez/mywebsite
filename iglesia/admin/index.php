<?php
session_start();
if (isset($_SESSION['id'] ) && !empty($_SESSION['id']) ){
  $session=true;
}else{
  $session=false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
  <title>Administracion</title>
<script>
if (window.XMLHttpRequest) {
  //code for ie7, firefox,chrome,opera,safari
   xmlhttp = new XMLHttpRequest();
 }
else {
   //code for ie6,ie5
   xmlhttp = new AciveXObject("Microsoft.XMLHTTP");
}
function actualizarCita(){
  formCita=document.getElementById('frmCita');
  cita=frmCita.cita;
  capitulo=frmCita.capitulo;
 if(cita.value=="" || capitulo.value=="" ){
    alert('Debe ingresar datos en cita o capitulo');
    return;
} else {
  xmlhttp.onreadystatechange = function(){
    if (this.readyState==4 && this.status==200){
      respuesta=this.responseText;
      if (respuesta=="true"){
        alert("La cita se ha actualizado exitosamente");
        location.reload();
      }else{
        alert("Ocurrio un error al cambiar su cita. Trata Nuevamente");
      }
    }
  };
  }
  xmlhttp.open("POST", "actualizarCita.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  str="cita="+cita.value+"&capitulo="+capitulo.value;
  alert(str);
  xmlhttp.send(str);
}
function subirImagen(){
  
  var formImagen=document.getElementById('frmImagen');
  var imagen=formImagen.imagenSubir;
  var file = imagen.files[0];
  var formData1 = new FormData(formImagen);
  formData1.append('imagen', file);
  if (imagen.files.length==0){
    alert('Por favor seleccione una imagen.');
  }else{
    xmlhttp.onreadystatechange=function(){
      if(this.readyState==4 && this.status==200){
        respuesta=this.responseText;
        if(respuesta=="true"){
          alert("La imagen se ha subido exitosamente");
          cargarImagenes();
        }else{
          alert(respuesta);
        }
      }
    };
  }
  xmlhttp.open("POST","subirimagen.php",true);
  xmlhttp.send(formData1);

}
function seleccionarImagen(imagen){
  var id=document.getElementById('mtitle').innerHTML;
  var tipo=document.getElementById('mtipo').innerHTML;
  var target="";
  if (tipo=="ca"){
    target="cambiaimagen.php";
  }
  if (tipo=="no"){
    target="cambiaimagennoticia.php";
  }
  xmlhttp.onreadystatechange=function(){
    if (this.readyState==4 && this.status==200){
      respuesta=this.responseText;
      if (respuesta=="true"){
        alert("La imagen se ha cambiado exitosamente.");
        location.reload();
      }else{
        alert(respuesta);
      }
    }
  };
  str="id="+id+"&image="+imagen;
  xmlhttp.open("POST",target, true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(str);
}
function cargarImagenes(){
  xmlhttp.onreadystatechange = function(){
    if (this.readyState==4 && this.status==200){
      respuesta=this.responseText;
    document.getElementById('listadeimagenes').innerHTML=respuesta;
    }
  };
  xmlhttp.open("POST","listadeimagenes.php",true);
  xmlhttp.send();
}
function actualizarimagencarrousel(title,descripcion,id,mtype){
  ctitle=title.value;
  console.log(ctitle);
  
  cdescripcion=descripcion.value;
  target="";
  if (mtype=="ca"){
    target='actualizarcarrousel.php';
  }
  if (mtype=="no"){
    target='actualizarnoticias.php';
  }
  str="title="+ctitle+"&descripcion="+cdescripcion+"&id="+id;
  xmlhttp.onreadystatechange = function(){
    if( this.readyState==4 && this.status==200){
      respuesta=this.responseText;
      if (respuesta=="true"){
        alert("La informacion se ha actualizado correctamente.");
        location.reload();
      }else{
        alert(respuesta);
      }
    }
  }; 
   xmlhttp.open("POST", target,true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(str);
}
function borrarimagencarrousel(id,mtype){
  target="";
  if (mtype=="ca"){
    target="borrarimagencarrousel.php";
  }
  if (mtype=="no"){
    target="borrarnoticia.php";
  }
  xmlhttp.onreadystatechange=function(){
    if (this.readyState==4 && this.status==200){
      respuesta=this.responseText;
      if (respuesta=="true"){
        alert("Su imagen se ha borrado exitosamente");
        location.reload();
      }else
      alert(respuesta);
    }
  };
  str="id="+id;
  xmlhttp.open("POST",target,true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(str);
}

function agregarcarrousel(){
  xmlhttp.onreadystatechange=function(){
    if (this.readyState==4 && this.status==200){
      respuesta=this.responseText;
      if (respuesta=="true"){
        alert("Se ha agregado nueva imagen");
        location.reload();
      }else{
        alert(respuesta);
      }
    }
  };
  xmlhttp.open("POST", "agregarimagencarrousel.php",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send();
}
function agregarnoticia(){
  xmlhttp.onreadystatechange=function(){
    if (this.readyState==4 && this.status==200){
      respuesta=this.responseText;
      if (respuesta=="true"){
        alert("Se ha agregado nueva noticia");
        location.reload();
      }else{
        alert(respuesta);
      }
    }
  };
  xmlhttp.open("POST", "agregarnoticia.php",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send();
}
</script>
</head>
<body onload="cargarImagenes();">
<?php 
include('header.php');
?>
<?php
if ($session==false){
  echo '<!--LogIn-->';
  include 'loginsection.php';
  die();
}
echo '<!--DASHBOARD-->';
if ($session==true){
  include 'dashboard.php';
}
?>
<?php 
include('footer.php');
?>
</body>

</html>