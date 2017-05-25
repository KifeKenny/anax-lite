<?php
if (!$resultset) {
    return;
}

$text = $app->filter->doFilter(esc($resultset[0]->data), esc($resultset[0]->filter));
?>
<h1><?=esc($resultset[0]->title)?></h1>
<hr>
<article>
<p><i>Published: <?=$resultset[0]->published?> </i></p>

<section>
    <p>
    <?= $text ?>
</p>
</section>


</article>
