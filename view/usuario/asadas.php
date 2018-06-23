<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <center><h1>Nuestros Usuarios</h1></center>
                     <?php 
                        $sth = mysqli_query($link,"SELECT  nombre, logo FROM asada");
                        while($r = mysqli_fetch_assoc($sth)) {
                            echo '<img src="'.$r['logo'].'">'.$r['nombre'].'<br>';
                        }
                        ?>
    </div>
</div>
			