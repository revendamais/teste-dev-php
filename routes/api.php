<?php
$routesApis = glob(__DIR__. "/apis/*.php");
if (is_iterable($routesApis)) {
    foreach ($routesApis as $routes) {
        require $routes;
    }
}
