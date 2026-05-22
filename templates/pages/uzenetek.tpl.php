<?php
// Ha nincs belépve (az id session kulcs alapján), akkor tiltás
if (!isset($_SESSION['id'])) {
    echo "<h2 style='color:red;'>Nincs jogosultsága az oldal megtekintéséhez! Kérjük, jelentkezzen be.</h2>";
    return;
}

/** @var PDO $pdo */
try {
    
    $stmt = $pdo->query("SELECT nev, datum, felhasznalo_id, uzenet FROM uzenetek ORDER BY datum DESC");
    $uzenetek = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<h2>Adatbázis hiba:</h2>";
    echo "<p style='color:red;'>" . htmlspecialchars($e->getMessage()) . "</p>";
    return;
}
?>

<h2>Beérkezett üzenetek</h2>

<?php if (empty($uzenetek)): ?>
    <p>Még nem érkezett üzenet.</p>
<?php else: ?>
    <table class="crud-table">
        <thead>
            <tr>
                <th>Küldés ideje</th>
                <th>Beküldő neve</th>
                <th>Üzenet</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($uzenetek as $uzenet): 
                
                $bekuldo = ($uzenet['felhasznalo_id'] === null) ? 'Vendég' : htmlspecialchars($uzenet['nev']);
            ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($uzenet['datum']); ?></strong></td>
                    <td><?php echo $bekuldo; ?></td>
                    <td><?php echo nl2br(htmlspecialchars($uzenet['uzenet'])); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>