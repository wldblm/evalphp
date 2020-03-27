<?php

// Inclure le header
require __DIR__ . '/partials/header.php'; 

$logements = $db->query('SELECT*FROM logement')->fetchAll();
?>

  <!-- Mon index -->

    <div class="container">
    <h1>Tous nos logements</h1>
      <table class="table">
        <thead>
          <tr>
            <th>Nom du logement</th>
            <th>Description</th>
            <th>Adresse</th>
            <th>Ville</th>
            <th>Code postale</th>
            <th>Surface</th>
            <th>Prix</th>
            <th>Image</th>
            <th>Type</th>

          </tr>
        </thead>

        <tbody>
          <?php foreach($logements as $logement): ?>
            <tr>
            <td><a href=" <?php echo "logement_single.php?id=".$logement['id_logement']; ?>"> <?=$logement['titre']?> </a></td>
            <td><?=tropLong($logement['adresse']);?></td>
            <td><?=$logement['ville']?></td>
            <td><?=$logement['CP']?></td>
            <td><?=$logement['surface']?></td>
            <td><?=$logement['prix']?></td>
            <td><?=tropLong($logement['description'])?></td>
            <td><img src="uploads/<?= $logement['photo'];?>" alt="..."></td>
            <td><?=$logement['type']?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>



<?php

// Inclure le footer
require __DIR__ . '/partials/footer.php';
