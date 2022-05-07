<?php

// Lee el archivo JSON
$data = file_get_contents('horarios.json');
$json = json_decode($data, true);

foreach ($json as $session) {
    echo $session . '<br>';
}

?>