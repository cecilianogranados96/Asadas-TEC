function llenarCantones(){

    var provincia = $('#provincia').find(":selected").text();
    var items="";

    $.post("../php/getCantones.php",{provincia1: provincia}, function(data) {
 
          var cantones = JSON.parse(data);
items+="<option value='0' disabled selected>Cantón</option>";
        $.each(cantones,function(index,item) 
        {
          items+="<option value='"+item.idCanton+"'>"+item.nombre+"</option>";
        });
        
        $("#canton").html(items); 
      });
}

function llenarDistritos(){

    var canton = $('#canton').find(":selected").text();
    var items="";

    $.post("../php/getDistritos.php",{canton1: canton}, function(data) {
  
          
          var distritos = JSON.parse(data);
items+="<option value='0' disabled selected>Distrito</option>";
        $.each(distritos,function(index,item) 
        {
          items+="<option value='"+item.idDistrito+"'>"+item.nombre+"</option>";
        });
        
        $("#distrito").html(items); 
      });
}