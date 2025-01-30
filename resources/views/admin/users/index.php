<?php
view('admin.layouts.header',['title'=>trans('admin.users')]);
$users = db_paginate("users","",4);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>{{ trans('admin.users') }}</h2>
<a class="btn btn-primary" href="{{ aurl('users/create') }}">{{ trans('users.create') }}<i class="fa-solid fa-plus"></i></a>
</div>

<div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">{{ trans('users.user_type') }}</th>
              <th scope="col">{{ trans('users.password') }}</th>
              <th scope="col">{{ trans('users.mobile') }}</th>
              <th scope="col">{{ trans('users.email') }}</th>
              <th scope="col">{{ trans('users.name') }}</th>
              <th scope="col">#</th>
              <th scope="col">{{ trans('admin.action') }}</th>
            </tr>
          </thead>
          <tbody>
            <?php while($user = mysqli_fetch_assoc($users['query'])): ?>
            <tr>
              <td>{{ $user['user_type'] }}</td>
              <td>{{ $user['password'] }}</td>
              <td>{{ $user['mobile'] }}</td>
              <td>{{ $user['email'] }}</td>
              <td>{{ $user['name'] }}</td>
              <td>{{ $user['id'] }}</td>
              <td>
                <a href="{{ aurl('users/show?id='.$user['id']) }}"><i class="fa-solid fa-eye"></i></a>
                <a href=" {{aurl('users/edit?id='.$user['id'])}} "><i class="fa-solid fa-pen-to-square"></i></a>
                <a href=" {{aurl('users/destroy?id='.$user['id'])}} "><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
  </div>
  {{ $users['render'] }}       
<?php
view('admin.layouts.footer');

?>