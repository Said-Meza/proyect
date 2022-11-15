<?php 
    include ("template/cabecera.php");
    include("../CURSO_BOOSTRAP/admin/config/bd.php");
?>
<?php
    $con= new Conexion();
    $sql="SELECT * FROM libro";
    $consulta=$con->consultar($sql);
?>


    <?php
    foreach($consulta as $index)
    { ?>
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" width="200px" alt="300px" src="img/<?php echo $index['IMAGEN'];?>"  >
                <div class="card-body">
                    <h4 class="card-title"><?php echo $index['NOMBRE'];?></h4>
                    <a name="" id="" class="btn btn-primary" href="#" role="button">ver mas..</a>
                </div>
            </div>
        </div>
  
     <?php 
    };?>
      <br>

    



<?php 
    include ("template/pie.php");
?>