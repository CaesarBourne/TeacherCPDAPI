<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->options(
    '/{any:.*}',  
        function (){ 
            return response(['status' => 'success']); 
        }
);

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/info',function(){
    echo phpinfo();
});

$router->group(['middleware' => 'auth:api','prefix' => 'api/v1'], function() use ($router){

    $router->get('/users/count','UsersController@getUserCount');

});


$router->group(['middleware' => 'auth:api','prefix' => 'api/v1'], function() use ($router){

    $router->get('course', 'CourseController@getAll');
    $router->get('course/topics/{course_id:[0-9]+}', 'TopicController@getAll');
    $router->get('course/{id:[0-9]+}', 'CourseController@get');
    $router->post('course','CourseController@create');
    $router->delete('course/{id:[0-9]+}', 'CourseController@delete');
    $router->put('course/{id:[0-9]+}', 'CourseController@update');
    $router->get('course/count', 'CourseController@getCourseCount');

    $router->get('assessment', 'AssessmentController@getAll');
    $router->get('assessment/count', 'AssessmentController@getAssessmentCount');
    $router->get('assessment/{id:[0-9]+}', 'AssessmentController@get');
    $router->post('assessment','AssessmentController@create');
    $router->delete('assessment/{id:[0-9]+}', 'AssessmentController@delete');
    $router->put('assessment/{id:[0-9]+}', 'AssessmentController@update');
    $router->get('assessment/{id:[0-9]+}/questions', 'QuestionController@getAll');

    $router->group(['prefix' => 'assessment/{assessment_id:[0-9]+}'],function() use($router){

        $router->get('question/{id:[0-9]+}', 'QuestionController@get');
        $router->post('question','QuestionController@create');
        $router->delete('question/{id:[0-9]+}', 'QuestionController@delete');
        $router->put('question/{id:[0-9]+}', 'QuestionController@update');
    });


    $router->group(['prefix' => 'course/{course_id:[0-9]+}'],function() use($router){

        $router->get('topic/{id:[0-9]+}', 'TopicController@get');
        $router->post('topic','TopicController@create');
        $router->delete('topic/{id:[0-9]+}', 'TopicController@delete');
        $router->put('topic/{id:[0-9]+}', 'TopicController@update');
    });

    $router->group(['prefix' => 'course'],function() use($router){
        $router->get('category', 'CategoryController@getAll');
        $router->get('category/{id:[0-9]+}', 'CategoryController@get');
        $router->post('category','CategoryController@create');
        $router->delete('category/{id:[0-9]+}', 'CategoryController@delete');
        $router->put('category/{id:[0-9]+}', 'CategoryController@update');
    });

});