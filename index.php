<?php
$dsn = "mysql:host=localhost;dbname=literie";
$db = new PDO($dsn, "root", "");

$query = $db->query("SELECT * FROM matelas");
$matelas = $query->fetchAll();

include("header.php") ?>
<div>
    <a href="add.php">Ajout d'article</a>
</div>


<div>
    <?php
    foreach ($matelas as $item) {
    ?>
        <div>
            <div>
                <img src="<?= $item["picture"] ?>" alt="" srcset="" class="">
            </div>
            <div>
                <?=$item["name"]?>
                <?=$item["marque"]?>
                <?=$item["taille"]?>
            </div>
        </div>

    <?php
    }
    ?>
</div>
</body>

</html>