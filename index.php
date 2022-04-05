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
        <div class="containerMatela">
            <div class="imageMatela">
                <img src="img/<?= $item["picture"] ?>" alt="" srcset="" class="">
            </div>
            <div class="information">
                <div class="name">
                    <?= $item["name"] ?>
                </div>
                <div class="marque">
                    <?= $item["marque"] ?>
                </div>
                <div class="dimension">
                    <?= $item["dimension"] ?>
                </div>
            </div>
            <div class="prix">

                <?php
                if ($item["reduction"] === "") {


                ?>
                    <div class="prixNormal">
                        <?= $item["prix"] ?>
                    </div>
                <?php
                } else {
                ?>
                    <div class="prixBarrer">
                        <?= $item["prix"] ?>
                    </div>
                    <div class="reduction">
                        <?= $item["reduction"] ?>
                    </div>

                <?php
                }
                ?>
            </div>
            <div class="btn">
                <div class="mod">
                    <a href="addinfo.php?id=<?= $item["id"] ?>">modifier</a>
                </div>
                <div class="suppr">
                    <a href="delete.php?id=<?= $item["id"] ?>">supprimer</a>
                </div>
            </div>
        </div>

    <?php
    }
    ?>
</div>
</body>

</html>