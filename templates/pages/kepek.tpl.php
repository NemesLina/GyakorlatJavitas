<?php
    
    $MAPPA = './images/';
    $TIPUSOK = array ('.jpg', '.png', '.gif');
    $MEDIATIPUSOK = array('image/jpeg', 'image/png', 'image/gif');
    $uzenet = array();

    
    if (isset($_SESSION['user_id']) && isset($_POST['kuld'])) {
        foreach($_FILES as $fajl) {
            if ($fajl['error'] == 4); 
            elseif (!in_array($fajl['type'], $MEDIATIPUSOK)) {
                $uzenet[] = " Nem megfelelő típus: " . $fajl['name'];
            }
            else {
                $vegleges_hely = $MAPPA . strtolower($fajl['name']);
                if (file_exists($vegleges_hely)) {
                    $uzenet[] = " Már létezik ilyen nevű fájl: " . $fajl['name'];
                } else {
                    move_uploaded_file($fajl['tmp_name'], $vegleges_hely);
                    $uzenet[] = " Sikeres feltöltés: " . $fajl['name'];
                }
            }
        }
    }

    
    $kepek = array();
    $olvaso = opendir($MAPPA);
    while (($fajl = readdir($olvaso)) !== false) {
        if (is_file($MAPPA.$fajl)) {
            $vege = strtolower(substr($fajl, strlen($fajl)-4));
            if (in_array($vege, $TIPUSOK)) {
                $kepek[$fajl] = filemtime($MAPPA.$fajl);
            }
        }
    }
    closedir($olvaso);
    arsort($kepek); 
?>

<style>
    .galeria { display: flex; flex-wrap: wrap; gap: 15px; justify-content: center; margin-top: 20px; }
    .kep-kartya { background: #fff; border: 1px solid #ddd; padding: 10px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); width: 220px; text-align: center; }
    .kep-kartya img { max-width: 100%; height: 150px; object-fit: cover; border-radius: 4px; }
    .feltoltes-box { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px; border: 1px dashed #007bff; }
    .hiba-lista { color: #d9534f; list-style: none; padding: 0; }
</style>

<h2>Képgaléria</h2>

<?php if (isset($_SESSION['user_id'])): ?>
    <div class="feltoltes-box">
        <h3>Új kép feltöltése</h3>
        <?php if (!empty($uzenet)) {
            echo '<ul class="hiba-lista">';
            foreach($uzenet as $u) echo "<li>$u</li>";
            echo '</ul>';
        } ?>
        <form action="index.php?kepek" method="post" enctype="multipart/form-data">
            <label>Válasszon ki egy képet (JPG, PNG, GIF):</label><br><br>
            <input type="file" name="elso" required>
            <input type="submit" name="kuld" value="Feltöltés">
        </form>
    </div>
<?php else: ?>
    <p><em>(Új képet csak bejelentkezés után tud feltölteni.)</em></p>
<?php endif; ?>

<div class="galeria">
    <?php if (empty($kepek)): ?>
        <p>Még nincs feltöltött kép a galériában.</p>
    <?php else: ?>
        <?php foreach (array_keys($kepek) as $fajlnev): ?>
            <div class="kep-kartya">
                <a href="<?php echo $MAPPA.$fajlnev; ?>" target="_blank">
                    <img src="<?php echo $MAPPA.$fajlnev; ?>" alt="<?php echo $fajlnev; ?>">
                </a>
                <p><small><?php echo $fajlnev; ?></small></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>