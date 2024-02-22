<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Rezultate Interogare</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<h4>Interogare exercițiul 3.a</h4>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="searchFurnizori">Caută furnizori a căror adresă se termină cu:</label>
    <input type="text" id="searchNumber" name="searchNumber" placeholder="Introduceți un număr">
    <input type="hidden" id="searchFurnizori" name="searchTerm" value="8">
    <input type="submit" value="Caută" name="searchFurnizori">
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



    if (isset($_POST['searchFurnizori'])) {
        $searchNumber = $_POST['searchNumber'];
        if (is_numeric($searchNumber)) {
       // Interogarea SQL
        $sql = "SELECT * FROM Furnizori WHERE adresa LIKE '%$searchNumber' ORDER BY adresa ASC;";

      // Execută interogarea
      $result = $conn->query($sql);

       // Verifică dacă interogarea a returnat rezultate
      if ($result && $result->num_rows > 0) {
        echo '<div class="container">';
        // Începe tabelul HTML
        echo "<table>";
        echo "<tr><th>ID</th><th>Nume</th><th>Adresa</th></tr>"; // Anteturile coloanelor
        // Afișează datele fiecărui rând
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["idf"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["numef"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["adresa"]) . "</td>";
            echo "</tr>";
        }
        echo "</table>"; // Încheie tabelul HTML
        echo '</div>';
    } else {
        echo "Vă rugăm să introduceți un număr valid.";
    } }}


    echo "<hr>";

   ?>
   <h4>Interogare exercițiul 3.b</h4>
   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="minCantitate">Detaliile comenzilor pentru care cantitatea minimă este:</label>
    <input type="number" id="minCantitate" name="minCantitate" min="0" placeholder="Ex: 200">

    <label for="excludeCantitate">Cu excepția valorii:</label>
    <input type="number" id="excludeCantitate" name="excludeCantitate" min="0" placeholder="Ex: 300">

    <input type="submit" value="Caută" name="submitComenzi">
</form>


   <?php
        if (isset($_POST['submitComenzi'])) {
            $minCantitate = $_POST['minCantitate'];
            $excludeCantitate = $_POST['excludeCantitate'];
        // Interogarea SQL
        $sql = "SELECT *
        FROM Comenzi
        WHERE cantitate > ? AND cantitate != ?;";

       // Verifică dacă interogarea a returnat rezultate
       if ($stmt = $conn->prepare($sql)) {
           $stmt->bind_param("ii", $minCantitate, $excludeCantitate);
            $stmt->execute();
           $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                // Începe tabelul HTML
                echo '<div class="container">';
                echo "<table>";
                echo "<tr><th>ID Comandă</th><th>ID Furnizor</th><th>ID Produs</th><th>Cantitate</th></tr>";
        
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
                echo "0 rezultate.";
            }} 
       else {
        echo "Eroare la pregătirea interogării: " . $conn->error;
    }

    $stmt->close();

       }

    // Închide conexiunea
    $conn->close();
    
    
?>

<div class="buttons-rev-container">
<a href="index.php" class="btn">Revenire</a>
    </div>

</body>
</html>