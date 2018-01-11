<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('pages/index.html.twig', array());
})->bind('inicio');

$app->get('/acerca', function () use ($app) {
    return $app['twig']->render('pages/acerca.html.twig', array());
})->bind('acerca');

$app->get('/historia', function () use ($app) {
    return $app['twig']->render('pages/historia.html.twig', array());
})->bind('historia');

$app->get('/mesa-directiva', function () use ($app) {
    return $app['twig']->render('pages/mesa-directiva.html.twig', array());
})->bind('mesa-directiva');

$app->get('/profesores', function () use ($app) {
    return $app['twig']->render('pages/profesores.html.twig', array());
})->bind('profesores');

$app->get('/sesiones', function () use ($app) {
    return $app['twig']->render('pages/sesiones.html.twig', array());
})->bind('sesiones');

$app->get('/regioderma2018', function () use ($app) {
    return $app['twig']->render('pages/regioderma2018.html.twig', array());
})->bind('regioderma2018');

/*
$app->get('/eventos', function () use ($app) {
    return $app['twig']->render('pages/eventos.html.twig', array());
})->bind('eventos');

$app->get('/actividades', function () use ($app) {
    return $app['twig']->render('pages/actividades.html.twig', array());
})->bind('actividades'); */

$app->get('/contacto', function () use ($app) {
    return $app['twig']->render('pages/contacto.html.twig', array());
})->bind('contacto');

/*active items */
$app->before(function ($request) use ($app) {
    $app['twig']->addGlobal('active', $request->get("_route"));
});

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
