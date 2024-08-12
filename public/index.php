<?php
//require_once 'config/functions.php';
//require base_path('vendor/
require "../config/functions.php";
require '../vendor/autoload.php';

use App\Controller\Auth\RegisterUserController;
use App\Routes;

$routes = new Routes();

$routes->get('', [RegisterUserController::class, 'index']);
$routes->post('/register', [RegisterUserController::class, 'store']);

$routes->get('/login', [\App\Controller\Auth\AuthenticateUserController::class, 'index']);
$routes->post('/login', [\App\Controller\Auth\AuthenticateUserController::class, 'store']);
$routes->post('/logout', [\App\Controller\Auth\AuthenticateUserController::class, 'destroy']);


$routes->get('/home/feed', [\App\Controller\Posts\BlogPostsController::class, 'index']);
$routes->get('/home/feed/create', [\App\Controller\Posts\BlogPostsController::class, 'index']);
$routes->post('/home/feed/create', [\App\Controller\Posts\BlogPostsController::class, 'store']);
$routes->get('/home/feed/show', [\App\Controller\Posts\BlogPostsController::class, 'show']);
$routes->get('/home/feed/edit', [\App\Controller\Posts\BlogPostsController::class, 'edit']);
$routes->post('/home/feed/update', [\App\Controller\Posts\BlogPostsController::class, 'update']);
$routes->post('/home/feed/delete', [\App\Controller\Posts\BlogPostsController::class, 'destroy']);


$routes->post('/home/comment/create', [\App\Controller\Comments\CommentController::class, 'store']);
$routes->post('/comment/delete', [\App\Controller\Comments\CommentController::class, 'destroy']);


$routes->get('/profile', [\App\Controller\Profile\UserProfile::class, 'index']);
$routes->get('/profile/update', [\App\Controller\Profile\UserProfile::class, 'edit']);
$routes->post('/profile/update', [\App\Controller\Profile\UserProfile::class, 'update']);
$routes->post('/password/reset', [\App\Controller\Profile\UserProfile::class, 'resetPassword']);
$routes->get('/reset', [\App\Controller\Profile\UserProfile::class, 'reset']);
$routes->post('/verify/otp', [\App\Controller\Profile\UserProfile::class, 'verify']);
$routes->get('/reset/password', [\App\Controller\Profile\UserProfile::class, 'passwordReset']);
$routes->post('/reset/password', [\App\Controller\Profile\UserProfile::class, 'passwordResets']);
$routes->get('/guest/reset', [\App\Controller\Profile\UserProfile::class, 'guestPassword']);



$routes->post('/likes', [\App\Controller\Likes\LikesController::class, 'store']);


$routes->post('/search/posts', [\App\Controller\Posts\BlogPostsController::class, 'search']);

$routes->resolve();