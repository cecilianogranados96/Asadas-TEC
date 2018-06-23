<?php 

session_start();

$array = array(
    1 => array(
        "nombre" => "Select",
        "tipo" => 2,
        "campo" => "nombre",
        "opciones" => array(
             "Habitacion","Casa","Otro"
         )
    )
);



$array2 = array(    
    2 => array(
        "nombre" => "Input",
        "tipo" => 1,
        "campo" => "nombre1"
    )
);

$array = array_merge ( $array, $array2 );
        
echo "<pre>";
print_r($array);
echo "</pre><br><br>";
echo "All: ",     json_encode($array), "<br><br>";
$json = json_encode($array);
echo "<pre>";
print_r(json_decode($json,true));
echo "</pre><br><br>";
$array = json_decode($json,true);



print_r($_POST);

echo "<pre>";
print_r($_POST);
echo "</pre><br><br>";
echo "All: ",     json_encode($_POST), "<br><br>";
$json = json_encode($_POST);
echo "<pre>";
print_r(json_decode($json,true));
echo "</pre><br><br>";




echo "<form action='' method='post'>";
$identificador = 0;
foreach ($array as $i => $value) {
    $identificador ++;
    if ($array[$i]["tipo"] == 1){
        echo $array[$i]["nombre"]."<input type='text' name='".$identificador."'  value='".$array[$i]["campo"]."'>";
    }else{
        echo $array[$i]["nombre"]."<select  name='".$identificador."'>";
        
        foreach ($array[$i]["opciones"] as $valor) {
                echo "<option value='$valor'>$valor</option>";
        }   
        echo "</select>";
        
    }
    echo "<br>";    
}
echo "<input type='submit' value='ENVIAR'></input></form>";

?>
