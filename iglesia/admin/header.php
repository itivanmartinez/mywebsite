  <!-- START HERE -->
  <nav class="navbar navbar-expand-md navbar-light bg-primary text-success fixed-top py-4" id="main-nav">
  <div class="container">
    <a href="index.php" class="navbar-brand">
      <img src="../img/mlogo.jpg" width="50" height="50" alt="">
      <h2 class="d-none d-lg-inline align-middle">Iglesia Refugio de Salvacion</h2>
    </a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarCollapse" class="collapse navbar-collapse ">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="cerrarsesion.php" class="nav-link">Cerrar Sesion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
<div class="row justify-content-end">
<div class="col-5 text-right">
<a href="messages.php"><h5>Ver Mensajes</h5></a>
</div></div>
</div>
<!--Modal-->
<div class="modal fade" id="modalimagenes" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Seleccione Una Imagen para id:<span class="mtitle" id="mtitle"></span> <span class="mtipo" id="mtipo"></span></h5>
        <button type="button" class="close" data-dismiss="modal" >
            <span >&times;</span>
        </button>
      </div><!--header-->
      <div class="modal-body" id='listadeimagenes'>
        <?php include('listadeimagenes.php');  ?>
      </div>

    </div>
  </div>
</div>