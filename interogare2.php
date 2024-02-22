<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Rezultate Interogare</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<h4>Interogare exercițiul 4.a</h4>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="pretMin">Detaliile comenzilor pentru piese cu preț între:</label>
    <input type="number" id="pretMin" name="pretMin" placeholder="Ex: 10" min="0">

    <label for="pretMax">și:</label>
    <input type="number" id="pretMax" name="pretMax" placeholder="Ex: 20" min="0">

    <input type="submit" value="Caută Comenzi" name="submitComenzi">
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



    if (isset($_POST['submitComenzi'])) {
        $pretMin = $_POST['pretMin'];
         $pretMax = $_POST['pretMax'];
       // Interogarea SQL
        $sql = "SELECT * FROM Comenzi
        JOIN Catalog ON Comenzi.idp = Catalog.idp
        WHERE Catalog.pret BETWEEN ? AND ?;
        ";

    if ($stmt = $conn->prepare($sql)) {
          $stmt->bind_param("ii", $pretMin, $pretMax);
          $stmt->execute();
          $result = $stmt->get_result();

       // Verifică dacă interogarea a returnat rezultate
       if ($result->num_rows > 0) {
        // Începe tabelul HTML
        echo '<div class="container">';
        echo "<table>";
        echo "<tr><th>ID Comandă</th><th>ID Furnizor</th><th>ID Produs</th><th>Cantitate</th></tr>";
 // Anteturile coloanelor
        // Afișează datele fiecărui rând
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["idc"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["idf"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["idp"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["cantitate"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>"; // Încheie tabelul HTML
        echo '</div>';
    } else {
        echo "Nu s-au găsit rezultate.";
    }
    $stmt->close();
} else {
    echo "Eroare: " . $conn->error;
}
}

    echo "<hr>";

?>

    <h4>Interogare exercițiul 4.b</h4>
     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
     <label for="searchPerechi">Perechile de coduri de furnizori (idf1, idf2) care au comenzi 
pentru aceeași piesă la aceeași cantitate:</label>
     <input type="submit" value="Caută" name="searchPerechi">
    </form>
 
    <?php
         if (isset($_POST['searchPerechi'])) {
         // Interogarea SQL
         $sql = "SELECT c1.idf AS idf1, c2.idf AS idf2
         FROM Comenzi c1
         JOIN Comenzi c2 ON c1.idp = c2.idp AND c1.cantitate = c2.cantitate
         WHERE c1.idf < c2.idf;";
 
       // Execută interogarea
       $result = $conn->query($sql);
 
        // Verifică dacă interogarea a returnat rezultate
       if ($result && $result->num_rows > 0) {
        echo '<div class="container">';
         // Începe tabelul HTML
         echo "<table>";
         echo "<tr><th>idf1</th><th>idf2</th></tr>";
  // Anteturile coloanelor
         // Afișează datele fiecărui rând
         while ($row = $result->fetch_assoc()) {
             echo "<tr>";
             echo "<td>" . htmlspecialchars($row["idf1"]) . "</td>";
             echo "<td>" . htmlspecialchars($row["idf2"]) . "</td>";
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
 
 
 




