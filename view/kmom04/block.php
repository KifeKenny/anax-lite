<h1>Block</h1>
<hr>
<div class="sidebar-right right">
    <h4 class="title-sidbar"><?= $resultset[0]->title ?></h4>
    <?= $app->filter->doFilter($resultset[0]->data, "markdown") ?>
</div>
<p> testar mitt block </p>
