<?php
include "global_vars.php";

$servername = $GLOBALS["SERVER"];
$username = $GLOBALS["USERNAME"];
$password = $GLOBALS["PASSWORD"];
$schema = $GLOBALS["SCHEMA"];

function searchActors($searchTerm)
{
    mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

    $conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["schema"]);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $results = array();
    if ($stmt = $conn->prepare("call SearchActors(?)")) {
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $stmt->bind_result($title, $release_date, $vorname, $nachname);
        while ($stmt->fetch()) {
            array_push($results, [$title, $release_date, $vorname, $nachname]);
        }
        $stmt->close();
    } else {
        die(mysqli_stmt_error($stmt));
    }
    return $results;
}

function searchStudios($searchTerm)
{
    mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

    $conn = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["schema"]);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $results = array();
    if ($stmt = $conn->prepare("call SearchByProdCompany(?)")) {
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $stmt->bind_result($film_title, $release_date, $prod_company);
        while ($stmt->fetch()) {
            array_push($results, [$film_title, $release_date, $prod_company]);
        }
        $stmt->close();
    } else {
        die(mysqli_stmt_error($stmt));
    }
    return $results;
}

?>