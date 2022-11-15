<?php
    include("../template/cabecera.php");
    include("../config/bd.php");
?>

<?php
    $txtID=( isset($_POST['txtID']) )? $_POST['txtID']:"";
    $txtNOMBRE=( isset($_POST['txtNOMBRE']) )? $_POST['txtNOMBRE']:"";
    $img=( isset($_FILES['img']['name']) )? $_FILES['img']['name']:"";
    $accion=( isset($_POST['accion']) )? $_POST['accion']:"";

    $con= new Conexion();
    switch ($accion) {
        case 'agregar':

           $fecha=new DateTime();
            $nombreimg=($img!="")?$fecha->getTimestamp()."_".$_FILES['img']['name']:"imagen.jpg";

            $tmpimagen=$_FILES['img']['tmp_name'];
            if ($tmpimagen!="") {
                move_uploaded_file($tmpimagen,"../../img/".$nombreimg);
            }

            $sentenciasql="INSERT INTO `libro` (`ID`, `NOMBRE`, `IMAGEN`) VALUES (NULL, '$txtNOMBRE', '$nombreimg');";
            $con->ejecutar($sentenciasql);
            $con=null;
            header("Location:libro.php");
            break;

        case 'modificar':
            $fecha=new DateTime();
            $nombreimg=($img!="")?$fecha->getTimestamp()."_".$_FILES['img']['name']:"imagen.jpg";
            $tmpimagen=$_FILES['img']['tmp_name'];

            move_uploaded_file($tmpimagen,"../../img/".$nombreimg);

            $sql="SELECT IMAGEN FROM libro WHERE ID='$txtID'";
            $consulta=$con->consultarid($sql);
            //$img=$consulta['IMAGEN'];

            if( isset($consulta['IMAGEN']) && ($consulta['IMAGEN']!="imagen.jpg"))
            {
                if (file_exists("../../img/".$consulta['IMAGEN'])) {
                   unlink("../../img/".$consulta['IMAGEN']);
                }
            }

           //UPDATE `libro` SET `NOMBRE`='$txtNOMBRE',`IMAGEN`='$img' WHERE `ID`='$txtID',
           $sentenciasql="UPDATE `libro` SET `NOMBRE`='$txtNOMBRE' WHERE `ID`='$txtID'";
            $con->ejecutar($sentenciasql);
            if ($img!="") 
            {
                $sentenciasql="UPDATE `libro` SET `IMAGEN`='$nombreimg' WHERE `ID`='$txtID'";
                $con->ejecutar($sentenciasql);
            }
            $con=null;
            header("Location:libro.php");
            break;

        case 'eliminar':
            header("Location:libro.php");
            break;

        case 'SELECCIONAR':
            
            $sql="SELECT * FROM libro WHERE ID='$txtID'";
            $consulta=$con->consultarid($sql);
            $txtID=$consulta['ID'];
            $txtNOMBRE=$consulta['NOMBRE'];
            $img=$consulta['IMAGEN'];
            break;

        case 'BORRAR':

            $sql="SELECT IMAGEN FROM libro WHERE ID='$txtID'";
            $consulta=$con->consultarid($sql);
            //$img=$consulta['IMAGEN'];

            if( isset($consulta['IMAGEN']) && ($consulta['IMAGEN']!="imagen.jpg"))
            {
                if (file_exists("../../img/".$consulta['IMAGEN'])) {
                   unlink("../../img/".$consulta['IMAGEN']);
                }
            }

            $sentenciasql="DELETE FROM LIBRO WHERE ID='$txtID'";
            $con->ejecutar($sentenciasql);
            $con=null;
            header("Location:libro.php");
            break;                            
        
    }
    
?>

<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            REGISTRO LIBROS
        </div>
        <div class="card-body">

            <form  method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" placeholder="ID" value="<?php echo $txtID;?>" name="txtID" id="txtID" >
                </div>
                <div class="form-group">
                    <label for="txtNOMBRE">NOMBRE:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNOMBRE;?>" placeholder="NOMBRE DEL LIBRO" name="txtNOMBRE" 
                        id="txtNOMBRE" >
                </div>
                <div class="form-group">
                    <label for="txtNOMBRE">IMAGEN: <?php echo $img;?></label><br>
                            <?php if ($img!="") 
                            { ?>
                                <img class="img-thumbnail rounded" src="../../img/<?php echo $img;?>" width="200px" alt="" srcset="">
                                    
                                <?php
                            } ?><br>
                    <input type="file"  class="form-control" placeholder="imagen" name="img" id="img" >
                </div><BR>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" value="agregar" name="accion" <?php echo ($accion=="SELECCIONAR")?"disabled":"";?> class="btn btn-primary">agregar</button>
                    <button type="submit" value="modificar" name="accion" <?php echo ($accion!="SELECCIONAR")?"disabled":"";?> class="btn btn-warning">modificar</button>
                    <button type="submit" value="eliminar" name="accion" <?php echo ($accion!="SELECCIONAR")?"disabled":"";?> class="btn btn-info">cancelar</button>
                </div>
            </form>
        
        </div>

    </div>


</div>

<div class="col-md-7">
    TABLA DE ELEMENTOS(LIBROS)
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE </th>
                <th>IMAGEN</th>
                <th>ACCIONES</th>
            </tr>
        </thead>

        <tbody>
            
                    <?php
                        $con=new Conexion();
                        $sql="SELECT * FROM libro";
                        $consulta=$con->consultar($sql);
                        foreach($consulta as $index)
                {
                    ?>
                    <tr>
                        <td><?php echo $index['ID'];?></td>
                        <td><?php echo $index['NOMBRE'];?></td>
                        <td>
                            <img class="img-thumbnail rounded" src="../../img/<?php echo $index['IMAGEN'];?>" width="200px" alt="" srcset="">
                            
                        </td>
                        <TD>
                                <form method="POST">
                                    <input type="hidden"  value="<?php echo $index['ID'];?>" name="txtID" id="txtID">
                                    <input type="submit" value="SELECCIONAR" name="accion" class="btn btn-primary"/>
                                    <input type="submit" value="BORRAR" name="accion" class="btn btn-danger"/>
                                </form>
                        </TD>
                    </tr>
                    
                    <?php
                }
                $con=null;
                    ?>
        </tbody>

    </table>
    
</div>



<?php
    include("../template/pie.php");

?>