<?php
include "global_vars.php";
include "db_service.php";

// Declare variables that will hold results of the search
$searchedTerm = "''";
$companiesFound = 0;
$filmsFound = 0;
$results = searchStudios('');
// If Search Field is set and form submitted, execute func with search term
if(isset($_POST['search_field'])) {
    $results = searchStudios($_POST['search_field']);

    $prod_companies = [];
    // Push all found companies to a new array so we can count distinct prod companies later
    foreach($results as $res) {
        array_push($prod_companies, $res[count($res) - 1]);
    }

    $searchedTerm = $_POST['search_field'];
    $companiesFound = count(array_unique($prod_companies)); // Counting distinct companies
    $filmsFound = count($results); // Counting amount of films found
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Studiosuche</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
        <script src="scripts.js"></script>
    </head>
    </head>
    <body>
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <a class="nav-link" href="/index.php">Home</a>
        </nav>
        <div>
            <div class="section">
                <form action="" method="post">
                    <p>Suche nach Produktionsfirma(* für alle):</p>
                    <input id="search_field" placeholder="Produktionsfirma" name="search_field"/>
                    <button type="submit" class="btn btn-primary" id="search" disabled>Suchen</button>
                </form>
            </div>
            <div class="section">
                <?php
                // Show search details only if a search was submitted
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
                // Only show table if query results are more than 0
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
                // For each set of results, create one table row with one cell per attribute
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