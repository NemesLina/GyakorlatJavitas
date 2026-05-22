<?php
/** @var array $fejlec */
/** @var array $oldalak */
/** @var array $keres */
/** @var array $lablec */
/** @var array $ablakcim */
/** @var PDO $pdo */


if (file_exists('./logicals/'.$keres['fajl'].'.php')) { 
    include("./logicals/{$keres['fajl']}.php"); 
} 
?>
<!DOCTYPE html>
<html lang="hu">
<head>
	<meta charset="utf-8">
	<title><?= htmlspecialchars($ablakcim['cim'] . ( (isset($ablakcim['mottó'])) ? (' | ' . $ablakcim['mottó']) : '' )) ?></title>
	
	<link rel="stylesheet" href="./style.css?v=2" type="text/css">
	
	<?php if (file_exists('./'.$keres['fajl'].'.css')) { ?>
		<link rel="stylesheet" href="./<?= $keres['fajl']?>.css" type="text/css">
	<?php } ?>
</head>
<body>
	<header>
		<?php if (isset($fejlec['kepforras']) && file_exists("./images/".$fejlec['kepforras'])) { ?>
			<img src="./images/<?=$fejlec['kepforras']?>" alt="<?=isset($fejlec['kepalt']) ? $fejlec['kepalt'] : ''?>">
		<?php } ?>
		<h1><?= isset($fejlec['cim']) ? htmlspecialchars($fejlec['cim']) : 'Cukrászda' ?></h1>
		<?php if (isset($fejlec['motto'])) { ?><h2><?= htmlspecialchars($fejlec['motto']) ?></h2><?php } ?>
		
		<div id="user-info">
			<?php if (isset($_SESSION['login'])) { ?>
				Bejelentkezve: <strong><?= htmlspecialchars($_SESSION['csn']." ".$_SESSION['un']." (".$_SESSION['login'].")") ?></strong>
			<?php } else { ?>
				Bejelentkezett: <strong>Vendég</strong>
			<?php } ?>
		</div>
	</header>
    <div id="wrapper">
        <aside id="nav">
            <nav>
                <ul>
					<?php foreach ($oldalak as $url => $oldal) { 
						$megjelenik = true;
						if (isset($oldal['menun']) && is_array($oldal['menun'])) {
							if (!isset($_SESSION['login']) && !$oldal['menun'][0]) $megjelenik = false;
							if (isset($_SESSION['login']) && !$oldal['menun'][1]) $megjelenik = false;
						}
						
						if (!isset($_SESSION['login']) && $oldal['fajl'] == 'kilepes') $megjelenik = false;
						if (isset($_SESSION['login']) && $oldal['fajl'] == 'belepes') $megjelenik = false;

						if ($megjelenik) { ?>
							<li<?= (($oldal == $keres) ? ' class="active"' : '') ?>>
								<a href="<?= ($url == '/') ? '.' : '?'.$url ?>">
									<?= htmlspecialchars($oldal['szoveg']) ?>
								</a>
							</li>
						<?php } ?>
					<?php } ?>
                </ul>
            </nav>
        </aside>
        <div id="content">
            <?php 
				$aloldal_fajl = "./templates/pages/{$keres['fajl']}.tpl.php";
				if (file_exists($aloldal_fajl)) {
					include($aloldal_fajl);
				} else {
					include("./templates/pages/404.tpl.php");
				}
			?>
        </div>
    </div>
    <footer>
        <?php if (isset($lablec['copyright'])) { ?>&copy;&nbsp;<?= htmlspecialchars($lablec['copyright']) ?> <?php } ?>
		&nbsp;
        <?php if (isset($lablec['ceg'])) { ?><?= htmlspecialchars($lablec['ceg']); ?><?php } ?>
    </footer>
</body>
</html>