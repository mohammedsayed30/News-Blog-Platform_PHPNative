<?php
view('admin.layouts.header',['title'=>trans('admin.categories').'-'.trans('admin.show')]);
$categore= db_find('categories',request('id'));

redirect_if(empty($categore),aurl('categories'));
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2>{{ trans('admin.categories') }} - #{{$categore['name']}}{{ trans('admin.show') }} </h2>
<a class="btn btn-info" href="{{ aurl('categories') }}">{{ trans('admin.categories') }}</a>
</div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{ trans('cat.name') }}</label>
                {{$categore['name']}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="icon">{{ trans('cat.icon') }}</label>
    <?php //$categore['icon']---> categories/name of the icon//?>
                {{ image(storage_url($categore['icon'])) }}
                <!-- Button trigger modal -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">{{ trans('cat.desc') }}</label>
                {{$categore['description']}}
            </div>
        </div>
    </div>



<?php
view('admin.layouts.footer');

?>