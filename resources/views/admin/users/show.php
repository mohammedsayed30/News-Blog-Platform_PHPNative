<?php
view('admin.layouts.header',['title'=>trans('admin.users').'-'.trans('admin.show')]);
$user= db_find('users',request('id'));

redirect_if(empty($user),aurl('users'));
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>{{ trans('admin.users') }} - #{{$user['name']}}{{ trans('admin.show') }} </h2>
<a class="btn btn-info" href="{{ aurl('users') }}">{{ trans('admin.users') }}</a>
</div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{ trans('users.name') }}</label>
                {{$user['name']}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="icon">{{ trans('users.password') }}</label>
                {{$user['password']}}
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{ trans('users.email') }}</label>
                {{$user['email']}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{ trans('users.mobile') }}</label>
                {{$user['mobile']}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{ trans('users.user_type') }}</label>
                {{ trans('users.'.$user['user_type']) }}
            </div>
        </div>
    </div>
<?php
view('admin.layouts.footer');

?>