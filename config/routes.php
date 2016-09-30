<?php
use Cake\Routing\Router;
Router::plugin('WnkChangedata', function ($routes) {
    $routes->fallbacks('DashedRoute');
});
