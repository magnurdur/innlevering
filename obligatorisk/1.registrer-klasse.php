<?php  
/* registrer-klasse */
/*
/*  Programmet lager et HTML-skjema for å registrere en klasse
/*  Programmet registrerer data (klassekode, klassenavn, studiumkode) i databasen
*/
?> 

<h3>Registrer klasse</h3>

<form method="post" action="" id="registrerKlasseSkjema" name="registrerKlasseSkjema">
  Klassekode: <input type="text" id="klassekode" name="klassekode" maxlength="5" required /> <br/>
  Klassenavn: <input type="text" id="klassenavn" name="klassenavn" maxlength="50" required /> <br/>
  Studiumkode: <input type="text" id="studiumkode" name="studiumkode" maxlength="50" required /> <br/>
  <input type="submit" value="Registrer klasse" id="registrerKlasseKnapp" name="registrerKlasseKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
if (isset($_POST["registrerKlasseKnapp"])) {
    $klassekode = $_POST["klassekode"];
    $klassenavn = $_POST["klassenavn"];
    $studiumkode = $_POST["studiumkode"];

    if (!$klassekode || !$klassenavn || !$studiumkode) {
        print("Alle felter m&aring; fylles ut.");
    } else {
        include("db-tilkobling.php");  

        $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig &aring; hente data fra databasen.");
        $antallRader = mysqli_num_rows($sqlResultat); 

        if ($antallRader != 0) {
            print("Klassen er registrert fra f&oslash;r.");
        } else {
            $sqlSetning = "INSERT INTO klasse VALUES('$klassekode', '$klassenavn', '$studiumkode');";
            mysqli_query($db, $sqlSetning) or die("Ikke mulig &aring; registrere data i databasen.");

            print("F&oslash;lgende klasse er n&aring; registrert: <b>$klassekode</b> – $klassenavn ($studiumkode)");
        }
    }
}
?> 
