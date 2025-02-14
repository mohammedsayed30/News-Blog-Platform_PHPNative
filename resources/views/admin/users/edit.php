
<?php
view('admin.layouts.header',['title'=>trans('admin.users').'-'.trans('admin.edit')]);
$user= db_find('users',request('id'));

redirect_if(empty($user),aurl('users'));
?>




<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>{{ trans('admin.users') }} - {{ trans('admin.edit') }}</h2>
<a class="btn btn-info" href="{{ aurl('users') }}">{{ trans('admin.users') }}</a>
</div>


<?php 
   $name = get_error('name');
   $password = get_error('password');
   $email = get_error('email');
   $mobile = get_error('mobile');
   $user_type = get_error('user_type');

?> 
<form method="post" action="{{aurl('users/edit?id='.$user['id'])}}" enctype="multipart/form-data">
<input type="hidden" name="_method" value="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{ trans('users.name') }}</label>
                <input type="text" name="name" placeholder="{{ trans('users.name') }}" class="form-control {{ !empty($name)?'is-invalid':'' }} " value="{{$user['name']}}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="password">{{ trans('users.password') }}</label>
                <input type="text" name="password" placeholder="{{trans('users.password')}}" class="form-control {{ !empty($password)?'is-invalid':'' }} " />
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="email">{{ trans('users.email') }}</label>
                <input type="text" name="email" placeholder="{{trans('users.email')}}" class="form-control {{ !empty($email)?'is-invalid':'' }}" value="{{$user['email']}}" />
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="mobile">{{trans('users.mobile')}}</label>
                <input type="text" name="mobile" placeholder="{{trans('users.mobile')}}" class="form-control {{ !empty($mobile)?'is-invalid':'' }}" value="{{$user['mobile']}}" />
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="user_type">{{ trans('users.user_type') }}</label>
                <select class="form-select {{ !empty($user_type)?'is-invalid':'' }}" name="user_type">
                    <option value="user" {{ $user['user_type'] == 'user'?'selected':'' }}>{{trans('users.user')}}</option>
                    <option value="admin" {{ $user['user_type'] == 'admin'?'selected':'' }}>{{trans('users.admin')}}</option>
                </select>
            </div>
        </div>
    </div>

    <input type="submit" class="btn btn-success" value="{{ trans('admin.save') }}">

</form>

<?php
view('admin.layouts.footer');

?>