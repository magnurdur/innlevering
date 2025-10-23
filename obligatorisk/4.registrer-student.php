<?php  
/*  registrer-student */
/*
/*  Programmet lager et HTML-skjema for å registrere en student
/*  Programmet registrerer data (brukernavn, fornavn, etternavn, klassekode) i databasen
*/
?> 

<h3>Registrer student</h3>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Brukernavn: <input type="text" id="brukernavn" name="brukernavn" maxlength="7" required /> <br/>
  Fornavn: <input type="text" id="fornavn" name="fornavn" maxlength="50" required /> <br/>
  Etternavn: <input type="text" id="etternavn" name="etternavn" maxlength="50" required /> <br/>
  
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
        print("<option value='$klassekode'>$klassekode - $klassenavn</option>");
      }
    ?>
  </select>
  <br/>

  <input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
if (isset($_POST["registrerStudentKnapp"])) {
    $brukernavn = $_POST["brukernavn"];
    $fornavn    = $_POST["fornavn"];
    $etternavn  = $_POST["etternavn"];
    $klassekode = $_POST["klassekode"];

    if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode) {
        print("Alle felter må fylles ut.");
    } else {
        include("db-tilkobling.php");  

        $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
        $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen.");
        $antallRader = mysqli_num_rows($sqlResultat); 

        if ($antallRader != 0) {
            print("Brukernavnet er registrert fra før.");
        } else {
            $sqlSetning = "INSERT INTO student (brukernavn, fornavn, etternavn, klassekode) 
                           VALUES('$brukernavn', '$fornavn', '$etternavn', '$klassekode');";
            mysqli_query($db, $sqlSetning) or die("Ikke mulig å registrere data i databasen.");

            print("Følgende student er nå registrert: <b>$brukernavn</b> – $fornavn $etternavn (Klasse: $klassekode)");
        }
    }
}
?> 