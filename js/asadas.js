$(document).ready(function(){
  var table = document.getElementById("asadas");
    
    /*
  $.getJSON("../php/asadas.php",function(data){
    $.each(data,function(index,item) 
    {
        //alert("hey");
        //alert(item.nombre);
        table.innerHTML += "<div class='hvrbox'> <img src=" + item.logo + " class='hvrbox-layer_bottom'> <div class='hvrbox-layer_top'> <div class='hvrbox-text'>" + item.nombre + "</div> </div> </div>";
        //table2.innerHTML += "<div><a>"+item.nombre+"</a></div>";

    });
  });
    */      
      
    $.ajax({
    url : "../php/general_functions.php", // the resource where youre request will go throw
    type : "POST", // HTTP verb
    data : { action: 'asadas' },
    dataType: "json",
    success: function(data){
        $.each(data,function(index,item) 
            {
                table.innerHTML += "<div class='hvrbox'> <img src=" + item.logo + " class='hvrbox-layer_bottom'> <div class='hvrbox-layer_top'> <div class='hvrbox-text'>" + item.nombre + "</div> </div> </div>";
            });
    },
        error: function (data){
            console.log(data.responseText);
            alert("Ha ocurrido un error.");
        }
    });
});