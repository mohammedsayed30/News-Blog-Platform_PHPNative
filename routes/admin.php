<?php

/**
 * route_get(ADMIN.'/login','admin.login');
 * this mean if the user write /login it will redirected to admin/login 
 * and the same princple of the rest of them
 * this function used to redirect  the user to the path of  view folder + 
 * the path on the second parameter of the route_get or post_get function 
 */
define('ADMIN','admin');

route_get(ADMIN,'admin.index');
route_get(ADMIN.'/lang','controllers.admin.set_lang');

//Admin Authenticatiion
route_get(ADMIN.'/login','admin.login');
route_get(ADMIN.'/logout','controllers.admin.logout');
route_post(ADMIN.'/do/login','controllers.admin.login');
//categories GRUD operations
route_get(ADMIN.'/categories','admin.categories.index');
route_get(ADMIN.'/categories/create','admin.categories.create');
route_post(ADMIN.'/categories/create','controllers.admin.categories.create');
route_get(ADMIN.'/categories/show','admin.categories.show');
route_get(ADMIN.'/categories/destroy','admin.categories.destroy');
route_get(ADMIN.'/categories/deleted_messages','admin.categories.deleted_messages');
route_get(ADMIN.'/categories/edit','admin.categories.edit');
route_post(ADMIN.'/categories/edit','controllers.admin.categories.update');
//comments GRUD operations
route_get(ADMIN.'/comments','admin.comments.index');
route_get(ADMIN.'/comments/show','admin.comments.show');
route_get(ADMIN.'/comments/destroy','admin.comments.destroy');
route_get(ADMIN.'/comments/edit','admin.comments.edit');
route_post(ADMIN.'/comments/edit','controllers.admin.comments.update');
//news GRUD operations
route_get(ADMIN.'/news','admin.news.index');
route_get(ADMIN.'/news/create','admin.news.create');
route_post(ADMIN.'/news/create','controllers.admin.news.create');
route_get(ADMIN.'/news/show','admin.news.show');
route_get(ADMIN.'/news/destroy','admin.news.destroy');
route_get(ADMIN.'/news/deleted_messages','admin.news.deleted_messages');
route_get(ADMIN.'/news/edit','admin.news.edit');
route_post(ADMIN.'/news/edit','controllers.admin.news.update');

//users GRUD operations
route_get(ADMIN.'/users','admin.users.index');
route_get(ADMIN.'/users/create','admin.users.create');
route_post(ADMIN.'/users/create','controllers.admin.users.create');
route_get(ADMIN.'/users/show','admin.users.show');
route_get(ADMIN.'/users/destroy','admin.users.destroy');
route_get(ADMIN.'/users/deleted_messages','admin.users.deleted_messages');
route_get(ADMIN.'/users/edit','admin.users.edit');
route_post(ADMIN.'/users/edit','controllers.admin.users.update');
?>