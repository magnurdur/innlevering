<?php  
/*  vis-alle-klasser */
/*
/*  Programmet viser alle registrerte klasser i databasen
*/
?>

<h3>Alle registrerte klasser</h3>

<?php
include("db-tilkobling.php");  

$sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig &aring; hente data fra databasen.");

$antallRader = mysqli_num_rows($sqlResultat);

if ($antallRader == 0) {
    print("Det finnes ingen registrerte klasser i databasen.");
} else {
    print("<table border='1' cellspacing='0' cellpadding='5'>");
    print("<tr><th>Klassekode</th><th>Klassenavn</th><th>Studiumkode</th></tr>");

    while ($rad = mysqli_fetch_array($sqlResultat)) {
        $klassekode = $rad["klassekode"];
        $klassenavn = $rad["klassenavn"];
        $studiumkode = $rad["studiumkode"];

        print("<tr><td>$klassekode</td><td>$klassenavn</td><td>$studiumkode</td></tr>");
    }

    print("</table>");
}
?>
