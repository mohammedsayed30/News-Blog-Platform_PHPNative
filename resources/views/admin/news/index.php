<?php
view('admin.layouts.header',['title'=>trans('admin.news')]);
$news_list = db_paginate("news","JOIN categories on categories.id = news.category_id 
JOIN users on users.id = news.user_id",12,"asc","
news.title,
news.content,
news.description,
news.category_id,
news.user_id,
news.created_at,
news.updated_at,
news.id,
news.image,
users.name as username,
categories.name as category_name
");
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>{{ trans('admin.news') }}</h2>
<a class="btn btn-primary" href="{{ aurl('news/create') }}">{{ trans('news.create') }}<i class="fa-solid fa-plus"></i></a>
</div>

<div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">{{ trans('admin.action') }}</th>
              <th scope="col">{{ trans('admin.updated_at') }}</th>
              <th scope="col">{{ trans('admin.created_at') }}</th>
              <th scope="col">{{ trans('news.description') }}</th>
              <th scope="col">{{ trans('news.content') }}</th>
              <th scope="col">{{ trans('news.image') }}</th>
              <th scope="col">{{ trans('news.category_id') }}</th>
              <th scope="col">{{ trans('news.user_id') }}</th>
              <th scope="col">{{ trans('news.title') }}</th>
              <th scope="col">#</th>
              
            </tr>
          </thead>
          <tbody>
            <?php while($news = mysqli_fetch_assoc($news_list['query'])): ?>
            <tr>
            <td>
                <a href="{{ aurl('news/show?id='.$news['id']) }}"><i class="fa-solid fa-eye"></i></a>
                <a href=" {{aurl('news/edit?id='.$news['id'])}} "><i class="fa-solid fa-pen-to-square"></i></a>
                <a href=" {{aurl('news/destroy?id='.$news['id'])}} "><i class="fa-solid fa-trash"></i></a>
              </td>
              <td>{{ $news['updated_at'] }}</td>
              <td>{{ $news['created_at'] }}</td>
              <td>{{ $news['description'] }}</td>
              <td>{{ $news['content'] }}</td>
              <td>
              {{ image(storage_url($news['image'])) }}
              </td>
              <td>
                <a href="{{ aurl('categories/show?id='.$news['category_id']) }}">{{ $news['category_name'] }}</a>
              <td>
                <a href="{{ aurl('users/show?id='.$news['user_id']) }}">{{ $news['username'] }}</a>
              </td>
              <td>{{ $news['title'] }}</td>
              <td>{{ $news['id'] }}</td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
  </div>
  {{ $news_list['render'] }}       

<?php
view('admin.layouts.footer');

?>

