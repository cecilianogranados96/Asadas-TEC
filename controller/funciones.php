<?php

class Thumbnail {
        private $thumbnail;
        private $thumbnail_width;
        private $thumbnail_height;
        private $image;
        private $image_width;
        private $image_height;
        private $image_type;
        public $error;
        public function __construct($source) {
            $image_info = getimagesize($source);
            if($image_info) {
                $this->image_width = $image_info[0];
                $this->image_height = $image_info[1];
                $this->image_type = $image_info[2];
                switch($this->image_type) {
                    case IMAGETYPE_JPEG: {
                        $this->image = imagecreatefromjpeg($source);
                        break;
                    }
                    case IMAGETYPE_GIF: {
                        $this->image = imagecreatefromgif($source);
                        break;
                    }
                    case IMAGETYPE_PNG: {
                        $this->image = imagecreatefrompng($source);
                        break;
                    }
                    default: {
                        $this->error = "Formato no soportado";
                        break;
                    }
                }
            } 
            else {
                $this->error = "Formato invalido";
            }
        }    
        public function resize($width, $height = 0) {
            $this->thumbnail_width = $width;
            if($height == 0) {
                $this->thumbnail_height = $width;
            } else {
                $this->thumbnail_height = $height;
            }
            $this->thumbnail = imagecreatetruecolor($this->thumbnail_width, $this->thumbnail_height);
            imagecopyresampled(
                $this->thumbnail, $this->image, 0, 0, 0, 0,
                $this->thumbnail_width, $this->thumbnail_height,
                $this->image_width, $this->image_height
            );
        }
        public function save_png($dir, $name) {
            $path = $dir . $name . image_type_to_extension(IMAGETYPE_PNG);
            imagegif($this->thumbnail, $path);
            imagedestroy($this->thumbnail);
        }
}

function enviar_email($para,$asunto,$texto,$url,$texto_boton){
    $mensaje = '
    <html>
    <head>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        </head>
    <body>
        <table class="full-width-container" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" bgcolor="#eeeeee" style="width: 100%; height: 100%; padding: 30px 0 30px 0;">
            <tr>
                <td align="center" valign="top">
                    <table class="container" border="0" cellpadding="0" cellspacing="0" width="700" bgcolor="#ffffff" style="width: 700px;">
                        <tr>
                            <td align="center" valign="top">
                                <table class="container header" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
                                    <tr>
                                        <td style="padding: 30px 0 30px 0; border-bottom: solid 1px #eeeeee;" align="left"><center>
                                            <a href="https://asadastec.tk/" style="font-size: 30px; text-decoration: none; color: #000000;"  target="_blanck">
                                                <img src="https://asadastec.tk/assets/images/logo.png" style="    width: 40%;">
                                            </a>
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                                <table class="container hero-subheader" border="0" cellpadding="0" cellspacing="0" width="620" style="width: 620px;">
                                    <tr>
                                        <td class="hero-subheader__title" style="font-size: 43px; font-weight: bold; padding: 20px 0 15px 0;" align="left">Olvido su contraseña</td>
                                    </tr>
                                    <tr>
                                        <td class="hero-subheader__content" style="font-size: 16px; line-height: 27px; color: #969696; padding: 0 60px 40px 0;" align="left">
                                            '.$texto.'
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <table class="container" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td class="cta-block__button" width="260" align="center" style="width: 200px;">
                                                        <a href="'.$url.'" style="    border: 3px solid #eeee;color: #ffff;background-color: #167cab;text-decoration: none;padding: 15px 45px;text-transform: uppercase;display: block;text-align: center;font-size: 15px;" target="_blanck">'.$texto_boton.'</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!-- / Divider -->
                                <table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-top: 25px;" align="center">
                                    <tr>
                                        <td align="center">
                                            <table class="container" border="0" cellpadding="0" cellspacing="0" width="620" align="center" style="border-bottom: solid 1px #eeeeee; width: 620px;">
                                                <tr>
                                                    <td align="center"> </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <!-- /// Divider -->
                                <table class="container info-bullets" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
                                    <tr>
                                        <td align="center">
                                            <table class="container" border="0" cellpadding="0" cellspacing="0" width="620" align="center" style="width: 620px;">
                                                <tr>
                                                    <td class="info-bullets__block" style="padding: 30px 30px 15px 30px;" align="center">
                                                        <table class="container" border="0" cellpadding="0" cellspacing="0" align="center">
                                                            <tr>
                                                                <td class="info-bullets__content" style="color: #969696; font-size: 16px;">info@radar.pet</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td class="info-bullets__block" style="padding: 30px;" align="center">
                                                        <table class="container" border="0" cellpadding="0" cellspacing="0" align="center">
                                                            <tr>
                                                            
                                                                <td class="info-bullets__content" style="color: #969696; font-size: 16px;">San José, Costa Rica</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
                                    <tr>
                                        <td align="center">
                                            <table class="container" border="0" cellpadding="0" cellspacing="0" width="620" align="center" style="border-top: 1px solid #eeeeee; width: 620px;">
                                                <tr>
                                                    <td style="color: #d5d5d5; text-align: center; font-size: 15px; padding: 10px 0 60px 0; line-height: 22px;">© Copyright 2018 - Asadas Costa Rica - Todos los derechos reservados</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>';

    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html;utf-8' . "\r\n";
    $cabeceras .= 'To: '.$para. "\r\n";
    $cabeceras .= 'From: Asadas <noreplay@radar.pet>' . "\r\n";
    //mail($para, $asunto, $mensaje, $cabeceras);
    return $mensaje;
}



function encriptar($texto,$key){
    return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $texto, MCRYPT_MODE_CBC, md5(md5($key))));
};



function desencriptar($texto,$key){
    return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($texto), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
}



function ver($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

    
?>