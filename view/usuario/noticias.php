<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
    @import url(https://fonts.googleapis.com/css?family=Raleway:400,900,700,600,500,300,200,100,800);

    h2 {
        color: #4C4C4C;
        word-spacing: 5px;
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 30px;
        font-family: 'Raleway', sans-serif;
    }

    .blog span {
        font-size: 17px;
        font-weight: 700;
    }

    .blog .blog-detail {
        margin-top: 10px;
    }

    .fa.fa-user,
    .fa.fa-clock-o {
        padding-right: 10px;
        color: #909090;
        font-size: 11px;
    }

</style>
<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <div class="blog">
            <div class="container">
                <?php if(!isset($_GET['noticia'])){ ?>

                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 text-center">
                        <h2><span class="ion-minus"></span>Noticias Destacadas<span class="ion-minus"></span></h2>
                    </div>
                </div>
                <div class="row">
                    <table class="tabla">
                        <tr>
                            <td>
                                <?php 
                    $consulta = "SELECT * FROM noticia where id_asada = '".$_SESSION["asada"]."' ORDER by fecha DESC ";
                    
                    $sth = mysqli_query($link,$consulta);
    
                    if (!isset($_GET["pagina"])) {
                        $inicio = 0;
                        $pagina = 1;
                    } else {
                        $inicio = ($_GET["pagina"] - 1) * $TAMANO_PAGINA;
                        $pagina = $_GET["pagina"];
                    }
                    $url= "?pag=".$_GET['pag']."";
                    $total_paginas = ceil(mysqli_num_rows($sth) / $TAMANO_PAGINA);
                    $consulta .=  " LIMIT ".$inicio."," . $TAMANO_PAGINA;
                    $sth = mysqli_query($link,$consulta);
    
    
    
                    while($r = mysqli_fetch_assoc($sth)) {
                    echo '
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" data-aos="fade-right" style="margin-top: 4%;width: 50%;height: 180px;">
                                <div class="col-lg-6 col-xs-12">
                                    <img src="'.$r['imagen'].'" alt="" width="100%">
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                     <div class="blog-column">
                                        <span>'.$r['titulo'].'</span>
                                         <ul class="blog-detail list-inline"> 

                                            <li><i class="fa fa-clock-o"></i>'.$r['fecha'].'</li> 
                                        </ul> 
                                        <p>'.substr($r['contenido'], 0, 100).'</p>
                                        <a href="?pag=usuario/noticias&noticia='.$r['id_noticia'].'" class="btn btn-success">Leer más</a>
                                    </div>
                                </div>
                            </div>';
                    }
                    ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center>
                                    <ul class="pagination">
                                        <?php 
                if ($total_paginas > 1) {
                    if ($pagina != 1)
                      echo ' <li><a href="'.$url.'&pagina='.($pagina-1).'">«</a></li>';
                      for ($i=1;$i<=$total_paginas;$i++) {
                         if ($pagina == $i)
                          echo "<li class='active'><a href='".$url."&pagina=".$pagina."'>$pagina<span class='sr-only'>(current)</span></a></li>";
                         else
                            echo ' <li><a href="'.$url.'&pagina='.$i.'">'.$i.'</a></li>';
                      }
                      if ($pagina != $total_paginas)
                         echo '<li><a href="'.$url.'&pagina='.($pagina+1).'">»</a></li>';
                    }
                ?>
                                    </ul>
                                </center>
                            </td>
                        </tr>
                    </table>


                </div>
                <?php } else { ?>
                <div class="row">
                    <?php 
                    $sth = mysqli_query($link,"SELECT * FROM noticia where id_noticia = '".$_GET['noticia']."'");
                    while($r = mysqli_fetch_assoc($sth)) {
                        echo '
                            <div class="row">
                                 <div class="col-lg-6 col-lg-offset-3 text-center">  
                                    <h2><span class="ion-minus"></span>'.$r['titulo'].'<span class="ion-minus"></span></h2>
                                 </div> 
                            </div>  
                            <center>
                                <img src="'.$r['imagen'].'" alt="" width="70%"> 
                             </center>
                            <br><br>                     
                             <i class="fa fa-clock-o"></i>'.$r['fecha'].'<br><br>
                             '.$r['contenido'].'';
                    }
                    ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
