<?php

require __DIR__ . '/partials/header.php'; 




$title = $_POST['name']?? null;
$adress = $_POST['adress']?? null;
$town = $_POST['town']?? null;
$cp = $_POST['cp']?? null;
$surface = $_POST['surface']?? null;
$price = $_POST['price']?? null;
$type = $_POST['type']?? null;
$description = $_POST['description']?? null;

$errors = [];

$uploads = __DIR__.'/uploads/' ?? null ;

if(!empty($_POST)){

    if(!is_numeric($cp) || strlen($cp) != 5){
        $errors['cp'] = 'Le format du code postale est incorrect !';
    }

    if(!ctype_digit($price)){
        $errors['price'] = 'Le prix doit être un nombre entier !';
    }

    if(!ctype_digit($surface)){
        $errors['surface'] = 'La surface doit être un nombre entier !';
    }


    if(empty($errors)){

        $query = $db->prepare('INSERT INTO logement (`titre`,`adresse`, `ville`, `CP`, `surface`, `prix`,`type`, `photo`, `description`) VALUES (:titre, :adresse, :ville, :CP, :surface, :prix,:type, :photo, :description)');

        $query->bindValue(':titre', $title);
        $query->bindValue(':adresse', $adress);
        $query->bindValue(':ville', $town);
        $query->bindValue(':CP', $cp);
        $query->bindValue(':surface', $surface);
        $query->bindValue(':prix', $price);
        $query->bindValue(':type', $type);
        $query->bindValue(':description', $description);


        $file = $_FILES['photo']['tmp_name'];
        // Renommer le fichier
        $originalName=$_FILES['photo']['name'];
        // On recupere l'extension
        $extension = pathinfo($originalName)['extension'];

        if($extension != "jpg"){
            echo'<div class="alert alert-danger">Le fichier doit etre en jpg</div>';
            exit;
            
        }
    
        if(filesize($file) > 100000){
            echo'<div class="alert alert-danger">Le fichier doit faire moins de 1 mo</div>';
            exit;
        }

        $filename ="logement_".time().'.'.$extension;
        // Creation du dossier uploads

        if(file_exists($uploads)){
            move_uploaded_file($file, __DIR__.'/uploads/'.$filename);
        }
        else {
            mkdir($uploads,0777);
            move_uploaded_file($file, __DIR__.'/uploads/'.$filename);
        }

        //On ajoute le chemin de l'image dans la base 
        $query->bindValue(':photo', $filename);


        // On doit executer la requête
        $query->execute();

        echo '<div class="alert alert-success">Le logement a bien été ajouté. </div>';

    } else {
        echo '<div class="alert alert-danger">';
        echo '<ul class="mb-0">';
        foreach ($errors as $error) {
            echo '<li>'.$error.'</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

}

?>


<div class="container">
        <h1>Ajouter un logement</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group <?= isset($errors['name']) ? 'is-invalid' : ''; ?>">
            <label for="name">Nom du logement</label>
            <input class="form-control" type="text" name="name" id="name" value="<?= $title ?>">
        </div>

        <div class="form-group">
            <label for="adress">Adresse</label>
            <input class="form-control" type="text" name="adress" id="adress" value = "<?= $adress ?>">
        </div>

        <div class="form-group">
            <label for="town">Ville</label>
            <input class="form-control" type="text" name="town" id="town" value = "<?= $town ?>">
        </div>

        <div class="form-group">
            <label for="cp">Code postale </label>
            <input class="form-control <?= isset($errors['cp']) ? 'is-invalid' : ''; ?>" type="text" name="cp" id="cp" value = "<?= $cp ?>">
        </div>

        <div class="form-group">
            <label for="surface">Surface (mètres carré) </label>
            <input class="form-control <?= isset($errors['surface']) ? 'is-invalid' : ''; ?>" type="text" name="surface" id="surface" value="<?= $surface ?>">
        </div>

        <div class="form-group">
            <label for="price">Prix</label>
            <input class="form-control <?= isset($errors['price']) ? 'is-invalid' : ''; ?>" type="text" name="price" id="price" value = "<?= $price ?>">
        </div>

        <div class="form-group">
            <label for="description">description</label>
        <textarea class="form-control" name="description" id="description" ><?= $description ?></textarea>
        </div>
        
        <div>
            <label for="photo">Image</label>
            <input class="form-control" type="file" name="photo" id="photo">
        </div>
        <div>
            
            <label for="type">Type</label>
            <select class="form-control" name="type" id="type">
                    <option value='Vente'>Vente</option>
                    <option value='Location'>Location</option>      
            </select>
        </div> 
        <br>
        <button class="btn btn-success">Ajouter le logement</button>
    </form>

</div>




<?php

require __DIR__ . '/partials/footer.php'; ?>

