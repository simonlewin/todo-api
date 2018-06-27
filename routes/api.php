<?php

$router->group(["prefix" => "tasks"], function ($router) {
    $router->post("", "Tasks@store");
    $router->get("", "Tasks@index");
    $router->delete("{task}", "Tasks@destroy");
    $router->put("{task}", "Tasks@update");
    $router->patch("{task}/complete", "Tasks@complete");
});
