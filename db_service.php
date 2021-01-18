<?php
include "global_vars.php";

/**
 * Searches the DB for actors that match a search term.
 * @param searchTerm a string
 * @return list of results
 */
function searchActors($searchTerm)
{
    // Treat * as a wildcard, i.e convert to ''
    if ($searchTerm == "*") $searchTerm = '';
    //Call function to get db connection
    $conn = create_db_conn();
    // Array to store results
    $results = array();
    // Prepare statement, using a stored procedure
    if ($stmt = $conn->prepare("call SearchActors(?)")) {
        // Set search term as parameter
        $stmt->bind_param("s", $searchTerm);
        // Execute mysql query
        $stmt->execute();
        // Get the following results
        $stmt->bind_result($title, $release_date, $vorname, $nachname);
        // While there are results, push them to the prepared array
        while ($stmt->fetch()) {
            array_push($results, [$title, $release_date, $vorname, $nachname]);
        }
        // Close statement
        $stmt->close();
    } else {
        // If statement fails, exit here and show errors
        die(mysqli_stmt_error($stmt));
    }
    return $results;
}

/**
 * Searches the DB for production companies that match a search term.
 * @param searchTerm a string
 * @return list of results
 */
function searchStudios($searchTerm)
{
    // Treat * as a wildcard, i.e convert to ''
    if ($searchTerm == "*") $searchTerm = '';
    //Call function to get db connection
    $conn = create_db_conn();
    // Array to store results
    $results = array();
    // Prepare statement, using a stored procedure
    if ($stmt = $conn->prepare("call SearchByProdCompany(?)")) {
        // Set search term as parameter
        $stmt->bind_param("s", $searchTerm);
        // Execute mysql query
        $stmt->execute();
        // Get the following results
        $stmt->bind_result($film_title, $release_date, $prod_company);
        // While there are results, push them to the prepared array
        while ($stmt->fetch()) {
            array_push($results, [$film_title, $release_date, $prod_company]);
        }
        // Close statement
        $stmt->close();
    } else {
        // If statement fails, exit here and show errors
        die(mysqli_stmt_error($stmt));
    }
    return $results;
}

/**
 * Create a database connection using the global vars
 * @return mysqli new mysql connection
 */
function create_db_conn() {
    //Set mysql to show all errors/warnings
    mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
    // Create new connection with global vars
    $conn = new mysqli($GLOBALS["SERVER"], $GLOBALS["USERNAME"], $GLOBALS["PASSWORD"], $GLOBALS["SCHEMA"]);
    // If connection has errors, exit func and report
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

?>