<?php
function config_read($config_file) {
    return parse_ini_file($config_file, true);
}
// Actualiza una nueva configuración en datos de archivo inicial cargados
function config_set(&$config_data, $section, $key, $value) {
    $config_data[$section][$key] = $value;
}

// Organiza los datos de configuración del archivo ini de nuevo en el disco.
function config_write($config_data, $config_file) {
    $new_content = '';
    foreach ($config_data as $section => $section_content) {
        $section_content = array_map(function($value, $key) {
            return "$key=$value";
        }, array_values($section_content), array_keys($section_content));
        $section_content = implode("\n", $section_content);
        $new_content .= "[$section]\n$section_content\n";
    }
    file_put_contents($config_file, $new_content);
}

// Función abreviada para actualizar un único valor de configuración en un archivo.
function config_set_file($config_file, $section, $key, $value) {
    $config_data = config_read($config_file);
    config_set($config_data, $section, $key, $value);
    config_write($config_file, $section, $key, $value);
}

$config_file = "publicaciones.ini";


$archivo= ($_FILES['archivo']);
$nombre = $_POST['nombre'];


if (!file_exists(''.$nombre.'/')) {
    mkdir('/images/'.$nombre.'/', 0777, true);
}

$direccion="/images/$nombre/";
$titulofinal= trim ($_FILES['archivo']['name']);

$archivo=($_FILES['archivo']['name']); // aca traigo el archivo a subir
$archivopeso=($_FILES['archivo']['size']);


$extensionespermitidas = array('jpg','jpeg','png', 'PNG','gif');//aca dejo las extensiones permitidas
$separa = explode(".",$_FILES['archivo']['name']);//aca con explode lo que hago es separar la img despues del punto
$extensionimg=end($separa);//aca tomo el .img y lo guardo en una extension valida

if ((($_FILES["archivo"]["type"] == "image/jpg")
   || ($_FILES["archivo"]["type"] == "image/jpeg")
   || ($_FILES["archivo"]["type"] == "image/png")
   || ($_FILES["archivo"]["type"] == "image/PNG")
   || ($_FILES["archivo"]["type"] == "image/gif"))
   && in_array($extensionimg, $extensionespermitidas)) {
       
       if ($_FILES["archivo"]["error"] > 0) {
           echo "error";
        }
    }
    
    // if(move_uploaded_file($_FILES['archivo']['tmp_name'], $subido)) { 
        
    //     //aca muevo el archivo a la ubicacion que quiero que vaya
        
    // }
    $config_data = config_read("publicaciones.ini");
    config_set($config_data, "$nombre", "nombre", $nombre);
    config_set($config_data, "$nombre", "archivo", $archivo);
    
    config_write($config_data, $config_file);
    
    $publicacion = parse_ini_file($config_file, true);   

echo "<br>";
echo "<div align='center'><h3>Exito la publicacion $nombre, se ha subido correctamente!</h3>";
echo "<br>";
echo "<a href='indexlog.php'>Ver posts publicados</div></div>";
?>