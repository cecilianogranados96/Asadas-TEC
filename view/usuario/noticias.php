<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
#myCarousel .carousel-caption {
    left:0;
	right:0;
	bottom:0;
	text-align:left;
	padding:10px;
	background:rgba(0,0,0,0.6);
	text-shadow:none;
}

#myCarousel .list-group {
	position:absolute;
	top:0;
	right:0;
}
#myCarousel .list-group-item {
	border-radius:0px;
	cursor:pointer;
}
#myCarousel .list-group .active {
	background-color:#eee;	
}

@media (min-width: 992px) { 
	#myCarousel {padding-right:33.3333%;}
	#myCarousel .carousel-controls {display:none;} 	
}
@media (max-width: 991px) { 
	.carousel-caption p,
	#myCarousel .list-group {display:none;} 
}
</style>
<div class="page-404 padding ptb-xs-40">
    <div class="container">
        
        <center><h1>Noticias destacadas</h1></center>
        <br><br>


<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <?php 
            $sth = mysqli_query($link,"SELECT * FROM noticia where noticia.id_asada = '".$_SESSION["asada"]."' ORDER BY fechaPublicacion DESC ");
            $activo  = "active";
            while($r = mysqli_fetch_assoc($sth)) {
                echo '
                    <div class="item '.$activo.'">
                      <img src="'.$r['imagen'].'">
                       <div class="carousel-caption">
                        <h4><a href="#">'.$r['titulo'].'</a></h4>
                        <p>'.$r['contenido'].' - Fecha de publicación: '.$r['fechaPublicacion'].'</p>
                      </div>
                    </div>';
                $activo  = "";
            }
        ?>                
      </div>


    <ul class="list-group col-sm-4">
        <?php 
            $sth = mysqli_query($link,"SELECT * FROM noticia where noticia.id_asada = '".$_SESSION["asada"]."' ORDER BY fechaPublicacion DESC ");
            $activo  = "active";
            $x = 0 ;
            while($r = mysqli_fetch_assoc($sth)) {
                echo '<li data-target="#myCarousel" data-slide-to="'.$x.'" class="list-group-item '.$activo.'"><h4>'.$r['titulo'].'</h4></li>';
                $activo  = "";
                $x++;
            }
        ?>
    </ul>
      <div class="carousel-controls">
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
      </div>
    </div>
</div>    
    </div>
</div>

<script>
    $(document).ready(function(){
    
	var clickEvent = false;
	$('#myCarousel').carousel({
		interval:   4000	
	}).on('click', '.list-group li', function() {
			clickEvent = true;
			$('.list-group li').removeClass('active');
			$(this).addClass('active');		
	}).on('slid.bs.carousel', function(e) {
		if(!clickEvent) {
			var count = $('.list-group').children().length -1;
			var current = $('.list-group li.active');
			current.removeClass('active').next().addClass('active');
			var id = parseInt(current.data('slide-to'));
			if(count == id) {
				$('.list-group li').first().addClass('active');	
			}
		}
		clickEvent = false;
	});
})

$(window).load(function() {
    var boxheight = $('#myCarousel .carousel-inner').innerHeight();
    var itemlength = $('#myCarousel .item').length;
    var triggerheight = Math.round(boxheight/itemlength+1);
	$('#myCarousel .list-group-item').outerHeight(triggerheight);
});
    </script>