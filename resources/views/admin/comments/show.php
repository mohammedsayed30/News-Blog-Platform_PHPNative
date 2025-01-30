<?php
view('admin.layouts.header',['title'=>trans('admin.comments').'-'.trans('admin.show')]);
//$comment= db_find('comments',request('id'));

$comment= db_first("comments","JOIN news on news.id = comments.news_id" ,
"comments.name,
comments.email,
comments.comment,
comments.status,
comments.news_id,
news.title as title
");


redirect_if(empty($comment),aurl('comments'));
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>{{ trans('admin.comments') }} - #{{$comment['name']}}{{ trans('admin.show') }} </h2>
<a class="btn btn-info" href="{{ aurl('comments') }}">{{ trans('admin.comments') }}</a>
</div>
    <div class="row">
        <!-- name information -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{ trans('comments.name') }}</label>
                {{$comment['name']}}
            </div>
        </div>
       <!-- email information -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="email">{{ trans('comments.email') }}</label>
                {{$comment['email']}}
            </div>
        </div>
        <!-- comments_id information -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="comments_id">{{ trans('news.title') }}</label>
                {{$comment['title']}}
            </div>
        </div>
        <!-- status information -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="status">{{ trans('comments.status') }}</label>
                {{$comment['status']}}
            </div>
        </div>
       <!-- comment information -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="comment">{{ trans('comments.comment') }}</label>
                {{$comment['comment']}}
            </div>
        </div>
               <!-- comment id information -->
               <div class="col-md-12">
            <div class="form-group">
                <label for="comment">{{ trans('comments.news_id') }}</label>
                {{$comment['news_id']}}
            </div>
        </div>


    </div>



<?php
view('admin.layouts.footer');

?>