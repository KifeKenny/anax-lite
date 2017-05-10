<h1>Calendar</h1>
<hr>

<?php

$today = getdate();
$m = $today["mon"];

if (!$app->session->has("month")) {
    $app->session->set("month", $m);
}
$month = $app->session->get("month") - 1;
echo "<h3>" . $app->calandar->getMonth($month)->month . "</h3>";
?>


<article>
    <table style="width:100%">
  <tr>
    <th class="weekdays">Mon</th>
    <th class="weekdays">Tue</th>
    <th class="weekdays">Wed</th>
    <th class="weekdays">Thu</th>
    <th class="weekdays">Fri</th>
    <th class="weekdays">Sat</th>
    <th class="weekdays">Sun</th>
  </tr>
  </table>
<?php
$app->calandar->getMonth($month)->allDays();

?>
</article>
<img class="calPic" src=<?=$app->calandar->getMonth($month)->pic?> alt="month pic">

<div style="overflow:auto; width:100%">
<div>
<?php
$url = $app->url->create("forward");
echo '<a class=monkey href=' . $url .'>>>></a>';

?>
</div>

<div>
<?php
$url2 = $app->url->create("back");
echo '<a class=monkey2 href=' . $url2 .'><<<</a>';

?>
</div>
</div>
    </main>
</body>
