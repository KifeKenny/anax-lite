<h1>Delete</h1>
<form method="post">
    <fieldset>
    <legend>Delete</legend>

    <input type="hidden" name="contentId" value=<?=esc($resultset[0]->id)?> />

    <p>
        <label>Title:<br>
            <input type="text" name="contentTitle" value=<?=esc($resultset[0]->title)?> readonly />
        </label>
    </p>

    <p>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
        <button type="submit" name="doRealDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Real Delete</button>
    </p>
    </fieldset>
</form>
