<?php require_once __DIR__ . '/../../../config/config.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <div style="background: #ededed; display: flex; justify-content: center; align-items: center; color: #666666;">
            <?php

            //1. Verbinding
            require_once '../../../config/conn.php';

            //2. Query
            $query = "SELECT * FROM meldingen";

            //3. Prepare
            $statement = $conn->prepare($query);

            //4. Execute
            $statement->execute([]);

            //5. Fetchall
            $meldingen = $statement->fetchAll();

            if(count($meldingen) > 0) {

            ?>

            <table>
                <thead>
                    <tr>
                        <th>Attractienaam</th>
                        <th>Type</th>
                        <th>Capaciteit</th>
                        <th>Prioriteit</th>
                        <th>Melder</th>
                        <th>Gemeld op</th>
                        <th>Overige info</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($meldingen as $melding) {
                        
                        echo "<tr>";
                        
                        echo "<td>
                                <a href='edit.php?id=".$melding['id']."'>"
                                .$melding['attractie'].
                                "</a>
                            </td>";
                        echo "<td>".$melding['type']."</td>";
                        echo "<td>".$melding['capaciteit']."</td>";
                        echo "<td>".$melding['prioriteit']."</td>";
                        echo "<td>".$melding['melder']."</td>";
                        echo "<td>".date("d-m-Y H:i:s",strtotime($melding['gemeld_op']))."</td>";
                        echo "<td>".$melding['overige_info']."</td>";
                        echo "</tr>";
                        
                    }
                    ?>
                </tbody>
            </table>

            <?php
            } else {
                echo "Er zijn geen meldingen.";
            }
            ?>

        </div>
    </div>

</body>

</html>