<?php
include('admin/obtenercita.php');
include('admin/obtenercarrousel.php');
include('admin/obtenernoticiashome.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Caveat|Cookie|Great+Vibes|News+Cycle" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Iglesia</title>
  <script>
    if (window.XMLHttpRequest) {
  //code for ie7, firefox,chrome,opera,safari
   xmlhttp = new XMLHttpRequest();
 }
else {
   //code for ie6,ie5
   xmlhttp = new AciveXObject("Microsoft.XMLHTTP");
}
  function enviarmensaje(mnombre,memail,mmensaje) {
    var enombre=mnombre.value;
    var eemail=memail.value;
    var emensaje=mmensaje.value;
    xmlhttp.onreadystatechange=function(){
    if (this.readyState==4 && this.status==200){
      respuesta=this.responseText;
      if (respuesta=="true"){
        alert("Su mensaje se ha enviado exitosamente.");
        location.reload();
      }else{
        alert(respuesta);
      }
    }
  };
  str="nombre="+enombre+"&email="+eemail+"&mensaje="+emensaje;
  xmlhttp.open("POST", "admin/enviarmensaje.php",true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(str);
  }
  </script>
</head>

<body id="home" data-spy="scroll" data-target='#main-nav'>
  <!-- START HERE -->
  <section>
  
  <div class="container">
  <div class="row">
  <nav class="navbar navbar-expand-md navbar-light bg-primary text-success fixed-top py-4" id="main-nav">
  <div class="container">
    <a href="#home" class="navbar-brand">
      <img src="img/mlogo.jpg" width="50" height="50" alt="">
      <h3 class="d-none d-lg-inline align-middle">Iglesia Refugio de Salvacion</h3>
    </a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="#home" id="home" class="nav-link">Inicio</a>
        </li>
        <li class="nav-item">
            <a href="#historia" id="home" class="nav-link">Historia</a>
        </li>
        <li class="nav-item">
            <a href="#noticias" id="home" class="nav-link">Noticias</a>
        </li>

        <li class="nav-item">
            <a href="#contacto" id="home" class="nav-link">Contacto</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  </div>
 
  </div>
  </section>
  

<!--Showcase-->
<section id="showcase" class="py-5">
  <div class="primary-overlay text-white">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 text-center">
          <h1 class="mt-5 pt-5 showcase-title"><?php echo $cita ?></h1>
          <h4><?php echo $capitulo ?></h4>
        </div>
        <div class="col-lg-7 text-center d-none d-lg-inline">
          <div id="carouselExampleIndicators" class="carousel slide p-5" data-ride="carousel">
            <ol class="carousel-indicators">
              <?php 
              $numImagenes= mysqli_num_rows($resultcarrousel);
              for ($i=0; $i < $numImagenes; $i++) { 
                if ($i==0){
                  echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"0\" class=\"active\"></li>";
                }else{
                  echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"$i\"></li>";
                }
              }
              ?>
            </ol>
            <div class="carousel-inner">
              <?php
              $i=0;
              while ($row=mysqli_fetch_array($resultcarrousel)){
                
                $image=$row['imagen'];
                $titulo=$row['titulo'];
                $descripcion=$row['descripccion'];
                $directorio="img/";
                if ($i==0){
                  $active='active';
                }else{
                  $active='';
                }
                echo "<div class=\"carousel-item $active\">";
                echo "<img src=\"$directorio$image\" class=\"d-block w-100 \" alt=\"...\">";
                echo "<div class=\"carousel-caption d-none d-md-block\">";
                echo "<h5>$titulo</h5>";
                echo "<p>$descripcion</p>";
                echo "</div></div>";
                $i+=1;
              }
              
              ?>

            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div><!--carrousel-->
        </div>
      </div>
    </div>
  </div>
</section>
<section id="newsletter" class="bg-warning py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <input type="text" class="form-control form-control-lg mb-resp" placeholder="Enter Name">
      </div>
      <div class="col-md-4">
          <input type="text" class="form-control form-control-lg mb-resp" placeholder="Enter Email">
      </div>
      <div class="col-md-4">
          <button class="btn btn-primary btn-lg btn-block"><i class="fa fa-envelope pr-2"></i>Suscribete</button>
      </div>
    </div>
  </div>
</section>
<!--HISTORIA-->
<section id="historia" class="bg-info py-5">
  <div class="container">
    <div class="row">
      <div class="col text-success">
        <h5 class="mb-4 text-center display-4">Historia del Templo.</h5>
        <img src="img/face51.jpg" alt="" class="float-left mr-1 float-sm-none" id="img-history">
        <p class="text-justify ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste facere eos pariatur, ratione repellendus cupiditate provident sed, dolore magnam minus iusto optio similique atque recusandae neque non minima. 
          Dolorem pariatur commodi nesciunt aliquid temporibus officia enim voluptas excepturi dolor nulla accusamus illo harum tempora,
           nostrum culpa sit doloribus rerum, inventore recusandae quo iste reiciendis? Voluptatum porro aspernatur iure iste 
           accusantium tempora! </p><p class="text-justify">Consequatur earum expedita ratione cum et rem eius adipisci perferendis nemo veritatis accusantium,
            culpa sequi maxime debitis. Cupiditate, sit? Est repellat sit nemo nisi. Culpa error illo laborum, cumque nesciunt sed!
             Vitae excepturi expedita tempore soluta ipsam nam, obcaecati dicta sed reprehenderit eligendi ad sint impedit officiis culpa
              sunt provident eius ut rem quasi quidem eveniet est ratione voluptate maxime. Quae enim repudiandae nostrum unde alias 
              ducimus delectus suscipit eos, commodi eaque id, explicabo perspiciatis, totam dicta animi esse nemo vel nesciunt vitae 
              possimus. Sit, quibusdam illo exercitationem doloremque illum dolorem tenetur asperiores, perspiciatis vel ratione iste, 
              deserunt dolores. Doloribus voluptatibus assumenda totam culpa illum consequatur facere id dolor dolorum nisi quo, velit 
              adipisci harum hic eius in quasi, laborum quis nostrum error? Est officia itaque ut rem tempore provident eius sunt harum 
              adipisci libero quibusdam expedita veniam quos, culpa sint, modi dolorum asperiores minus. Dolores cum dicta eaque pariatur,
              s molestias. 
           Aliquid eaque corporis fugit iure, ab doloremque sit non sunt quia 
           necessitatibus numquam. Iste saepe animi optio est et sapiente quasi omnis perspiciatis. Ducimus nihil reiciendis quaerat,
           perferendis vel quos culpa soluta, non dolorem, quam doloribus quas.</p>
    </div>
  </div>
  </div>
</section>
<!--NOTICIAS-->
<section class="bg-warning text-info py-5" id="noticias">
  

  <div class="container">
    <div class="row">
    <div class="col-12"><h1 class="display-4 text-center text-primary">Noticias</h1></div>
      <?php 
      while ($row=mysqli_fetch_array($resultnoticias)){
        $imagen=$row['imagen'];
        $titulo=$row['titulo'];
        $descripcion=$row['descripcion'];
        $directorio="img/";
        echo "
        <div class=\"col-lg-3 col-md-6\">
          <div class=\"card text-center border-primary mb-resp\">
              <img src=\"$directorio$imagen\" alt=\"$titulo\" class=\"card-img-top\">
            <div class=\"card-body\">
              <h3 class=\"text-primary\">$titulo</h3>
              <p class=\"text-justify\">$descripcion</p>
            </div>
            </div>
    </div>";
      }
      
      
      ?>


  </div>
  </div>
</section>

<!--CONTACTO-->
<section class="bginfo py-5 text-primary" id="contacto">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-9">
        <h3>Dejanos Un Mensaje</h3>
        <p class="lead">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit, dolorem?</p>
        <form action="">
          <div class="input-group input-group-lg mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="fas fa-user"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="Nombre" id='nombre'>
          </div>

          <div class="input-group input-group-lg mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fas fa-envelope"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Email" id='email'>
            </div>

            <div class="input-group input-group-lg mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text ">
                    <i class="fas fa-user "></i>
                  </span>
                </div>
                <textarea type="text" class="form-control" placeholder="Mensaje" rows="5" id="mensaje"></textarea>
              </div>
            <button type="button" class="btn btn-primary btn-block btn-lg" onclick="enviarmensaje(nombre,email,mensaje);">Enviar</button>
        </form>
      </div>
      <div class="col-lg-3 col-sm-3 d-none d-lg-block align-self-center">
        <img src="img/mlogo.jpg" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</section>
<!--FOOTER-->
<footer id="main-footer" class="py-5 bg-primary text-white">
  <div class="container">
    <div class="row">
      <div class="col text-right">
          <span class="copy">Copyright</span> &copy; <span class="year"></span>
          <span class="text-left"><i class="fab fa-facebook fa-3x"></i></span> 
          <span><i class="fab fa-twitter-square fa-3x"></i></span>
      </div>      
    </div>
  </div>
</footer>

  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

  <script>
    // Get the current year for the copyright   
    $('#year').text(new Date().getFullYear());
    $('body').scrollspy({target:'#main-nav'});
    $('#main-nav a').on('click',function(event){
      if (this.hash !==""){
        event.preventDefault();
        const hash=this.hash;
        $('html,body').animate({
          scrollTop:$(hash).offset().top
        },800,function(){
          window.location.hash=hash;
        });
      }
    });
  </script>
</body>

</html>