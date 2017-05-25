<?php
if (!$resultset) {
    return;
}

?>

<h1>Pages</h1>
<hr>
<table class="adminTable">
    <tr class="adminTr">
        <th class="adminTh">Title</th>
        <th class="adminTh">Published</th>
        <th class="adminTh">Created</th>
        <th class="adminTh">Updated</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++;
?>
    <tr class="adminTr">
        <td class="adminTh"><a href=<?= "?route=" . $row->path . "> $row->title</a>" ?></td>
        <td class="adminTh"><?= $row->published ?></td>
        <td class="adminTh"><?= $row->created ?></td>
        <td class="adminTh"><?= $row->updated ?></td>
    </tr>
<?php endforeach; ?>
</table>
