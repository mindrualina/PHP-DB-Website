
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Pagina Principală</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>

<?php include 'header.php'; ?>

<div class="buttons-container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="submit" class="btn <?php if (isset($_POST['showFurnizori'])) echo 'btn-active'; ?>" value="Furnizori" name="showFurnizori">
    <input type="submit" class="btn <?php if (isset($_POST['showPiese'])) echo 'btn-active'; ?>" value="Piese" name="showPiese">
    <input type="submit" class="btn <?php if (isset($_POST['showCatalog'])) echo 'btn-active'; ?>" value="Catalog" name="showCatalog">
    <input type="submit" class="btn <?php if (isset($_POST['showComenzi'])) echo 'btn-active'; ?>" value="Comenzi" name="showComenzi">
</form>

</div>

<nav>
  <a href="Interogare1.php">Interogare 1</a>
  <a href="Interogare2.php">Interogare 2</a>
  <a href="Interogare3.php">Interogare 3</a>
  <a href="Interogare4.php">Interogare 4</a>
  <div class="animation start-interogare1"></div>
</nav>


<?php include 'footer.php'; ?>


<?php

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

if (isset($_POST['showFurnizori'])) {
    $sql = "SELECT * FROM Furnizori";
    // Restul codului pentru afișarea datelor din tabelul furnizori
} elseif (isset($_POST['showPiese'])) {
    $sql = "SELECT * FROM Piese";
    // Restul codului pentru afișarea datelor din tabelul piese
} elseif (isset($_POST['showCatalog'])) {
    $sql = "SELECT * FROM Catalog";
    // Restul codului pentru afișarea datelor din tabelul catalog
} elseif (isset($_POST['showComenzi'])) {
    $sql = "SELECT * FROM Comenzi";
    // Restul codului pentru afișarea datelor din tabelul comenzi
}


if (isset($sql)) {
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo '<div class="container">';
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        $fields = $result->fetch_fields();
        foreach ($fields as $field) {
            echo "<th>" . htmlspecialchars($field->name) . "</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo '</div>';
    } else {
        echo "0 rezultate sau eroare la executarea interogării: " . $conn->error;
    }

    $conn->close();
}

?>


</body>
</html>