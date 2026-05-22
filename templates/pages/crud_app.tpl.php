<?php
/** @var PDO $pdo */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mentes'])) {
    $nev = $_POST['nev'];
    $tipus = $_POST['tipus'];
    $dijazott = isset($_POST['dijazott']) ? 1 : 0;

    if (!empty($nev) && !empty($tipus)) {
        try {
            $sql = "INSERT INTO suti (nev, tipus, dijazott) VALUES (:nev, :tipus, :dijazott)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nev' => $nev,
                'tipus' => $tipus,
                'dijazott' => $dijazott
            ]);
            echo "<p style='color: green;'>Sütemény sikeresen hozzáadva!</p>";
        } catch (PDOException $e) {
            echo "<p style='color: red;'>Hiba a mentés során: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Minden mezőt ki kell tölteni!</p>";
    }
}
?>

<h2>Új sütemény hozzáadása</h2>

<form method="post" style="max-width: 400px; background: #f9f9f9; padding: 20px; border-radius: 8px;">
    <div style="margin-bottom: 15px;">
        <label>Sütemény neve:</label><br>
        <input type="text" name="nev" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Típusa (pl. torta, sütemény, pite):</label><br>
        <input type="text" name="tipus" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>
            <input type="checkbox" name="dijazott"> Díjazott sütemény
        </label>
    </div>

    <button type="submit" name="mentes" style="background: #6d4c41; color: white; border: none; padding: 10px 20px; cursor: pointer;">
        Mentés az adatbázisba
    </button>

    <a href="?page=crud" style="margin-left: 10px; color: #666;">Vissza a listához</a>
</form>


