<?php
view('admin.layouts.header',['title'=>trans('admin.users')]);
$users = db_paginate("users","",4);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2><?php echo  trans('admin.users')  ; ?> </h2>
<a class="btn btn-primary" href="<?php echo  aurl('users/create')  ; ?> "><?php echo  trans('users.create')  ; ?> <i class="fa-solid fa-plus"></i></a>
</div>

<div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col"><?php echo  trans('users.user_type')  ; ?> </th>
              <th scope="col"><?php echo  trans('users.password')  ; ?> </th>
              <th scope="col"><?php echo  trans('users.mobile')  ; ?> </th>
              <th scope="col"><?php echo  trans('users.email')  ; ?> </th>
              <th scope="col"><?php echo  trans('users.name')  ; ?> </th>
              <th scope="col">#</th>
              <th scope="col"><?php echo  trans('admin.action')  ; ?> </th>
            </tr>
          </thead>
          <tbody>
            <?php while($user = mysqli_fetch_assoc($users['query'])): ?>
            <tr>
              <td><?php echo  $user['user_type']  ; ?> </td>
              <td><?php echo  $user['password']  ; ?> </td>
              <td><?php echo  $user['mobile']  ; ?> </td>
              <td><?php echo  $user['email']  ; ?> </td>
              <td><?php echo  $user['name']  ; ?> </td>
              <td><?php echo  $user['id']  ; ?> </td>
              <td>
                <a href="<?php echo  aurl('users/show?id='.$user['id'])  ; ?> "><i class="fa-solid fa-eye"></i></a>
                <a href=" <?php echo aurl('users/edit?id='.$user['id']) ; ?>  "><i class="fa-solid fa-pen-to-square"></i></a>
                <a href=" <?php echo aurl('users/destroy?id='.$user['id']) ; ?>  "><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
  </div>
  <?php echo  $users['render']  ; ?>        
<?php
view('admin.layouts.footer');

?>