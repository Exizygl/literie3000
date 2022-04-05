<?php
    if(!empty($_POST)){
        var_dump($_POST);
        
        $name = trim(strip_tags($_POST["name"]));
        $picture = $_FILES["picture"]["name"];
        $prix = trim(strip_tags($_POST["prix"]));
        $reduction = trim(strip_tags($_POST["prixReduction"]));
        $marque = $_POST["marque"];
        $taille = $_POST["taille"];
        
        echo $picture;
    
        $errors = [];
        if (empty($name)){
            $errors["name"] = "Le nom est obligatoire!";
        }
    
        if(empty($picture)){
            $errors["picture"]="La photo est obligatoire!";
        }
        
        if(empty($prix)){
            $errors["prix"]="Le prix est obligatoire!";
        }
    
    if (empty($errors)){
        $dsn = "mysql:host=localhost;dbname=literie";
        $db= new PDO($dsn, "root", "");
    
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
    
        if ($query->execute()){
             header("Location: index.php");
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
            <input type="file" name="picture" value="<?= isset($picture) ? $picture : "" ?>" />
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
                <option value="90x190">90x190</option>
                <option value="140x190">140x190</option>
                <option value="160x200">160x200</option>
                <option value="180x200">180x200</option>
                <option value="200x200">200x200</option>
            </select>
            

            <div class="form-group">
            <label for="marque">Marque:</label>
            <select id="marque" name="marque">
                <option value="Epeda">Epeda</option>
                <option value="Dreamway">Dreamway</option>
                <option value="Bultex">Bultex</option>
                <option value="Dorsoline">Dorsoline</option>
                <option value="MemoryLine">MemoryLine</option>
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
                        <input id="inputPrixReduction" name="prixReduction" type="text" value=<?= isset($prixreduc) ? $prixreduc : "" ?>>
                        <?php
                        if (isset($errors["prixreduc"])) {
                        ?>
                            <span class="info-error"><?= $errors["prixreduc"] ?></span>
                        <?php
                        }
                        ?>
                        <button type="submit" class="btn-matelas">AJOUTER</button>
    </form>

</body>

</html>