<?php
/** @var PDO $pdo */
$stmt = $pdo->query("SELECT id, nev, tipus, dijazott FROM suti LIMIT 15"); 
$sutik = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .crud-header { display: flex; justify-content: flex-start; margin-bottom: 15px; }
    .btn-add { background-color: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; border: none; cursor: pointer; }

    .crud-table { width: 100%; border-collapse: collapse; margin-top: 10px; border: 1px solid #ddd; }
    .crud-table th, .crud-table td { border-bottom: 1px solid #ddd; padding: 12px; text-align: left; }
    .crud-table th { background-color: #f8f9fa; color: #333; font-weight: bold; }

    .btn-edit { background-color: #17a2b8; color: white; border: none; padding: 6px 12px; border-radius: 3px; cursor: pointer; font-size: 14px;}
    .btn-delete { background-color: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 3px; cursor: pointer; font-size: 14px;}
    .actions-col { text-align: center; }
</style>

<h2>Sütemények Kezelése (CRUD)</h2>

<div class="crud-header">
    <a href="index.php?page=crud_add" class="btn-add">Add New</a>
</div>

<table class="crud-table">
    <thead>
    <tr>
        <th>Name (Név)</th>
        <th>Type (Típus)</th>
        <th>Award (Díjazott)</th>
        <th class="actions-col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($sutik as $suti): ?>
        <tr>
            <td><?php echo htmlspecialchars($suti['nev']); ?></td>
            <td><?php echo htmlspecialchars($suti['tipus']); ?></td>
            <td><?php echo $suti['dijazott'] ? 'Igen' : 'Nem'; ?></td>
            <td class="actions-col">
                <button class="btn-edit">Edit</button>
                <button class="btn-delete">Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>