<?php
include "global_vars.php";
include "db_service.php";
// Add all actors to result list at first
$results = searchActors('');
// If Search Field is set and form submitted, execute func with search term
if(isset($_POST['search_field'])) {
    $results = searchActors($_POST['search_field']);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Schauspieler Suche</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
        <script src="scripts.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <a class="nav-link" href="/index.php">Home</a>
        </nav>
        <div>
            <div class="section">
                <form action="" method="post">
                    <p>Suche nach Schauspieler:</p>
                    <input class="form-control" id="search_field" placeholder="Schauspieler" name="search_field"/>
                    <button type="submit" class="btn btn-primary" id="search" disabled>Suchen</button>
                </form>
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
                    <th scope="col">Date</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
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
                    // Else show none found.
                    else {
                        echo "<h3>No Actors found</h3>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>