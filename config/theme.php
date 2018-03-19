<?php
return [
    "file" => "layout/default",
    "basepath" => $c->request->getUri()->getBasePath() . "/",

    "navBars" => [
        "Home" => [
            "href" => "home",
            "icon" => "glyphicon-home",
            "dropdown" => false,
            "seenBy" => "all"
        ],
        "Advanced Search" => [
            "href" => "search",
            "icon" => "glyphicon-fast-food",
            "dropdown" => false,
            "seenBy" => "all"
        ],
        "About" => [
            "href" => "about",
            "icon" => "glyphicon-info-sign",
            "dropdown" => false,
            "seenBy" => "all"
        ]

    ]
];
