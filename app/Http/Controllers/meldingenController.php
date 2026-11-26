<?php

$action = $_POST['action'] ?? '';

if ($action == 'create') {
    //Variabelen vullen
    $attractie = $_POST['attractie'] ?? '';

    if (is_numeric($_POST['capaciteit'])) {
        $capaciteit = $_POST['capaciteit'];
    } else {
        $capaciteit = 0;
    }

    $melder = $_POST['melder'] ?? '';

    $allowed_types = [
        "achtbaan",
        "draaiend",
        "water",
        "overig"
    ];

    if (in_array($_POST['type'], $allowed_types, true)) {
        $type = $_POST['type'];
    } else {
        $type = "";
    }

    if ($_POST['prio']) {
        $prioriteit = 1;
    } else {
        $prioriteit = 0;
    }

    $overig = $_POST["overig"] ?? '';

    //1. Verbinding
    require_once '../../../config/conn.php';

    //2. Query
    $query = "

            INSERT INTO meldingen
                (melder, capaciteit, attractie, type, overige_info, prioriteit)
            VALUES
                (:melder, :capaciteit, :attractie, :type, :overig, :prio)
";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
        ":melder" => $melder,
        ":capaciteit" => $capaciteit,
        ":attractie" => $attractie,
        ":type" => $type,
        ":overig" => $overig,
        ":prio" => $prioriteit
    ]);

    header('Location:' . $base_url . '/resources/views/meldingen/index.php?msg=Je melding is opgeslagen');
    exit;
}

if ($action == 'edit') {
    //Variabelen vullen
    if (is_numeric($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        echo "Je hebt geen geldig id meegegeven";
        exit();
    }

    $attractie = $_POST['attractie'] ?? '';

    if (is_numeric($_POST['capaciteit'])) {
        $capaciteit = $_POST['capaciteit'];
    } else {
        $capaciteit = 0;
    }

    $melder = $_POST['melder'] ?? '';

    $allowed_types = [
        "achtbaan",
        "draaiend",
        "water",
        "overig"
    ];

    if (in_array($_POST['type'], $allowed_types, true)) {
        $type = $_POST['type'];
    } else {
        $type = "";
    }

    $overig = $_POST["overig"] ?? '';

    //1. Verbinding
    require_once '../../../config/conn.php';

    //2. Query
    $query = "

            UPDATE meldingen
            SET
                attractie = :attractie,
                capaciteit = :capaciteit,
                melder = :melder,
                overige_info = :overig,
                type = :type
            WHERE
                id = :id
    ";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
        ":melder" => $melder,
        ":capaciteit" => $capaciteit,
        ":attractie" => $attractie,
        ":overig" => $overig,
        ":id" => $id,
        ":type" => $type
    ]);

    header('Location:' . $base_url . '/resources/views/meldingen/index.php?msg=Je melding is bewerkt');
    exit;
}

if ($action == 'delete') {

    if (is_numeric($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        echo "Je hebt geen geldig id meegegeven";
        exit();
    }

    //1. Verbinding
    require_once '../../../config/conn.php';

    //2. Query
    $query = "

            DELETE FROM meldingen
            WHERE
                id = :id
    ";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
        ":id" => $id
    ]);

    header('Location:' . $base_url . '/resources/views/meldingen/index.php?msg=Je melding is verwijderd');
    exit;
}
