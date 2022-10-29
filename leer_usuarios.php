<?php 
    //put the file path here
    $filepath='informacion.ini';
    //parse the ini file using default parse_ini_file() PHP function
    $parsed_ini = parse_ini_file($filepath, true);
    //read the array and print
    foreach($parsed_ini as $section=>$values){
        echo "<h3>$section</h3>";
        foreach($values as $key=>$value){
            echo $key."=".$value."<br>";
        }
        echo "<br>";
    }
?>