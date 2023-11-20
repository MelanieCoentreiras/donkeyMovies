<?php

require 'templates/header.php';

?>

<?php
//$dbh = new PDO('mysql:host=localhost;dbname=donkeyMovies', 'root', '');

$sth = $pdo->query('SELECT idmovie, movie_poster, movie_name, director FROM movie');
// fetch all rows into array, by default PDO::FETCH_BOTH is used
$rows = $sth->fetchAll(PDO::FETCH_ASSOC);

//var_dump($rows);

?>



<?php
//echo '<pre>',
//var_dump($rows);
?>


<div class="container-xl">
<br><br><h1>A l'affiche</h1>
    <div class="row row-cols-1 row-cols-md-4 g-4">
    <?php
    foreach($rows as $row){

    ?>
        <div class="col">
            <div class="card mb-3">
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['movie_poster']).'" class="card-img-top" alt="..." />'; ?>
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['movie_name'] ?></h5>
                <p class="card-text"><?php echo $row['director'] ?></p>
                <button type="button" class="btn btn-dark" onclick="window.location.href='/movie2.php?idmovie=<?php echo $row['idmovie'] ?>';">Réserver</button>
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


