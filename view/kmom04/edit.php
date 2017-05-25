<?php
if (!$resultset) {
    return;
}

$url = $app->url->create("overview");
?>
<h1>Edit</h1>

<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="contentId" value=<?=esc($resultset[0]->id)?> >

    <p>
        <label>Title:<br>
        <input type="text" name="contentTitle" value=<?=esc($resultset[0]->title)?> >
        </label>
    </p>

    <p>
        <label>Path:<br>
        <input type="text" name="contentPath" value=<?=esc($resultset[0]->path)?> >
    </p>

    <p>
        <label>Slug:<br>
        <input type="text" name="contentSlug" value=<?=esc($resultset[0]->slug)?> >
    </p>

    <p>
        <label>Text:<br>
        <textarea class="editText" name="contentData"><?=esc($resultset[0]->data)?></textarea>
     </p>

     <p>
         <label>Type:<br>
         <input type="text" name="contentType" value=<?=esc($resultset[0]->type)?>>
     </p>

     <p>
         <label>Filter:<br>
         <input type="text" name="contentFilter" value=<?=esc($resultset[0]->filter)?>>
     </p>

     <p>
         <label>Publish:<br>
         <input type="datetime" name="contentPublish" value=<?=esc($resultset[0]->published)?>>
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
