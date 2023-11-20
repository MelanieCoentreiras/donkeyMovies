<?php
require 'templates/header.php';

$id_movie = isset($_GET['idmovie']) ? $_GET['idmovie'] : null;

// Vérifiez si l'ID du film est défini
if ($id_movie !== null) {
    // Utilisez des jointures pour récupérer les données de plusieurs tables
    $sth = $pdo->prepare('
        SELECT 
            m.*,
            st.show_time,
            mc.category_name,
            st.show_date
        FROM 
            movie m
            LEFT JOIN show_time st ON m.idmovie = st.id_movie
            LEFT JOIN movie_category mc ON m.idmovie = mc.id_movie
        WHERE
            m.idmovie = :id
    ');

    $sth->bindValue(':id', $id_movie, PDO::PARAM_INT);
    $sth->execute();

    // fetch all rows into array, by default PDO::FETCH_BOTH is used
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);

    //var_dump($rows);

    // Assurez-vous que le résultat est non vide
    if (!empty($rows)) {
        $row = $rows[0]; // Utilisez la première ligne, car les données du film ne devraient pas varier
        ?>
        <br>
        <div class="container-xl">
            <div class="row align-items-start">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['movie_poster']) . '" class="card-img-top" alt="..." />'; ?>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo $row['movie_name'] ?></h2><br>
                                <h5 class="card-text"><small class="text-body-secondary">Synopsis</small></h5>
                                <p class="card-text"><?php echo $row['synopsis'] ?></p><br>
                                <h5 class="card-text"><small class="text-body-secondary">Durée</small></h5>
                                <p class="card-text"><?php echo $row['duration']. " minutes" ?></p><br>
                                <h5 class="card-text"><small class="text-body-secondary">Casting</small></h5>
                                <p class="card-text"><?php echo $row['cast'] ?></p><br>
                                <h5 class="card-text"><small class="text-body-secondary">Date de sortie</small></h5><br>
                                <h5 class="card-text"><small class="text-body-secondary">Genre</small></h5>
                                <p class="card-text"><?php echo $row['category_name'] ?></p>
                                <div class="row">
                                <h5 class="card-text"><small class="text-body-secondary">Choisir une date</small></h5>
                                    <?php foreach ($rows as $dateOption) : ?>
                                        <?php if (isset($dateOption['show_date'])) : ?>
                                            <div class="col">
                                                <a class="square-link" href="#">
                                                    <?php echo $dateOption['show_date']; ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <!-- Choix de l'heure -->
                                <div class="row">
                                <h5 class="card-text"><small class="text-body-secondary">Choisir une heure</small></h5>
                                    <?php foreach ($rows as $timeOption) : ?>
                                        <?php if (isset($timeOption['show_time'])) : ?>
                                            <div class="col">
                                                <a class="square-link" href="#">
                                                    <?php echo $timeOption['show_time']; ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "Aucune donnée trouvée pour l'ID de film spécifié.";
    }
} else {
    echo "ID du film non spécifié.";
}

require 'templates/footer.php';
?>

