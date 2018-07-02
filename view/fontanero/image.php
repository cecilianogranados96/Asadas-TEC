<?php
include '../../config.php';


$cnvimg = trim(strip_tags($_POST['cnvimg']));
$cnvimg = str_replace('data:image/png;base64,', '', $cnvimg);
$cnvimg = str_replace(' ', '+', $cnvimg);
$data = base64_decode($cnvimg);
$success = file_put_contents("../../".$_POST['id'], $data);

    echo "UPDATE `ordenes_trabajo` SET `estado`= '3' WHERE `id_formulario`= '".$_POST['formulario']."'";
mysqli_query($link,"UPDATE `ordenes_trabajo` SET `estado`= '3' WHERE `id_formulario`= '".$_POST['formulario']."'");

echo "Exito";