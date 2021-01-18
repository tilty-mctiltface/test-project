<?php
include "global_vars.php";
include "db_service.php";

$searchedTerm = "''";
$companiesFound = 0;
$filmsFound = 0;
$results = searchStudios('');
if(isset($_POST['search_field'])) {
    $results = searchStudios($_POST['search_field']);

    $films = [];
    foreach($results as $res) {
        array_push($films, $res[count($res) - 1]);
    }

    $searchedTerm = $_POST['search_field'];
    $companiesFound = count(array_unique($films));
    $filmsFound = count($results);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Studiosuche</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    </head>
    <body>
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <a class="nav-link" href="/index.php">Home</a>
        </nav>
        <div>
            <div class="section">
                <form action="" method="post">
                    <p>Suche nach Produktionsfirma:</p>
                    <input placeholder="Produktionsfirma" name="search_field"/>
                    <button type="submit" class="btn btn-primary">Suchen</button>
                </form>
            </div>
            <div class="section">
                <?php
                    if(isset($_POST['search_field'])) {
                ?>
                <p><b>Searched Term:</b> <?php echo $searchedTerm ?> </p>
                <p><b>Found Companies:</b> <?php echo $companiesFound ?> </p>
                <p><b>Films Found:</b> <?php echo $filmsFound ?> </p>
                <?php
                    }
                ?>
            </div>
            <div class="section">
            <?php
                if (count($results) > 0) {
            ?>
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Release Date</th>
                    <th scope="col">Prod. Company</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($results as $result) {
                        echo "<tr>";
                        foreach ($result as $attr) {
                            echo "<td>{$attr}</td>";
                        }
                        echo "</tr>";
                    }
                ?>
                  </tbody>
                </table>
                <?php
                }
                else {
                    echo "<h3>No Production Companies found</h3>";
                }
                ?>
            </div>
        </div>
    </body>
</html>