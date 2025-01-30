
<?php
view('admin.layouts.header',['title'=>trans('admin.comments').'-'.trans('admin.edit')]);
$comment= db_find('comments',request('id'));

redirect_if(empty($comment),aurl('comments'));
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>{{ trans('admin.comments') }} - {{ trans('admin.edit') }}</h2>
<a class="btn btn-info" href="{{ aurl('comments') }}">{{ trans('admin.comments') }}</a>
</div>
 
<form method="post" action="{{aurl('comments/edit?id='.$comment['id'])}}" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="news_id" value="{{$comment['news_id']}}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{ trans('comments.name') }}</label>
                <input type="text" name="name" placeholder="{{ trans('comments.name') }}" class="form-control {{ !empty(get_error('name'))?'is-invalid':'' }} " value="{{ $comment['name'] }}"/>
            </div>
        </div>
        <!-- <div class="col-md-6">
            <div class="form-group">
                <label for="news_id">{{ trans('comments.news_id') }}</label>
                 <a href="{{aurl('news/show?id='.$comment['news_id'])}}">{{$comment['news_id']}}</a>            
            </div>
        </div> -->

        <div class="col-md-6">
            <div class="form-group">
                <label for="status">{{ trans('comments.status') }}</label>
                <select name="status" class="form-select {{ !empty(get_error('status'))?'is-invalid':'' }} ">
                    <option value="hide" {{ $comment['status'] =='hide'?'selected':'' }}>{{trans('comments.hide')}}</option>
                    <option value="show" {{ $comment['status'] =='show'?'selected':''  }}>{{trans('comments.show')}}</option>
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="email">{{ trans('comments.email') }}</label>
                <textarea name="email" placeholder="{{trans('comments.email')}}" 
                class="form-control {{ !empty(get_error('email'))?'is-invalid':'' }} ">{{ $comment['email'] }}</textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="comment">{{ trans('comments.comment') }}</label>
                <textarea name="comment" placeholder="{{trans('comments.comment')}}" 
                class="form-control {{ !empty(get_error('comment'))?'is-invalid':'' }} ">{{ $comment['comment'] }}</textarea>
            </div>
        </div>



    </div>
    <input type="submit" class="btn btn-success" value="{{ trans('admin.save') }}">
</form>
<?php
view('admin.layouts.footer');

?>