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

    ?>

<?php require_once __DIR__ . '/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Bewerken</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <h1>Bewerk melding</h1>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <input type="text" name="attractie" id="attractie" class="form-input" value="<?php echo $melding['attractie'];?>">
            </div>
            <!-- <div class="form-group">
                <label for="type">Type</label>
                <select id="type" name="type" required>
                    <option value="">-- kies een type --</option>
                    <option value="achtbaan">Achtbaan</option>
                    <option value="draaiend">Draaiende attractie</option>
                    <option value="water">Waterattractie</option>
                    <option value="overig">Overig</option>
                </select>
            </div> -->
            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input" value="<?php echo $melding['capaciteit'];?>">
            </div>
            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input" value="<?php echo $melding['melder'];?>">
            </div>

            <div class="form-group">
                <label for="prio">Prioriteit</label>
                <input type="checkbox" name="prio" id="prio" class="form-input" <?php if($melding['prioriteit'] == 1) { echo "checked";}?>>
            </div>

            <div class="form-group">
                <label for="overig">Overige info:</label>
                <textarea name="overig" rows="4"><?php echo $melding['overige_info'];?></textarea>
            </div>

            <input type="submit" value="Verstuur melding">

        </form>
    </div>

</body>

</html>

    <?php

} else {
    echo "id is geen getal";
}
