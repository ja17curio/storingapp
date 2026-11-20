<?php

$id = $_GET['id'] ?? null;

if (is_numeric($id)) {

    //1. Verbinding
    require_once '../../../config/conn.php';

    //2. Query
    $query = "SELECT * FROM meldingen WHERE id = :id";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
        ":id" => $id
    ]);

    //5. Fetchall
    $melding = $statement->fetch();

    echo "<pre>";
    print_r($melding);
    echo "</pre>";

} else {
    echo "id is geen getal";
}
