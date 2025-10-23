<?php  
/* slett-klasse */
/*
/* Programmet lager et skjema for å velge en klasse som skal slettes  
/* Programmet sletter den valgte klassen
*/
?> 

<script src="funksjoner.js"></script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onsubmit="return bekreft()">
  <?php
    include("db-tilkobling.php");  

    
    $sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen.");
  ?>

  Klassekode: 
  <select name="klassekode" id="klassekode" required>
    <option value="">-- Velg klasse --</option>
    <?php 
      while ($rad = mysqli_fetch_array($sqlResultat)) {
        $klassekode = $rad["klassekode"];
        $klassenavn = $rad["klassenavn"];
        print("<option value='$klassekode'>$klassekode – $klassenavn</option>");
      }
    ?>
  </select>
  <br/>

  <input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" /> 
</form>

<?php
if (isset($_POST["slettKlasseKnapp"])) {	
  $klassekode = $_POST["klassekode"];

  if (!$klassekode) {
    echo "Du må velge en klasse.";
  } else {
    include("db-tilkobling.php");  

    
    $sqlSetning = "SELECT * FROM klasse WHERE klassekode='$klassekode';";
    $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen.");
    $antallRader = mysqli_num_rows($sqlResultat); 

    if ($antallRader == 0) {
      echo "Klassen finnes ikke.";
    } else {	  
      
      $sqlSetning = "DELETE FROM klasse WHERE klassekode='$klassekode';";
      mysqli_query($db, $sqlSetning) or die("Ikke mulig å slette data i databasen.");
  
      echo "Følgende klasse er nå slettet: <b>$klassekode</b><br />";
    }
  }
}
?> 
