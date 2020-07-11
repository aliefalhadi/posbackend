<?php

$router->group(
    ['prefix' => 'api/v1'],
    function () use ($router) {


        $router->post('auth/register', 'AuthController@register');

        $router->post(
            'auth/login',
            [
                'uses' => 'AuthController@authenticate'
            ]
        );
    }
);

$router->group(
    ['prefix' => 'api/v1', 'middleware' => 'jwt.auth'],
    function () use ($router) {
        $router->get('kategori/index', 'KategoriController@index');
        $router->get('kategori/{id}/show', 'KategoriController@show');
        $router->put('kategori/{id}/update', 'KategoriController@update');
        $router->delete('kategori/{id}/delete', 'KategoriController@destroy');
        $router->post('kategori/create', 'KategoriController@store');
        $router->get('users', function () {
            $users = \App\User::all();
            return response()->json($users);
        });
    }
);
