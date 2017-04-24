<h1>Session Routes</h1>
<hr>

<?php

$navbar = [
    "config" => [
        "navbar-class" => "mainSession"
    ],
    "items" => [
        "increment" => [
            "text" => "Increment",
            "route" => "session/increment",
            "aclass" => "no",
        ],
        "decrement" => [
            "text" => "decrement",
            "route" => "session/decrement",
            "aclass" => "no",
        ],
        "status" => [
            "text" => "Status",
            "route" => "session/status",
            "aclass" => "no",
        ],

        "dump" => [
            "text" => "Dump",
            "route" => "session/dump",
            "aclass" => "no",
        ],

        "destroy" => [
            "text" => "Destroy",
            "route" => "session/destroy",
            "aclass" => "no",
        ],
    ]
];

//Echo out the current value
echo "<h4> Current value: " . $app->session->get("value") . "</h4>";

foreach ($navbar as $key => $value) {
    if ($key == "config") {
        echo '<div class=' . $value["navbar-class"] . '>';
    }


    if ($key == "items") {
        foreach ($value as $key1 => $navinfo) {
            $url = $app->url->create($navinfo["route"]);
            echo '<a class=' . $navinfo["aclass"] . ' href=' . "$url>" . $navinfo["text"] . "</a>" . "<br>";
        }
    }
}

?>
    </main>
</body>
