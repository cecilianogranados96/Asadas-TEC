var wrapper = document.getElementById("signature-pad");
var clearButton = wrapper.querySelector("[data-action=clear]");
var savePNGButton = wrapper.querySelector("[data-action=save-png]");

var canvas = wrapper.querySelector("canvas");
var signaturePad = new SignaturePad(canvas, {
  backgroundColor: 'rgb(255, 255, 255)'
});

function resizeCanvas() {
  var ratio =  Math.max(window.devicePixelRatio || 1, 1);
  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);
  //signaturePad.clear();
}

//window.onresize = resizeCanvas;
resizeCanvas();


clearButton.addEventListener("click", function (event) {
  signaturePad.clear();
});



savePNGButton.addEventListener("click", function (event) {

        var dataURL = signaturePad.toDataURL();
        var id = $("#id").val();
        var img_data = {
            'cnvimg': dataURL,
            'id': id
        };
        ajaxSend(img_data, 'image.php', 'post', function(resp) {
            console.log(resp);
            alert("Guardado con exito!");
            
            window.location.href = "orden_firma.php?id="+ id;
        });
    
  
});

function escribir(){
   var ctx = canvas.getContext("2d");
   ctx.font = "bold 15px sans-serif";
   ctx.fillText($("#nombre").val(),30,30);
   ctx.fillText($("#cedula").val(),30,50);
}


function ajaxSend(data, php, via, callback) {
    var ob_ajax = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP'); //XMLHttpRequest object
    var str_data = '';
    for (var k in data) {
        str_data += k + '=' + data[k].replace(/\?/g, '?').replace(/=/g, '=').replace(/&/g, '&').replace(/[ ]+/g, ' ') + '&'
    }
    str_data = str_data.replace(/&$/, ''); //delete ending &
    ob_ajax.open(via, php, true);
    if (via == 'post') ob_ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ob_ajax.send(str_data);
    ob_ajax.onreadystatechange = function() {
        if (ob_ajax.readyState == 4) callback(ob_ajax.responseText);
    }
}



