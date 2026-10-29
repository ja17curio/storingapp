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

//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query = "

            INSERT INTO meldingen
                (melder, capaciteit, attractie, type)
            VALUES
                (:melder, :capaciteit, :attractie, :type)
";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ":melder" => $melder,
    ":capaciteit" => $capaciteit,
    ":attractie" => $attractie,
    ":type" => ''
]);

header('Location:'. $base_url .'/resources/views/meldingen/index.php?msg=Je melding is opgeslagen');
exit;