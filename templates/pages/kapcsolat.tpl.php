<?php
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nev = trim($_POST['nev']);
    $email = trim($_POST['email']);
    $uzenet_text = trim($_POST['uzenet']);
    $hibak = [];

    
    if (empty($nev)) $hibak[] = "A név megadása kötelező.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $hibak[] = "Érvénytelen e-mail cím.";
    if (empty($uzenet_text)) $hibak[] = "Az üzenet nem lehet üres.";

    if (empty($hibak)) {
        $felhasznalo_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $stmt = $pdo->prepare("INSERT INTO uzenetek (felhasznalo_id, nev, email, uzenet) VALUES (?, ?, ?, ?)");
        if($stmt->execute([$felhasznalo_id, $nev, $email, $uzenet_text])) {
            $message = "<p style='color:green;'>Üzenet sikeresen elküldve!</p>";
        }
    } else {
        $message = "<p style='color:red;'>" . implode("<br>", $hibak) . "</p>";
    }
}
?>

<h2>Kapcsolat</h2>
<?php echo $message; ?>

<form id="kapcsolatForm" method="POST" action="index.php?page=kapcsolat">
    <div>
        <label>Név:</label><br>
        
        <input type="text" id="nev" name="nev">
    </div><br>
    <div>
        <label>E-mail:</label><br>
        
        <input type="text" id="email" name="email">
    </div><br>
    <div>
        <label>Üzenet:</label><br>
        <textarea id="uzenet" name="uzenet" rows="5" cols="40"></textarea>
    </div><br>
    <button type="submit">Küldés</button>
</form>

<script>
    
    document.getElementById('kapcsolatForm').onsubmit = function(e) {
        let nev = document.getElementById('nev').value.trim();
        let email = document.getElementById('email').value.trim();
        let uzenet = document.getElementById('uzenet').value.trim();
        let hibak = [];

        if (nev === "") hibak.push("Kérjük, adja meg a nevét!");

        
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "" || !emailRegex.test(email)) {
            hibak.push("Kérjük, adjon meg egy érvényes e-mail címet!");
        }

        if (uzenet === "") hibak.push("Kérjük, írja be az üzenetét!");

        if (hibak.length > 0) {
            alert(hibak.join("\n"));
            e.preventDefault(); 
            return false;
        }
        return true;
    };
</script>