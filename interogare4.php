<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Rezultate Interogare</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<h4>Interogare exercițiul 6.a</h4>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="searchPret">Prețul minim și prețul maxim al pieselor din catalog pentru fiecare furnizor și monedă:</label>
    <input type="submit" value="Caută" name="searchPret">
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


   
    if (isset($_POST['searchPret'])) {
       // Interogarea SQL
        $sql = "CALL GetPreturiMinMax()";

      // Execută interogarea
      $result = $conn->query($sql);

       // Verifică dacă interogarea a returnat rezultate
      if ($result && $result->num_rows > 0) {
        // Începe tabelul HTML
        echo '<div class="container">';
        echo "<table>";
        echo "<tr><th>IDF</th><th>Moneda</th><th>PretMinim</th><th>PretMaxim</th></tr>"; // Anteturile coloanelor
        // Afișează datele fiecărui rând
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["idf"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["moneda"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["PretMinim"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["PretMaxim"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>"; // Încheie tabelul HTML
        echo '</div>';
    } }


    echo "<hr>";

   ?>
   <h4>Interogare exercițiul 6.b</h4>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="searchNumar">Numărul de piese pentru fiecare ID comandă:</label>
    <input type="submit" value="Caută" name="searchNumar">
   </form>

   <?php
        if (isset($_POST['searchNumar'])) {
        // Interogarea SQL
        $sql = "CALL GetNumarPiesePerIdc()";

      // Execută interogarea
      $result = $conn->query($sql);

       // Verifică dacă interogarea a returnat rezultate
      if ($result && $result->num_rows > 0) {
        // Începe tabelul HTML
        echo '<div class="container">';
        echo "<table>";
        echo "<tr><th>IDC</th><th>NumarPiese</tr>";
 // Anteturile coloanelor
        // Afișează datele fiecărui rând
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["idc"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["NumarPiese"]) . "</td>";
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





