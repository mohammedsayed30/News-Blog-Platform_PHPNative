
<?php
view('admin.layouts.header',['title'=>trans('admin.news').'-'.trans('admin.edit')]);
//to use this to get the inforamtion for each  field of the required 
$news= db_find('news',request('id'));

redirect_if(empty($news),aurl('news'));
$categories=db_get('categories','');//to use for the category_id field
?>




<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>{{ trans('admin.news') }} - {{ trans('news.create') }}</h2>
<a class="btn btn-info" href="{{ aurl('news') }}">{{ trans('admin.news') }}</a>
</div>

<form method="post" action="{{aurl('news/edit?id='.$news['id'])}}" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title">{{ trans('news.title') }}</label>
                <input type="text" id="title" name="title" placeholder="{{ trans('news.title') }}" class="form-control {{ !empty(get_error('title'))?'is-invalid':'' }} " value="{{$news['title']}}"/>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="category_id">{{ trans('news.category_id') }}</label>
                <select class="form-select {{ !empty( get_error('category_id'))?'is-invalid':'' }}" name="category_id">
                    <option disabled selected>{{trans('admin.choose')}}</option>
                    <?php while($category = mysqli_fetch_assoc($categories['query'])): ?>
                      <option {{ $news['category_id'] == $category['id']?'selected':'' }} value="{{$category['id']}}">{{$category['name']}}</option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">{{ trans('news.image') }}</label>
                <input type="file" id="image" name="image" placeholder="{{trans('news.image')}}" class="form-control {{ !empty(get_error('image'))?'is-invalid':'' }} " />
                {{ image(storage_url($news['image'])) }}
            </div>
        </div>        
        <div class="col-md-12">
            <div class="form-group">
                <label for="content">{{ trans('news.content') }}</label>
                <input type="content" id="content" name="content" placeholder="{{trans('news.content')}}" class="form-control {{ !empty(get_error('content'))?'is-invalid':'' }} " value="{{ $news['content'] }}"/>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{ trans('news.description') }}</label>
                <textarea name="description" id="description" placeholder="{{trans('news.description')}}" class="form-control {{ !empty(get_error('description'))?'is-invalid':'' }} ">{{ $news['description'] }}</textarea>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-success" value="{{ trans('admin.save') }}">
</form>


<!-- <script>
    ClassicEditor
    .create(document.querySelector('#content'),{
        language: '{{session_has("locale")?session("locale"):"en"}}'
    })
    .catch(error=> {
        console.error(error);
    });
</script> -->
<?php
view('admin.layouts.footer');

?>