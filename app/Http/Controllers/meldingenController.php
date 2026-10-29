<?php

//Variabelen vullen
$attractie = $_POST['attractie'] ?? '';

if(is_numeric($_POST['capaciteit'])){
    $capaciteit = $_POST['capaciteit'];
}
else {
    $capaciteit = 0;
}

$melder = $_POST['melder'] ?? '';

$allowed_types = [
    "achtbaan",
    "draaiend",
    "water",
    "overig"
];

if(in_array($_POST['type'],$allowed_types, true)) {
    $type = $_POST['type'];
}
else {
    $type = "";
}

$overig = $_POST["overig"] ?? '';

//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query = "

            INSERT INTO meldingen
                (melder, capaciteit, attractie, type, overige_info)
            VALUES
                (:melder, :capaciteit, :attractie, :type, :overig)
";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ":melder" => $melder,
    ":capaciteit" => $capaciteit,
    ":attractie" => $attractie,
    ":type" => $type,
    ":overig" => $overig
]);

header('Location:'. $base_url .'/resources/views/meldingen/index.php?msg=Je melding is opgeslagen');
exit;