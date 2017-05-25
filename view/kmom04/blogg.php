<?php
if (!$resultset) {
    return;
}
?>
<h1> Blogg</h1>
<hr>
<article>

<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h1><a href="?page=<?= esc($row->slug) ?>"><?= esc($row->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p>
    </header>
    <?= $app->filter->doFilter(certainAmount($row->data), $row->filter) ?>
    <hr>
</section>
<?php endforeach; ?>

</article>
