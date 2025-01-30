<?php
$news = db_first("news","JOIN categories on categories.id = news.category_id 
JOIN users on users.id = news.user_id where news.id='".request('id')."'",
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
redirect_if(empty($news),url('/'));
?>
{{view('front.layouts.header',['title'=>$news['title']])}};
<div class="row mb-2">
<div class="col-md-12">
<article class="blog-post">
        <h2 class="display-5 link-body-emphasis mb-1">Sample blog post</h2>
        <p class="blog-post-meta">{{$news['created_at']}} <span>{{$news['username']}}</span></p>
       <hr>
       <?php
if(!empty($news['image'])){
  $img=url('storage/'.$news['image']);
}
else{
  $img=url('assets/images/icon.jpg');
}
?> 
      <img src="$img" class="bd-placeholder-img" style="width:20%;height:100%;"  class="rounded-circle mr-2" />
       <p class="blog-post-meta">{{$news['content']}} </p>
</article>
<hr/>
<div class="col-md-12">
{{view('front.categories.comments')}}
</div>
</div>
</div>
{{view('front.layouts.footer')}}