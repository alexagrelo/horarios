<?php

$array_inputs = array('subject' => 'Lengua', 'teacher' => 'David', 'weeklyHours' => 5);

//Creo el JSON
$json = json_encode($array_inputs);
$file = 'horarios.json';
file_put_contents($file, $json);

?>