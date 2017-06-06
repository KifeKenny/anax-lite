<?php
if (!$resultset) {
    return;
}

$categorys = $resultset[2];
$myCat = $resultset[1];
$myCat = $myCat[0]->category;
$resultset = $resultset[0];
$url = $app->url->create("adminShop");

?>
<h1>Edit</h1>

<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="contentId" value="<?=esc($resultset[0]->id)?>" >

    <p>
        <label>Description<br>
        <input type="text" name="contetndescription" value="<?=esc($resultset[0]->description)?>" >
        </label>
    </p>

    <p>
        <label>Image<br>
            <input type="text" name="contentImage" value="<?=esc($resultset[0]->image)?>" >
    </p>

    <p>
        <label>Category<br>
            <select name="category">
                <?php
                foreach ($categorys as $value) {
                    if ($myCat == $value->category) {
                        echo "<option value=" . $value->id .  ">$value->category</option>";
                    }
                }
                foreach ($categorys as $value) {
                    if ($myCat != $value->category) {
                        echo "<option value=" . $value->id .  ">$value->category</option>";
                    }
                }
                ?>
            </select>
    </p>

    <p>
        <label>Price<br>
        <input type="number" step="0.01" name="contentPrice" value="<?=esc($resultset[0]->price)?>" >
     </p>

     <p>
         <label>InventoryStatus<br>
         <input type="text" value="<?=esc($resultset[0]->inventoryStatus)?>" readonly>
     </p>

    <p>
        <button type="submit" name="doSave"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
        <!-- <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button> -->
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </p>

    <p>
        <a href=<?=$url?> > <<< </a>
    </p>
    </fieldset>
</form>
