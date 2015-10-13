<?php

// Register route converters.
// Each converter needs to check if the $id it received is actually a value,
// as a workaround for https://github.com/silexphp/Silex/pull/768.
/*$app['controllers']->convert('artist', function ($id) use ($app) {
    if ($id) {
        return $app['repository.artist']->find($id);
    }
});
$app['controllers']->convert('comment', function ($id) use ($app) {
    if ($id) {
        return $app['repository.comment']->find($id);
    }
});
$app['controllers']->convert('user', function ($id) use ($app) {
    if ($id) {
        return $app['repository.user']->find($id);
    }
});*/

// Register routes.
$app->get('/', 'MusicBox\Controller\IndexController::indexAction')
    ->bind('homepage');
    
$app->get('/delete/{id}', 'MusicBox\Controller\IndexController::deleteAction')
    ->bind('delete');  
    
$app->match('/addUser', 'MusicBox\Controller\IndexController::addUserAction')
    ->bind('addUser');     
    
$app->match('/updateUser/{id}', 'MusicBox\Controller\IndexController::updateUserAction')
    ->bind('update');  

$app->match('/login', 'MusicBox\Controller\IndexController::loginAction')
    ->bind('login');      
          
   


