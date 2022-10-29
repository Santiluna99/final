<?php
function config_read($config_file) {
    return parse_ini_file($config_file, true);
}
function config_set(&$config_data, $section, $key, $value) {
    $config_data[$section][$key] = $value;
}
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
function config_set_file($config_file, $section, $key, $value) {
    $config_data = config_read($config_file);
    config_set($config_data, $section, $key, $value);
    config_write($config_file, $section, $key, $value);
}
$filepath='publicaciones.ini';

$publicacion = parse_ini_file($filepath, true);    
session_start();
?>