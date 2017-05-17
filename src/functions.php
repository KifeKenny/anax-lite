<?php

/**
 * Function to create links for sorting.
 *
 * @param string $column the name of the database column to sort by
 * @param string $route  prepend this to the anchor href
 *
 * @return string with links to order by column.
 */
function orderby($column, $route)
{
    return <<<EOD
<span class='orderby'>
<a href="{$route}orderby={$column}&order=asc">&darr;</a>
<a href="{$route}orderby={$column}&order=desc">&uarr;</a>
</span>
EOD;
}

function hasKeyPost($key)
{
    return array_key_exists($key, $_POST);
}

function esc($value)
{
    return htmlentities($value);
}

function getGet($key, $default = null)
{
    return isset($_GET[$key])
        ? $_GET[$key]
        : $default;
}

function getPost($key, $default = null)
{
    if (is_array($key)) {
        foreach ($key as $val) {
            $post[$val] = getPost($val);
        }
        return $post;
    }
    return isset($_POST[$key])
        ? $_POST[$key]
        : $default;
}

/**
 * Use current querystring as base, extract it to an array, merge it
 * with incoming $options and recreate the querystring using the resulting
 * array.
 *
 * @param array  $options to merge into exitins querystring
 * @param string $prepend to the resulting query string
 *
 * @return string as an url with the updated query string.
 */
function mergeQueryString($options, $prepend = "?", $bol = false)
{
    // Parse querystring into array
    $query = [];
    parse_str($_SERVER["QUERY_STRING"], $query);

    // Merge query string with new options
    $query = array_merge($query, $options);

    if ($bol) {
        $query["show"] = "show-all-sort";
    }
    // Build and return the modified querystring as url
    return $prepend . http_build_query($query);
}

/**
 * Function to create links for sorting and keeping the original querystring.
 *
 * @param string $column the name of the database column to sort by
 * @param string $route  prepend this to the anchor href
 *
 * @return string with links to order by column.
 */
function orderby2($column, $route, $bol = false)
{
    // var_dump($route);
    // var_dump($column);
    $asc = mergeQueryString(["orderby" => $column, "order" => "asc"], $route, $bol);
    $desc = mergeQueryString(["orderby" => $column, "order" => "desc"], $route, $bol);

    return <<<EOD
<span class="orderby">
<a href="$asc">&darr;</a>
<a href="$desc">&uarr;</a>
</span>
EOD;
}
