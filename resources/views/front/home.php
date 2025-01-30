<?php
if(!session_has('user_profile')):?>
    {{view('front.layouts.header',['title'=>trans('main.home')])}};
<?php else:
          redirect('profile');
?>    
<?php endif; ?>
<?php
$latest_new=db_first("news","order by id desc");
?>
<div class="p-3 p-md-2 mb-1 rounded text-body-emphasis bg-body-secondary">
    <div class="col-lg-6 px-0">
      <h1 class="display-4 fst-italic">{{$latest_new['title']}}</h1>
      <p class="lead my-3">{{$latest_new['description']}}</p>
      <a href="{{ url('news? category_id='.$latest_new['category_id'].'&id='.$latest_new['id']) }}" >
      {{trans('main.readmore')}}</a>
    </div>
  </div>

  <div class="row mb-2">
<?php
$latest_category=db_get("categories","JOIN news on news.category_id = categories.id order by news.id desc limit 2 ","
news.created_at,
news.title,
news.image,
news.description,
categories.name as cat_name
");
?>
    <?php while($row=mysqli_fetch_assoc($latest_category['query'])):?>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
          <h3 class="mb-0">{{$row['cat_name']}}</h3>
          <div class="mb-1 text-body-secondary">{{$row['title']}}</div>
          <p class="card-text mb-auto">{{$row['description']}}</p>
          <a href="{{ url('news? category_id='.$latest_new['category_id'].'&id='.$latest_new['id']) }}" class="icon-link gap-1 icon-link-hover stretched-link">
          {{trans('main.readmore')}}
            <svg class="bi"><use xlink:href="#chevron-right"/></svg>
          </a>
        </div>
        <div class="col-auto d-none d-lg-block">
<?php
if(!empty($row['image'])){
  $img=php_url('storage/files/'.$row['image']);
 
}
elseif(!empty($category['icon'])){
  $img=php_url('storage/files/'.$row['image']);
}else{
  $img=url('assets/images/icon.jpg');
}
?>
          <img src="{{$img}}" class="bd-placeholder-img" style="width:200px;height:250px;"/>
        </div>
      </div>
    </div>
  <?php endwhile;?>
  </div>

  <div class="row g-5">
<?php
$latest_news=db_get("news"," order by updated_at desc limit 3");
?>
    <div class="col-md-4">
        <div>
          <h4 class="fst-italic">{{trans('main.latest_news')}}</h4>
          <?php while($row = mysqli_fetch_assoc($latest_news['query'])):?>
          <ul class="list-unstyled">
            <li>
            <?php              
            if(!empty($row['image'])){
                  $img=php_url('storage/files/'.$row['image']);

            }
           else{
                  $img=url('assets/images/icon.jpg');
            }
            ?>
              <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
               href="{{ url('news? category_id='.$row['category_id'].'&id='.$latest_new['id']) }}">
              <img src="{{$img}}" class="bd-placeholder-img" style="width:50%;height:40%;"/>  
              <!-- <svg class="bd-placeholder-img" width="100%" height="96" xmlns="{{$img}}" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg> -->
                <div class="col-lg-8">
                  <h6 class="mb-0">{{$row['title']}}</h6>
                  <small class="text-body-secondary">{{$row['created_at']}}</small>
                </div>
              </a>
            </li>
          </ul>
          <?php endwhile;?>
        </div>
<?php
$years=db_get("news","GROUP BY YEAR(created_at) ")
?>
        <div class="p-4">
          <h4 class="fst-italic">{{trans('main.archive')}}</h4>        
          <ol class="list-unstyled mb-0">
            <?php while($row=mysqli_fetch_assoc($years['query'])):
               $news_year=date('Y',strtotime($row['created_at']));
              ?>

            <li><a href="{{url('news/archive?year='.$news_year)}}">{{$news_year}}</a></li> 
            <?php endwhile;?>     
          </ol>
        </div>

        <div class="p-4">
          <h4 class="fst-italic">Elsewhere</h4>
          <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>


  {{view('front.layouts.footer')}};