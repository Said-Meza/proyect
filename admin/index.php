<?php
    session_start();
    if ($_POST) 
    {
        if (($_POST['usuario']=="said") && ($_POST['pass']="said")) {

            $_SESSION["usuario"]="ok";
            $_SESSION["nombreusuario"]="said";
            header("Location:inicio.php");
            
        }else
        {
            $mensage="usuario o contra incorrectos";
        }
    
    }
//action="index.php"
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <br><br><br>

                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center text-info">Login</h3>
                    </div>
                    <div class="card-body">
                        <?php if ( isset($mensage) ) { ?>
                            <div class="alert alert-primary" role="alert">
                                <?php echo $mensage; ?>
                            </div>
                         
                            <?php 
                            }
                            ?>
                        <form  method="post">


                            <div class="form-group">
                                <label for="usuario">Username:</label><br>
                                <input type="text" name="usuario" class="form-control" placeholder="escribe tu email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label><br>
                                <input type="password" name="password" class="form-control" placeholder="contraseña">
                            </div>

                            <div class="form-group">
                                <br>
                                <input type="submit" name="submit" class="btn btn-primary" value="entrar">
                            </div>



                        </form>


                    </div>

                </div>

            </div>

        </div>

    </div>
    </div>

</body>

</html>