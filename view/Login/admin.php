<?php

$show = isset($_GET['show'])
? $_GET['show']
: null;

$defaultRoute = "?show=show-all-sort&";

function decrese($value)
{
    if ($value <= 1) {
        return 1;
    }
    return $value - 2;
}

function increse($value)
{
    return $value + 2;
}

$searchTitle = isset($_GET['search'])
? $_GET['search']
: null;

// $dataArr = $app->db->getAssArray();


$hits = getGet("hits", 2);
if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
    die("Not valid for hits.");
}


$max = $app->db->getAssMax("id", "users");
$max = ceil($max[0]->max / $hits);


$page = getGet("page", 1);
if (!(is_numeric($page) && $page > 0 && $page <= $max)) {
    die("Not valid for page.");
}


$offset = $hits * ($page - 1);

$dataArr = $app->db->getAssArrayLO("users", $hits, $offset);
// print_r($dataArr);

// $dataArr[0]->name;
$table = "";
$table .= '<table class=adminTable>';
$table .= '<tr class=adminTr>';
$table .= '<th class=adminTh>name' . orderby2("name", $defaultRoute, true) . '</th>';
$table .= '<th class=adminTh>Password' . orderby2("password", $defaultRoute, true) . '</th>';
$table .= '<th class=adminTh>Edit</th>';
$table .= '<th class=adminTh>Delete</th>';
$table .= '</tr>';
$table2 = $table;
$table3 = $table;
foreach ($dataArr as $row) {
    $table .= "<tr class=adminTr>";
    $table .= "<td class=adminTd>{$row->name}</td>";
    $table .= "<td class=adminTd>{$row->password}</td>";
    $table .= "<td class=adminTd><a href=?show=edit&id={$row->id}>Edit</a></td>";
    $table .= "<td class=adminTd><a href=?show=delete&id={$row->id}>Delete</a></td>";
    $table .= "</tr>";
}
$table .= "</table>";






?>

<h1>Admin</h1>
<hr>

<form method="GET">
    <fieldset>
    <legend>Search</legend>
    <p>
        <input type="hidden" name="show" value="search_Title">
        <label>Search On User Name:
            <input type="search" name="search" value=<?=$searchTitle?>>
        </label>
    </p>
    <p>
        <input type="submit" value="Search">
    </p>
</form>

<form method="GET">
    <input type="submit" name="show" value="Show All">
    <input type="hidden" name="page" value=<?=($page)?>>
    <input type="hidden" name="hits" value=<?=($hits)?>>
    <input type="submit" name="show" value="create">
</form>
</fieldset>


<?php
$ItemsPerPageArray = [
    mergeQueryString(["hits" => 2], $defaultRoute),
    mergeQueryString(["hits" => 4], $defaultRoute),
    mergeQueryString(["hits" => 8], $defaultRoute)
];

$ItemsPerPage = <<<EOD
<p>Items per page:
    <a href={$ItemsPerPageArray[0]}>2</a> |
    <a href={$ItemsPerPageArray[1]}>4</a> |
    <a href={$ItemsPerPageArray[2]}>8</a> |
</p>
EOD;

switch ($show) {
    case 'Show All':
        echo $ItemsPerPage;
        echo $table;
        echo "<p> Pages:";
        for ($i = 1; $i <= $max; $i++) {
            echo " | <a href=" . mergeQueryString(["page" => $i], $defaultRoute) . ">" . $i . "</a> |";
        }
        echo "</p>";
        break;
    case 'search_Title':
        if ($app->db->exists($searchTitle)) {
            $result = $app->db->getColum("name", $searchTitle);
            foreach ($result as $row2) {
                $table2 .= "<tr class=adminTr>";
                $table2 .= "<td class=adminTd>{$row2->name}</td>";
                $table2 .= "<td class=adminTd>{$row2->password}</td>";
                $table2 .= "<td class=adminTd><a href=?show=edit&id={$row2->id}>Edit</a></td>";
                $table2 .= "<td class=adminTd><a href=?show=delete&id={$row2->id}>Delete</a></td>";
                $table2 .= "</tr>";
            }
            $table2 .= "</table>";
            echo $table2;
        } else {
            echo "<div class=search_error>search result not found: $searchTitle</div>";
        }
        break;

    case 'edit':
        $id = $_GET["id"];
        if ($app->db->existsId($id)) {
            $id_result = $app->db->getColum("id", $id);
            $edit_url = $app->url->create("edit");
            $editform = "";
            $editform .= '<fieldset>';
            $editform .= "<legend>Edit " . $id_result[0]->name . "</legend>";
            $editform .= "<form action=$edit_url" . ' method="post">';
            $editform .= "<p>Name:<br>" . $id_result[0]->name . "</p>";
            $editform .= '<input type="hidden" name="edit_name" value=' . $id_result[0]->name . '>';
            $editform .= '<p>Password<br><input type="password" name="edit_pass"></p>';
            $editform .= '<p>Re Password<br><input type="password" name="edit_pass_re"></p>';
            $editform .= '<input type="submit" value="Change Password">';
            $editform .= '</form>';
            $editform .= "</fieldset>";

            echo $editform;
        } else {
            echo "<div class=search_error>result not found: $id</div>";
        }
        break;

    case 'create':
        $register = $app->url->create("register");
        header("Location: " . $register);
        break;

    case 'delete':
        $id = $_GET["id"];
        if ($app->db->existsId($id)) {
            $id_result = $app->db->delete("id", $id);
            echo "User removed";
        } else {
            echo "<div class=search_error>result not found: $id</div>";
        }
        break;
    case 'edit done':
        echo "<p> Password successfully edited!</p>";
        break;

    case 'show-all-sort':
        $columns = ["name", "password", "year", "image"];
        $orders = ["asc", "desc"];

        $orderBy = getGet("orderby") ?: "id";
        $order = getGet("order") ?: "asc";

        if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
            die("Not valid input for sorting.");
        }
        // var_dump([$orderBy, $order, $hits, $offset]);
        $dataArr = $app->db->pleaseWork("users", $orderBy, $order, $hits, $offset);
        // $dataArr = $app->db->getAssArrayOrderBy("users", $orderBy, $order);
        foreach ($dataArr as $row) {
            $table3 .= "<tr class=adminTr>";
            $table3 .= "<td class=adminTd>{$row->name}</td>";
            $table3 .= "<td class=adminTd>{$row->password}</td>";
            $table3 .= "<td class=adminTd><a href=?show=edit&id={$row->id}>Edit</a></td>";
            $table3 .= "<td class=adminTd><a href=?show=delete&id={$row->id}>Delete</a></td>";
            $table3 .= "</tr>";
        }
        $table3 .= "</table>";
        echo $ItemsPerPage;
        echo $table3;
        echo "<p> Pages:";
        for ($i = 1; $i <= $max; $i++) {
            echo " | <a href=" . mergeQueryString(["page" => $i], $defaultRoute) . ">" . $i . "</a> |";
        }
        echo "</p>";
        break;

    default:
        break;
}



?>
