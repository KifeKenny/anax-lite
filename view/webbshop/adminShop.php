<?php

$url = $app->url->create("shop");
?>

<h1>Webbshop overview</h1>
<hr>

<div style="height: 50px; text-align: center;">
    <a href="?route=create">Create</a>
    <a href=<?=$url?> >Webbshop</a>
</div>

<table class="adminTable" style="margin-top: 0;">
    <tr class="adminTr">
        <th class="adminTh">Description</th>
        <th class="adminTh">Category</th>
        <th class="adminTh">Image</th>
        <th class="adminTh">Price</th>
        <th class="adminTh">Stock status</th>
        <th class="adminTh">Deleted</th>
    </tr>
<?php foreach ($resultset[0] as $row) :
?>
    <tr class="adminTr">
        <td class="adminTh"><?= $row->description ?></td>
        <td class="adminTh"><?= $row->category ?></td>
        <td class="adminTh"><?=$row->image ?></td>
        <td class="adminTh"><?= $row->price ?></td>
        <th class="adminTh"><?= $row->inventoryStatus ?></th>
        <th class="adminTh"><?= $row->deleted ?></th>
        <td class="adminTh"><a href='?route=edit&id=<?= $row->id ?>'>Edit</td>
        <td class="adminTh"><a href='?route=storage&id=<?= $row->id ?>'>Check/Edit Storage</td>
    </tr>
<?php endforeach; ?>
</table>
