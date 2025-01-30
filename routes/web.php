<?php
include base_path('routes/admin.php');

route_get('/','front.home');
route_get('lang','controllers.set_language');
route_post('upload','controllers.upload');
route_get('category','front.categories.category');
route_get('news','front.categories.news');
route_post('add/comment','controllers.front.add_comment');
route_post('submit_registration','controllers.front.add_user');
route_post('submit_login','controllers.front.user_login');
route_get('add/comment','controllers.front.add');
route_get('news/archive','front.archive');
route_get('sign_up','front.sign_up');
route_get('user/sign_out','front.sign_out');
route_get('user/sign_in','front.sign_in');
route_get('profile','front.profile');

