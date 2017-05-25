<?php

$url = $app->url->create("page");
?>

<h1>Content overview</h1>
<hr>
<div style="height: 50px; text-align: center;">
    <a href="?route=create">Create</a>
    <a href="?route=blogg">Blogg</a>
    <a href=<?="$url?route=Show-All"?> >Pages</a>
</div>

<table class="adminTable" style="margin-top: 0;">
    <tr class="adminTr">
        <!-- <th>Rad</th> -->
        <th class="adminTh">Id</th>
        <th class="adminTh">Slug</th>
        <th class="adminTh">Title</th>
        <th class="adminTh">Path</th>
        <th class="adminTh">Published</th>
        <th class="adminTh">Created</th>
        <th class="adminTh">Updated</th>
        <th class="adminTh">Deleted</th>
        <th class="adminTh">Actions</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++;
?>
    <tr class="adminTr">
        <td class="adminTh"><?= $row->id ?></td>
        <td class="adminTh"><?= $row->slug ?></td>
        <td class="adminTh"><?=$row->title ?></td>
        <td class="adminTh"><?= $row->path ?></td>
        <td class="adminTh"><?= $row->published ?></td>
        <td class="adminTh"><?= $row->created ?></td>
        <td class="adminTh"><?= $row->updated ?></td>
        <td class="adminTh"><?= $row->deleted ?></td>
        <td class="adminTh"><a href='?route=edit&id=<?= $row->id ?>'>Edit</td>
        <td class="adminTh"><a href='?route=delete&id=<?= $row->id ?>'>Delete</td>
    </tr>
<?php endforeach; ?>
</table>
