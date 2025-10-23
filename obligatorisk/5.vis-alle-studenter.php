<?php  
/*  vis-alle-studenter */
/*
/*  Programmet viser alle registrerte studenter i databasen
*/
?>

<h3>Alle registrerte studenter</h3>

<?php
include("db-tilkobling.php");  

$sqlSetning = "SELECT * FROM student ORDER BY brukernavn;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen.");

$antallRader = mysqli_num_rows($sqlResultat);

if ($antallRader == 0) {
    print("Det finnes ingen registrerte studenter i databasen.");
} else {
    print("<table border='1' cellspacing='0' cellpadding='5'>");
    print("<tr><th>Brukernavn</th><th>Fornavn</th><th>Etternavn</th><th>Klassekode</th></tr>");

    while ($rad = mysqli_fetch_array($sqlResultat)) {
        $brukernavn = $rad["brukernavn"];
        $fornavn = $rad["fornavn"];
        $etternavn = $rad["etternavn"];
        $klassekode = $rad["klassekode"];

        print("<tr><td>$brukernavn</td><td>$fornavn</td><td>$etternavn</td><td>$klassekode</td></tr>");
    }

    print("</table>");
}
?>
