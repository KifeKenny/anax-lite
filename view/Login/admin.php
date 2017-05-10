<?php

$dataArr = $app->db->getAssArray();

// var_dump($dataArr);

// echo $dataArr[0]->name;

$table = "";
$table .= '<table class=adminTable>';
$table .= '<tr class=adminTr>';
$table .= '<th class=adminTh>name</th>';
$table .= '<th class=adminTh>password</th>';
$table .= '<th class=adminTh>Edit</th>';
$table .= '<th class=adminTh>Delete</th>';
$table .= '</tr>';
$table2 = $table;
foreach ($dataArr as $row) {
    $table .= "<tr class=adminTr>";
    $table .= "<td class=adminTd>{$row->name}</td>";
    $table .= "<td class=adminTd>{$row->password}</td>";
    $table .= "<td class=adminTd><a href=?show=edit&id={$row->id}>Edit</a></td>";
    $table .= "<td class=adminTd><a href=?show=delete&id={$row->id}>Delete</a></td>";
    $table .= "</tr>";
}
$table .= "</table>";

$show = isset($_GET['show'])
? $_GET['show']
: null;

$searchTitle = isset($_GET['search'])
? $_GET['search']
: null;

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
    <input type="submit" name="show" value="create">

</form>

</fieldset>


<?php


switch ($show) {
    case 'Show All':
        echo $table;
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

    default:
        break;
}



?>
