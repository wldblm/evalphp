<?php

// Inclure le header
require __DIR__ . '/partials/header.php'; 

$id = intval($_GET['id']);
$logement = $db->query('SELECT * FROM logement WHERE id_logement='.$id)->fetch();

?>

<div class="container">
<div class="container my-3">
  <div class="row">
    <div class="col-lg-6">
        <img class="img-fluid" src="uploads/<?= $logement['photo']; ?>" alt="">
    </div> 
    <div class="col-lg-6">
        <h1><?= $logement['titre']; ?></h1>
    
        <p style="font-size:20px;">Prix: <?= $logement['prix']; ?> €</p>
        <p style="font-size:18px;">Adresse: <?= $logement['adresse']; ?> </p>
        <p style="font-size:18px;">Ville: <?= $logement['ville']; ?> </p>
        <p style="font-size:18px;">Code postale: <?= $logement['CP']; ?> </p>
        <p style="font-size:18px;">Surface: <?= $logement['surface']; ?> mètres carré</p>
        <p style="font-size:18px;">Type: <?= $logement['type']; ?> </p>
        <div style="font-size: 18px">description: <?= $logement['description']; ?></div>
           
    </div>
  </div> 
</div>
</div>



<?php

// Inclure le footer
require __DIR__ . '/partials/footer.php';