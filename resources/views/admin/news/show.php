<?php
view('admin.layouts.header',['title'=>trans('admin.news').'-'.trans('admin.show')]);
//this to retrieve a certain data from multiple tables
$news= db_first('news',"JOIN categories on categories.id = news.category_id 
JOIN users on users.id = news.user_id where news.id =".request('id'),
"news.title,
news.content,
news.description,
news.category_id,
news.user_id,
news.created_at,
news.updated_at,
news.id,
news.image,
users.name as username,
categories.name as category_name");

redirect_if(empty($news),aurl('news'));
?>



<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>{{ trans('admin.news') }} - #{{$news['title']}}{{ trans('admin.show') }} </h2>
<a class="btn btn-info" href="{{ aurl('news') }}">{{ trans('admin.news') }}</a>
</div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="title">{{ trans('news.title') }}</label>
                {{$news['title']}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">{{ trans('news.image') }}</label>
                {{ image(storage_url($news['image'])) }}
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{ trans('news.description') }}</label>
                {{$news['description']}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="category_id">{{ trans('news.category_id') }}</label>
                <a href="{{ aurl('categories/show?id='.$news['category_id']) }}">{{ $news['category_name'] }}</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="content">{{ trans('news.content') }}</label>
                {{$news['content']}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="user_id">{{ trans('news.user_id') }}</label>
                <a href="{{ aurl('users/show?id='.$news['user_id']) }}">{{ $news['username'] }}</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="created_at">{{ trans('news.created_at') }}</label>
                {{$news['created_at']}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="updated_at">{{ trans('news.updated_at') }}</label>
                {{$news['updated_at']}}
            </div>
        </div>
    </div>


<?php

?> 
<?php
view('admin.layouts.footer');

?>