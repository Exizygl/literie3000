<?php
if (isset($_GET["id"])) {
    $dsn = "mysql:host=localhost;dbname=literie";
    $db = new PDO($dsn, "root", "");

    $query = $db->prepare("SELECT * FROM matelas WHERE id = :id");
    $query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
    $query->execute();
    $item = $query->fetch();



    $name = $item["name"];
    $id = $item["id"];
    $prix = $item["prix"];
    $reduction = $item["reduction"];
    $marque = $item["marque"];
    $dimension = $item["dimension"];
}

if (!empty($_POST)) {
    if (isset($_POST["id"])) {
        $id = trim(strip_tags($_POST["id"]));
        $name = trim(strip_tags($_POST["name"]));
        $prix = trim(strip_tags($_POST["prix"]));
        $reduction = trim(strip_tags($_POST["prixReduction"]));
        $marque = $_POST["marque"];
        $dimension = $_POST["taille"];

        $errors = [];
        if (empty($name)) {
            $errors["name"] = "Le nom est obligatoire!";
        }

        if (empty($prix)) {
            $errors["prix"] = "Le prix est obligatoire!";
        }

        if (empty($errors)) {
            $dsn = "mysql:host=localhost;dbname=literie";
            $db = new PDO($dsn, "root", "");

            if (empty($_FILES["picture"]["name"])) {



                $query = $db->prepare("UPDATE matelas SET
        name = :name, marque = :marque, dimension = :dimension, prix = :prix, reduction = :reduction  WHERE id LIKE :id");

                //associe variable à chaque requete
                $query->bindParam(":id", $id);
                $query->bindParam(":name", $name);
                $query->bindParam(":marque", $marque);
                $query->bindParam(":dimension", $dimension);
                $query->bindParam(":prix", $prix);
                $query->bindParam(":reduction", $reduction);

                if ($query->execute()) {
                    header("Location: index.php");
                }
            } else {
                $picture = $_FILES["picture"]["name"];
                $query = $db->prepare("UPDATE matelas SET
                name = :name, marque = :marque, dimension = :dimension, picture = :picture, prix = :prix, reduction = :reduction  WHERE id LIKE :id");

                //associe variable à chaque requete
                $query->bindParam(":id", $id);
                $query->bindParam(":name", $name);
                $query->bindParam(":marque", $marque);
                $query->bindParam(":dimension", $dimension);
                $query->bindParam(":picture", $picture);
                $query->bindParam(":prix", $prix);
                $query->bindParam(":reduction", $reduction);

                if ($query->execute()) {
                    header("Location: index.php");
                }
            }
        }
    } else {

        $name = trim(strip_tags($_POST["name"]));
        $picture = $_FILES["picture"]["name"];
        $prix = trim(strip_tags($_POST["prix"]));
        $reduction = trim(strip_tags($_POST["prixReduction"]));
        $marque = $_POST["marque"];
        $dimension = $_POST["taille"];



        $errors = [];
        if (empty($name)) {
            $errors["name"] = "Le nom est obligatoire!";
        }

        if (empty($picture)) {
            $errors["picture"] = "La photo est obligatoire!";
        }

        if (empty($prix)) {
            $errors["prix"] = "Le prix est obligatoire!";
        }

        if (empty($errors)) {
            $dsn = "mysql:host=localhost;dbname=literie";
            $db = new PDO($dsn, "root", "");

            $query = $db->prepare("INSERT INTO matelas 
        (name, marque, dimension, picture, prix, reduction) VALUES
        (:name, :marque, :dimension, :picture, :prix, :reduction)");

            //associe variable à chaque requete
            $query->bindParam(":name", $name);
            $query->bindParam(":marque", $marque);
            $query->bindParam(":dimension", $dimension);
            $query->bindParam(":picture", $picture);
            $query->bindParam(":prix", $prix);
            $query->bindParam(":reduction", $reduction);

            if ($query->execute()) {
                header("Location: index.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">


        <?php
        if (isset($_GET["id"])) {
        ?>
            <input type="hidden" id="id" name="id" value=<?= isset($id) ? $id : "" ?>>

        <?php
        }
        ?>
        <div class="form-group">
            <label for="inputName">Nom du matelas:</label>
            <input id="inputName" name="name" type="text" value=<?= isset($name) ? $name : "" ?>>
            <?php
            if (isset($errors["name"])) {
            ?>
                <span class="info-error"><?= $errors["name"] ?></span>
            <?php
            }
            ?>
        </div>

        <div class="form-group">
            <label for="inputPicture">Photo du matelas :</label>
            <input type="file" name="picture" />
            <?php
            if (isset($errors["picture"])) {
            ?>
                <span class="info-error"><?= $errors["picture"] ?></span>
            <?php
            }
            ?>

        </div>

        <div class="form-group">
            <label for="taille">taille:</label>
            <select id="taille" name="taille">
                <option value="90x190" <?= isset($dimension) ? (($dimension === "90x190") ? "selected='selected'" : "") : "" ?>>90x190</option>
                <option value="140x190" <?= isset($dimension) ? (($dimension === "140x190") ? "selected='selected'" : "") : "" ?>>140x190</option>
                <option value="160x200" <?= isset($dimension) ? (($dimension === "160x190") ? "selected='selected'" : "") : "" ?>>160x200</option>
                <option value="180x200" <?= isset($dimension) ? (($dimension === "180x200") ? "selected='selected'" : "") : "" ?>>180x200</option>
                <option value="200x200" <?= isset($dimension) ? (($dimension === "200x200") ? "selected='selected'" : "") : "" ?>>200x200</option>
            </select>


            <div class="form-group">
                <label for="marque">Marque:</label>
                <select id="marque" name="marque">
                    <option value="Epeda" <?= isset($marque) ? (($marque === "Epeda") ? "selected='selected'" : "") : "" ?>>Epeda</option>
                    <option value="Dreamway" <?= isset($marque) ? (($marque === "Dreamway") ? "selected='selected'" : "") : "" ?>>Dreamway</option>
                    <option value="Bultex" <?= isset($marque) ? (($marque === "Bultex") ? "selected='selected'" : "") : "" ?>>Bultex</option>
                    <option value="Dorsoline" <?= isset($marque) ? (($marque === "Dorsoline") ? "selected='selected'" : "") : "" ?>>Dorsoline</option>
                    <option value="MemoryLine" <?= isset($marque) ? (($marque === "MemoryLine") ? "selected='selected'" : "") : "" ?>>MemoryLine</option>
                </select>


                <div class="form-group">
                    <label for="inputPrix">Prix:</label>
                    <input id="inputPrix" name="prix" type="text" value=<?= isset($prix) ? $prix : "" ?>>
                    <?php
                    if (isset($errors["prix"])) {
                    ?>
                        <span class="info-error"><?= $errors["prix"] ?></span>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <label for="inputPrixReduction">Prix:</label>
                        <input id="inputPrixReduction" name="prixReduction" type="text" value=<?= isset($reduction) ? $reduction : "" ?>>
                        <?php
                        if (isset($errors["prixreduc"])) {
                        ?>
                            <span class="info-error"><?= $errors["prixreduc"] ?></span>
                        <?php
                        }
                        ?>

                        <?php
                        if (isset($_GET["id"])) {
                        ?>
                            <button type="submit" class="btn-matelas">MODIFIER</button>

                        <?php
                        } else {
                        ?>
                            <button type="submit" class="btn-matelas">AJOUTER</button>

                        <?php
                        }
                        ?>
    </form>

</body>

</html>