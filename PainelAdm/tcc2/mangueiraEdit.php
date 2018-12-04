<?php
require 'db_credentials.php';
require 'authenticate.php';
require 'lib/sanitize.php';

if(!$login){
  header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/login.php");}

$conn = mysqli_connect($servername, $username, $password, $dbname, $port, $socket);

if (!$conn) {
  die("Problemas ao conectar com o BD!<br>".
       mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    
    if(isset($_GET["id"])){  
      
      $id=$_GET["id"];

      $sql = "SELECT * from mangueira where id_mangueira='$id'";

      if(!($mangueira = mysqli_query($conn,$sql))){
          die("Problemas para carregar as Mangueiras do BD!<br>".
            mysqli_error($conn));
      }else{
        $mangueira=mysqli_query($conn,$sql);

        $mangueira=mysqli_fetch_assoc($mangueira);
      }
      if(isset($_GET["confirmar"])){
        
        /*if(!is_null(($_GET["marcaEssencia"]))  or !is_null(($_GET["preçoEssencia"])) or !is_null(($_GET["saborEssencia"])) or !is_null(($_GET["categoriaEssencia"]))) {
          echo "preencha todos os campos";
        }else{*/
        $id=$_GET["id"];

        $marcaMangueira = sanitize($_GET["marcaMangueira"]);
        $marcaMangueira = mysqli_real_escape_string($conn,$marcaMangueira);

        $corMangueira = sanitize($_GET["corMangueira"]);
        $corMangueira = mysqli_real_escape_string($conn,$corMangueira);

        $materialMangueira = sanitize($_GET["materialMangueira"]);
        $materialMangueira = mysqli_real_escape_string($conn,$materialMangueira);

        $comprimentoMangueira = sanitize($_GET["comprimentoMangueira"]);
        $comprimentoMangueira = mysqli_real_escape_string($conn,$comprimentoMangueira);
        
        $precoMangueira = sanitize(($_GET["precoMangueira"]));
        $precoMangueira = mysqli_real_escape_string($conn,$precoMangueira);

        $quantidadeMangueira = sanitize(($_GET["quantidadeMangueira"]));
        $quantidadeMangueira = mysqli_real_escape_string($conn,$quantidadeMangueira);


          $sql = "UPDATE mangueira SET mangueira.marca='$marcaMangueira', mangueira.cor='$corMangueira', mangueira.material='$materialMangueira', mangueira.comprimento='$comprimentoMangueira', mangueira.preco='$precoMangueira', mangueira.quantidade='$quantidadeMangueira' where id_mangueira=$id";
          if(!mysqli_query($conn,$sql)){
            die("Problemas para atualizar Mangueira!<br>".
                 mysqli_error($conn));
          }else{
           $msg = "Mangueira alterada com sucesso!"; 
           header('Location: /tcc2/mangueira.php?msg='.$msg); 
          }

        }    
      }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Hookah Bar</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Customização CSS -->
    <link rel="stylesheet" href="styles.css">
    <!-- javascripts -->
    

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
</head>

<body>
  <div class="container-wrapper">    
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="pedidos.php">Hookah Bar</a>
        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Procurar..." aria-label="Procurar" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>

        <!-- Navbar -->
        <ul class="navbar-nav ml-auto ml-md-0">
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="#">Usuários</a>
              
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </li>
        </ul>
    </nav> <!-- FiM DO NAVBAR SUPERIOR -->


    <div id="wrapper">
      <div class="row">
      <div class="col-md-3" id="navloca">
         <nav id="sidebar">
            <!-- <div class="sidebar-header">
                <h3>Hookah Bar</h3>
            </div> -->

            <ul class="sidebar navbar-nav">
                <li>
                    <a href="pedidos.php">Pedidos</a>
                </li>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown">Produtos</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="carvao.php">Carvão</a>
                        </li>
                        <li>
                            <a href="aluminio.php">Alumínio</a>
                        </li>
                        <li>
                            <a href="Essencia.php">Essência</a>
                        </li>
                        <li>
                            <a href="rosh.php">Rosh</a>
                        </li>
                        <li>
                            <a href="steam.php">Steam</a>
                        </li>
                        <li>
                            <a href="mangueira.php">Mangueira</a>
                        </li>
                        <li>
                            <a href="vaso.php">Vaso</a>
                        </li>
                        <li>
                            <a href="bebida.php">Bebidas</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="mesas.php">Mesas</a>
                </li>
                <li>
                    <a href="funcionario.php">Funcionário</a>
                </li>
                <li>
                    <a href="relatorio.php">Relatório</a>
                </li>
            </ul>
        </nav>
      </div>    
        <!-- Início conteudo -->
      <div class="col-md-9" id="padding">  
        <div id="content-wrapper">      
          <div class="row">
            <div class="container-fluid">  
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="pedidos.php">Dashboard Pedido</a>
                  </li>
                  <li class="breadcrumb-item active">Produtos - Mangueira</li>
              </ol>
            </div>
          </div>   
          <div class="card">
                  <div class="card-header">
                    <!-- <i class="fas fa-table"></i> -->
                    <h3>Mangueira</h3>
                  </div>
               
                  <div class="card-body">
                      <form  method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
                        <div class="row">
                          <div  class="container-fluid">
                            <!-- <div class="card mb-3"> -->                    
                             <!-- <div class="card-header">
                                <h3>Pesquisar</h3>
                              </div> -->
                            <div class="row">
                              <div class="col-md-6">                  
                                <label for="exampleFormControlInput1">Marca</label>
                                <input type="text" class="form-control" id="marcaMangueira" name="marcaMangueira" value="<?php echo $mangueira["marca"] ?>">
                                <label for="exampleFormControlInput1">Cor</label>
                                <input type="text" class="form-control" id="corMangueira" name="corMangueira" value="<?php echo $mangueira["cor"] ?>">
                                <label for="exampleFormControlInput1">Material</label>
                                <input type="text" class="form-control" id="materialMangueira" name="materialMangueira" value="<?php echo $mangueira["material"] ?>">
                              </div>  
                              <div class="col-md-6 ">                                
                                <label for="exampleFormControlInput1">Comprimento</label>
                                <input type="number" class="form-control" step="0.01" min="0" id="comprimentoMangueira" name="comprimentoMangueira" value="<?php echo $mangueira["comprimento"] ?>">
                                <label for="exampleFormControlInput1">Quantidade</label>
                                <input type="number" class="form-control" id="quantidadeMangueira" step="0.5" min="0" name="quantidadeMangueira" value="<?php echo $mangueira["quantidade"] ?>">
                                <label for="exampleFormControlInput1">Preço</label>
                                <input type="number" class="form-control" id="precoMangueira" step="0.01" min="0" name="precoMangueira" value="<?php echo $mangueira["preco"] ?>">

                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $mangueira["id_mangueira"] ?>">
                                <br>  
                                <button class="btn btn-primary" type="submit" id="confirmar" class="floated" name="confirmar">Alterar</button>

                              </div>
                            </div>               
                          </div>
    

                        </div> <!-- div row form -->
                      </form>
                    </div> <!-- Card body -->
                  </div>  <!-- card -->
            </div>  <!--content-wrapper -->
          </div>   <!-- col-->

        </div> <!--row-->  
      </div> <!-- ID WRAPPER-->
    </div>    <!-- container-wrapper -->

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>