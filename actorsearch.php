<?php
include "global_vars.php";
include "db_service.php"
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Schauspieler Suche</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <a class="nav-link" href="/index.php">Home</a>
        </nav>
        <div>
            <div class="section">
                <form action="" method="post">
                    <p>Suche nach Schauspieler:</p>
                    <input placeholder="Schauspieler" name="search_field"/>
                    <button type="submit" class="btn btn-primary" id="search">Suchen</button>
                </form>
            </div>

            <div class="section">
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
                    $results = searchActors('');
                    if(isset($_POST['search_field'])) {
                        $results = searchActors($_POST['search_field']);
                    }
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
            </div>
        </div>
    </body>
</html>