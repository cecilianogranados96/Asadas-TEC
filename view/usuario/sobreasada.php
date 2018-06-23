<?php  
            $sth = mysqli_query($link,"SELECT nombre, mision, vision, historia, logo FROM asada WHERE id_asada =  ".$_SESSION["asada"]." ");
            $r = mysqli_fetch_assoc($sth);
        ?>

<div id="about-section" class="padding ptb-xs-40">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="heading-box pb-30">
                    <center>
                        <h2><span>Nosotros</span></h2>
                    </center>

                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-12">
                <center>
                    <img class="img-responsive" src="<?php echo $r['logo']; ?>"  width="50%" alt="Photo">
                </center>
            </div>


            <div class="col-sm-6 pb-xs-30">
                <h4>Misión</h4>
                <ul class="list">
                    <li>
                        <?php echo $r['mision']; ?>
                    </li>
                </ul>

            </div>
            <div class="col-sm-6">
                <h4>Visión</h4>
                <ul class="list">
                    <li>
                        <?php echo $r['vision']; ?>
                    </li>
                </ul>
            </div>


            <div class="col-sm-12">
                <h4>Historia</h4>
                <ul class="list">
                    <li>
                        <?php echo $r['historia']; ?>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</div>
