<?php 
    include("template/cabecera.php")
?>
            <div class="col-md-12">
                
                <div class="p-5 bg-light">
                    <div class="container">
                        <h1 class="display-3">bienvenido <?php echo $_SESSION["nombreusuario"]; ?></h1>
                        <p class="lead">administar lkibros en el sitio web</p>
                        <hr class="my-2">
                        <p>More info</p>
                        <p class="lead">
                            <a class="btn btn-primary btn-lg" href="secciones/libro.php" role="button">Jumbo action name</a>
                        </p>
                    </div>
                </div>

            </div>
            
 <?php
    include("template/pie.php")
?>