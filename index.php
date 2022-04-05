<?php
$dsn = "mysql:host=localhost;dbname=literie";
$db = new PDO($dsn, "root", "");

$query = $db->query("SELECT * FROM matelas");
$matelas = $query->fetchAll();

include("header.php") ?>
<div class="add">
    <a href="addinfo.php">Ajout d'article</a>
</div>


<div>
    <?php
    if(!isset($_GET["page"])){
        $page=1;
    }else{
        $page=$_GET["page"];
    };

    $d = (($page - 1) * 5) + 1;
    $f = $page * 5;

    for ($i = $d; $i <= $f; $i++) {
        if (isset($matelas[$i])) {
            $item = $matelas[$i];


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
                            <?= $item["prix"] ?>€
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="prixBarrer">
                            <?= $item["prix"] ?>€
                        </div>
                        <div class="reduction">
                            <?= $item["reduction"] ?>€
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
    }
    ?>
</div>
<div class="pagination">
    <?php
    $nb_row = count($matelas) - 1;
    if (count($matelas) > 5) {
        $nb_page = intdiv($nb_row, 5);
        $reste = $nb_row % 5;
        for ($i = 1; $i <= $nb_page; $i++) {


    ?>

            <a class="link" href='index.php?page=<?=$i?>'><?= $i ?></a>


        <?php }
    }
    if ($reste > 0) { ?>
        <a class="link" href='index.php?page=<?=$nb_page + 1?>'><?= $nb_page + 1 ?></a>
    <?php } ?>
</div>
</body>

</html>