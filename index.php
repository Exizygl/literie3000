<?php
$dsn = "mysql:host=localhost;dbname=literie";
$db = new PDO($dsn, "root", "");

$query = $db->query("SELECT * FROM matelas");
$matelas = $query->fetchAll();

include("header.php") ?>
<div>
    <a href="addinfo.php">Ajout d'article</a>
</div>


<div>
    <?php
    foreach ($matelas as $item) {
    ?>
        <div>
            <div>
                <img src="img/<?= $item["picture"] ?>" alt="" srcset="" class="">
            </div>
            <div>
                <?=$item["name"]?>
                <?=$item["marque"]?>
                <?=$item["dimension"]?>
            </div>
            <div>
                <?=$item["prix"]?>
                <?=$item["reduction"]?>
            </div>
            <div>
                <a href="addinfo.php?id=<?= $item["id"] ?>">modifier</a>
                <a href="delete.php?id=<?= $item["id"] ?>">supprimer</a>
            </div>
        </div>

    <?php
    }
    ?>
</div>
</body>

</html>