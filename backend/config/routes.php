<?php
// routes
$routes = [
	// index
    '/' => [
        'namespace'  	=> 'Single\Controller\Index',
        'namespace_dir' => DIR_CONTROLLERS.'index',
        'controller'	=> 'Index',
        'action'		=> 'index'
    ],
    // blog
    '/blog'  => [
        'namespace'  	=> 'Single\Controller\Blog',
        'namespace_dir' => DIR_CONTROLLERS.'blog',
        'controller'	=> 'Blog',
        'action'		=> 'index'
    ],
    // error 404
    'error404' => [
        'namespace'  	=> 'Single\Controller\Index',
        'namespace_dir' => DIR_CONTROLLERS.'index',
        'controller'	=> 'Index',
        'action'		=> 'error404'
    ],

];