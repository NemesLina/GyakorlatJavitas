<?php
/** @var PDO $pdo */
$reg_uzenet = "";
$login_uzenet = "";

// --- 1. REGISZTRÁCIÓ KEZELÉSE ---
if (isset($_POST['regisztracio'])) {
    $cs_nev = trim($_POST['csaladi_nev']);
    $u_nev = trim($_POST['utonev']);
    $login = trim($_POST['login_nev']);
    $pw = $_POST['jelszo'];

    if (!empty($cs_nev) && !empty($u_nev) && !empty($login) && !empty($pw)) {
        try {
            // Ellenőrizzük, létezik-e már a felhasználó
            $stmt = $pdo->prepare("SELECT id FROM felhasznalok WHERE bejelentkezes = ?");
            $stmt->execute([$login]);
            if ($stmt->fetch()) {
                $reg_uzenet = "<p style='color:red;'>A felhasználónév már foglalt!</p>";
            } else {
                // Új felhasználó beszúrása
                $stmt = $pdo->prepare("INSERT INTO felhasznalok (csaladi_nev, utonev, bejelentkezes, jelszo) VALUES (?, ?, ?, ?)");
                if ($stmt->execute([$cs_nev, $u_nev, $login, password_hash($pw, PASSWORD_DEFAULT)])) {
                    $reg_uzenet = "<p style='color:green;'>Sikeres regisztráció! Most már beléphet.</p>";
                }
            }
        } catch (PDOException $e) {
            $reg_uzenet = "<p style='color:red;'>Adatbázis hiba történt a regisztráció során!</p>";
        }
    } else {
        $reg_uzenet = "<p style='color:red;'>Minden mező kitöltése kötelező!</p>";
    }
}

// --- 2. BEJELENTKEZÉS KEZELÉSE ---
if (isset($_POST['bejelentkezes'])) {
    $login = trim($_POST['login_nev']);
    $pw = $_POST['jelszo'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM felhasznalok WHERE bejelentkezes = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch();

        if ($user && password_verify($pw, $user['jelszo'])) {
            // BEÁLLÍTJUK AZOKAT A SESSION VÁLTOZÓKAT, AMIKET AZ INDEX.TPL.PHP ELVÁR!
            $_SESSION['id']    = $user['id'];
            $_SESSION['login'] = $user['bejelentkezes'];
            $_SESSION['csn']   = $user['csaladi_nev'];
            $_SESSION['un']    = $user['utonev'];
            
            // Frissítjük az oldalt, hogy érvénybe lépjen a bejelentkezés
            header("Location: ."); 
            exit();
        } else {
            $login_uzenet = "<p style='color:red;'>Hibás felhasználónév vagy jelszó!</p>";
        }
    } catch (PDOException $e) {
        $login_uzenet = "<p style='color:red;'>Adatbázis hiba történt a bejelentkezés során!</p>";
    }
}
?>

<div style="display: flex; gap: 50px; flex-wrap: wrap;">
    <section style="flex: 1; min-width: 300px;">
        <h2>Bejelentkezés</h2>
        <?php echo $login_uzenet; ?>
        <form method="POST" action="?belepes">
            <label>Felhasználónév:</label><br>
            <input type="text" name="login_nev" required><br><br>
            <label>Jelszó:</label><br>
            <input type="password" name="jelszo" required><br><br>
            <input type="submit" name="bejelentkezes" value="Belépés">
        </form>
    </section>

    <section style="flex: 1; min-width: 300px;">
        <h2>Regisztráció</h2>
        <?php echo $reg_uzenet; ?>
        <form method="POST" action="?belepes">
            <label>Családi név:</label><br>
            <input type="text" name="csaladi_nev" required><br><br>
            <label>Utónév:</label><br>
            <input type="text" name="utonev" required><br><br>
            <label>Felhasználónév (Login):</label><br>
            <input type="text" name="login_nev" required><br><br>
            <label>Jelszó:</label><br>
            <input type="password" name="jelszo" required><br><br>
            <input type="submit" name="regisztracio" value="Regisztráció">
        </form>
    </section>
</div>