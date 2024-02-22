<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Rezultate Interogare</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<h4>Interogare exercițiul 5.a</h4>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="idf">Numele furnizorilor care au în catalog toate piesele din catalogul furnizorului:</label>
    <input type="number" id="idf" name="idf" min="0" placeholder="ex. 101">

    <input type="submit" value="Caută" name="submitFurnizori">
</form>

<?php 
    // Datele pentru conexiunea la baza de date
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "colocviu";

    // Creează conexiunea
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifică conexiunea
    if ($conn->connect_error) {
        die("Conexiunea a eșuat: " . $conn->connect_error);
    }



    if (isset($_POST['submitFurnizori'])) {
        $idfIntrodus = $_POST['idf'];
       // Interogarea SQL
        $sql = "SELECT f.numef FROM Furnizori f WHERE f.idf != ? AND EXISTS (
            SELECT 1
            FROM Catalog
            WHERE idf = ?
        )
        AND NOT EXISTS ( SELECT p.idp FROM Catalog p WHERE p.idf = ? AND p.idp NOT IN ( SELECT fp.idp FROM Catalog fp WHERE fp.idf = f.idf ) );";

       // Verifică dacă interogarea a returnat rezultate
       if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iii", $idfIntrodus, $idfIntrodus, $idfIntrodus);
        $stmt->execute();
        $result = $stmt->get_result();

       if ( $result->num_rows > 0) {
        // Începe tabelul HTML
        echo '<div class="container">';
        echo "<table>";
        echo "<tr><th>numef</th></tr>"; // Anteturile coloanelor
        // Afișează datele fiecărui rând
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["numef"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>"; // Încheie tabelul HTML
        echo '</div>';
    } 
    else {
        echo "Nu s-au găsit rezultate.";
    }
    $stmt->close();
} else {
    echo "Eroare: " . $conn->error;
}
}


    echo "<hr>";

   ?>
   <h4>Interogare exercițiul 5.b</h4>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="searchPiesa">Piesa cu prețul maxim:</label>
    <input type="submit" value="Caută" name="searchPiesa">
   </form>

   <?php
        if (isset($_POST['searchPiesa'])) {
        // Interogarea SQL
        $sql = "CALL GetPiesaCuPretMaxim()";

      // Execută interogarea
      $result = $conn->query($sql);

       // Verifică dacă interogarea a returnat rezultate
      if ($result && $result->num_rows > 0) {
        // Începe tabelul HTML
        echo '<div class="container">';
        echo "<table>";
        echo "<tr><th>IDP</th><th>NUMEP</th><th>PRET</th><th>MONEDA</th></tr>";
 // Anteturile coloanelor
        // Afișează datele fiecărui rând
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["idp"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["numep"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["pret"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["moneda"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>"; // Încheie tabelul HTML
        echo '</div>';
    } else {
        echo "0 rezultate.";
    }



    // Închide conexiunea
    $conn->close();
}
    
    
?>

<div class="buttons-rev-container">
<a href="index.php" class="btn">Revenire</a>
</div>

</body>
</html>





