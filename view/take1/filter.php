<?php
$text = isset($_POST['text'])
? $_POST['text']
: $app->session->get("textFilter", null);

$app->session->set("textFilter", $text);

if (isset($text)) {
    $text2 = $app->filter->bbcode2html($text);
    $text3 = $app->filter->makeClickable($text2);
    $text4 = nl2br($text3);
    $text5 = $app->filter->markdown($text4);
}
?>

<h1>All Filters</h1>
<form action="" method="post">
    <div>
    <textarea name="text" class="textFilter"><?=$text?></textarea>
    </div>
    <input type="submit" value="Filter" class="inp1">
</form>

<div style="margin-top: 50px">
    <p><strong>Chose filter: </strong></p>
<a href="?filter=None">None</a>
<a href="?filter=BBCode">BBCode</a>
<a href="?filter=Link">Link</a>
<a href="?filter=Markdown">Markdown</a>
<a href="?filter=nl2br">nl2br</a>
</div>
<hr>
<?php

$filter = isset($_GET['filter'])
? $_GET['filter']
: "none";

$filterName = $filter;
$filterText = "$text";
$try = "";

switch ($filter) {
    case 'None':
        $filterText = "$text";
        break;

    case 'BBCode':
        $filterText = $app->filter->bbcode2html($text);
        $try = "[b]Bold text[/b] [i]Italic text[/i] [url=http://dbwebb.se]a link to dbwebb[/url]";
        break;

    case 'Link':
        $filterText = $app->filter->makeClickable($text);
        $try = "https://dbwebb.se";
        break;

    case 'Markdown':
        $filterText = $app->filter->markdown($text);
        $try = "<br> Header level 1 {#id1}<br>=====================";
        break;

    case 'nl2br':
        $filterText = nl2br($text);
        $try = "<br>test<br>test";
        break;

    default:
        break;
}

?>

<h3>Current filter : <?=$filterName?></h3>
<p>try: <em><?=$try?></em></p>
<strong>Output: </strong>
<hr>
    <p><?=$filterText?></p>
