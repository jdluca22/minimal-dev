<?php

use Controller\BlogController;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// 06 simple routing
$request = $_SERVER['REQUEST_URI'];
$main = new \Controller\MainController();
$main->route($request);


//// routing with symfony
//// ::class		returns fully qualified classname
//$route = new Route('/blog/{slug}', ['_controller' => BlogController::class]);
//$routes = new RouteCollection();
//$routes->add('blog_show', $route);
//
//$context = new RequestContext();
//
//// Routing can match routes with incoming requests
//$matcher = new UrlMatcher($routes, $context);
//$parameters = $matcher->match('/blog/lorem-ipsum');
//
//// $parameters = [
////     '_controller' => 'App\Controller\BlogController',
////     'slug' => 'lorem-ipsum',
////     '_route' => 'blog_show'
//// ]
//
//// Routing can also generate URLs for a given route
////$generator = new UrlGenerator($routes, $context);
////$url = $generator->generate('blog_show', [
////	'slug' => 'my-blog-post',
////	]);
//
