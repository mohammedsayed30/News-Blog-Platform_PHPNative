<?php
view('admin.layouts.header',['title'=>trans('admin.comments')]);
//this to retrieve a certain data from one table
//$comments = db_paginate("comments","",4);
//this to retrieve a certain data from multiple tables
$comments= db_paginate("comments"," JOIN news on  news.id = comments.news_id" ,4,"asc",
"comments.name,
comments.email,
comments.id,
comments.comment,
comments.status,
comments.news_id,
news.title as title ");
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>{{ trans('admin.comments') }}</h2>
</div>

<div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">{{ trans('comments.comment') }}</th>
              <th scope="col">{{ trans('comments.status') }}</th>
              <th scope="col">{{ trans('comments.email') }}</th>
              <th scope="col">{{ trans('comments.name') }}</th>
              <th scope="col">{{ trans('comments.news_id') }}</th>
              <th scope="col">{{ trans('news.title') }}</th>
              <th scope="col">#</th>
              <th scope="col">{{ trans('admin.action') }}</th>
            </tr>
          </thead>
          <tbody>
            <?php while($comment= mysqli_fetch_assoc($comments['query'])): ?>
            <tr>
              <td>{{ $comment['comment'] }}</td>
              <td>{{ $comment['status'] }}</td>
              <td>{{ $comment['email'] }}</td>
              <td>{{ $comment['name'] }}</td>
              <td>{{ $comment['news_id'] }}</td>
              <td>{{ $comment['title'] }}</td>
              <td>{{ $comment['id'] }}</td>
              <td>
                <a href="{{ aurl('comments/show?id='.$comment['id']) }}"><i class="fa-solid fa-eye"></i></a>
                <a href=" {{aurl('comments/edit?id='.$comment['id'])}} "><i class="fa-solid fa-pen-to-square"></i></a>
                <a href=" {{aurl('comments/destroy?id='.$comment['id'])}} "><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
  </div>
  {{ $comments['render'] }}       


<?php
view('admin.layouts.footer');

?>