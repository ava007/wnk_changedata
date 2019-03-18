
<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
Router::plugin('WnkChangedata', 
   ['path' => '/wnk-changedata'],
   function (RouteBuilder $routes) {
     $routes->fallbacks(DashedRoute::class);
   }
);
