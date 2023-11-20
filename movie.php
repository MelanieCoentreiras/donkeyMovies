<?php

require 'templates/header.php';

?>

<?php
//$dbh = new PDO('mysql:host=localhost;dbname=donkeyMovies', 'root', '');
$id_movie = isset ($_GET['idmovie']);
$sth = $pdo->prepare('SELECT * FROM movie WHERE idmovie=:id');
$sth->bindValue(':id', $id_movie, PDO::PARAM_INT);
$sth->execute();
// fetch all rows into array, by default PDO::FETCH_BOTH is used
$rows = $sth->fetchAll(PDO::FETCH_ASSOC);

/*$show_query = $pdo->query('SELECT idshow, show_time, show_date, id_movie FROM show');
// fetch all rows into array, by default PDO::FETCH_BOTH is used
$showtime = $show_query->fetchAll(PDO::FETCH_ASSOC);*/

// connexion show_time
$sth = $pdo->prepare('SELECT * FROM show_time WHERE id_movie=:id');
$sth->bindValue(':id', $id_movie, PDO::PARAM_INT);
$sth->execute();

// fetch all rows into array, by default PDO::FETCH_BOTH is used
$show_times = $sth->fetchAll(PDO::FETCH_ASSOC);

// connexion movie_category
$sth = $pdo->prepare('SELECT * FROM movie_category WHERE id_movie=:id');
$sth->bindValue(':id', $id_movie, PDO::PARAM_INT);
$sth->execute();

// fetch all rows into array, by default PDO::FETCH_BOTH is used
$category_name = $sth->fetchAll(PDO::FETCH_ASSOC);


var_dump($rows, $show_times, $category_name);

?>


<div class="container-xl">
    <div class="row align-items-start">
    <?php
    foreach($rows as $row){

    ?>
        <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['movie_poster']).'" class="card-img-top" alt="..." />'; ?>
            </div>
            <div class="col-md-7">
            <div class="card-body">
                <h2 class="card-title"><?php echo $row['movie_name'] ?></h2>
                <br>
                <h5 class="card-text"><small class="text-body-secondary">Synopsis</small></h5>
                <p class="card-text"><?php echo $row['synopsis'] ?></p>
                <br>
                <h5 class="card-text"><small class="text-body-secondary">Durée</small></h5>
                <p class="card-text"><?php echo $row['duration']. " minutes" ?></p>
                <br>
                <h5 class="card-text"><small class="text-body-secondary">Casting</small></h5>
                <p class="card-text"><?php echo $row['cast'] ?></p>
                <br>
                <h5 class="card-text"><small class="text-body-secondary">Date de sortie</small></h5>
                <p class="card-text"><?php echo $row['releaseDate'] ?></p>
                <br>
                <h5 class="card-text"><small class="text-body-secondary">Genre</small></h5>
                <p class="card-text"><?php echo $row['category_name'] ?></p>
                <br>
                <div class="row">
                    <div class="col">
                        <h5 class="card-text"><small class="text-body-secondary">Choisir une date</small></h5>
                        <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown button</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <h5 class="card-text"><small class="text-body-secondary">Choisir un horaire</small></h5>
                        <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown button</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
            </div>
        </div>
        </div>

    <?php
        }
    ?>
    </div>
</div>

    

<?php

require 'templates/footer.php';

?>


