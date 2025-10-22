<?php  /* slett-klasse */

/*
  Programmet lager et skjema for å velge en klasse som skal slettes  
  Programmet sletter den valgte klassen
*/
?> 

<script src="funksjoner.js"></script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onSubmit="return bekreft()">
  Klassekode: <input type="text" id="klassekode" name="klassekode" maxlength="5" required /> <br/>
  <input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" /> 
</form>

<?php
if (isset($_POST["slettKlasseKnapp"])) {	
  $klassekode = strtoupper(trim($_POST["klassekode"])); // Trim og store bokstaver for konsistens
  
  if (!$klassekode) {
    echo "Klassekode må fylles ut";
  } else {
    include("db-tilkobling.php");  // kobling til database

    // Sjekk om klassen eksisterer
    $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
    $antallRader = mysqli_num_rows($sqlResultat); 

    if ($antallRader == 0) {
      echo "Klassen finnes ikke";
    } else {	  
      
      $sqlSetning = "DELETE FROM klasse WHERE klassekode='$klassekode';";
      mysqli_query($db, $sqlSetning) or die("Ikke mulig å slette data i databasen");
  
      echo "Følgende klasse er nå slettet: $klassekode <br />";
    }
  }
}
?> 
