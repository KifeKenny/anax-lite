<?php
if (!$resultset) {
    return;
}

$other = $resultset[1];
$resultset = $resultset[0];
$url = $app->url->create("adminShop");


?>
<h1>Storage</h1>


<form method="post">
    <fieldset>
    <legend>Edit product storage: <?=esc($other[0]->description)?></legend>
    <input type="hidden" name="contentId" value="<?=esc($resultset[0]->id)?>" >

    <p>
        <label>Shelf<br>
        <input type="text" name="contentShelf" value="<?=esc($resultset[0]->shelf_id)?>" >
        </label>
    </p>


    <p>
        <label>Items in stock<br>
        <input type="text" name="contentAmount" value="<?=esc($resultset[0]->items)?>" >
        </label>
    </p>

    <p>
        <button type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
    </p>

    <p>
        <a href=<?=$url?> > <<< </a>
    </p>
    </fieldset>
</form>
