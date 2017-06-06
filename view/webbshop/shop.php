<h1>WebbShop</h1>
<hr>

<?php foreach ($resultset as $row) :
?>

<div class="shopblock left">
    <p><strong><?= $row->description ?></strong></p>
    <img src="img/bilder_webbshop/<?=$row->image ?>" class="shopPic">
    <p>Price: <?= $row->price ?>kr </p>

</div>
<?php endforeach; ?>
