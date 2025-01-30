
<?php
view('admin.layouts.header',['title'=>trans('admin.comments').'-'.trans('admin.edit')]);
$comment= db_find('comments',request('id'));

redirect_if(empty($comment),aurl('comments'));
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2><?php echo  trans('admin.comments')  ; ?>  - <?php echo  trans('admin.edit')  ; ?> </h2>
<a class="btn btn-info" href="<?php echo  aurl('comments')  ; ?> "><?php echo  trans('admin.comments')  ; ?> </a>
</div>
 
<form method="post" action="<?php echo aurl('comments/edit?id='.$comment['id']) ; ?> " enctype="multipart/form-data">
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="news_id" value="<?php echo $comment['news_id'] ; ?> ">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name"><?php echo  trans('comments.name')  ; ?> </label>
                <input type="text" name="name" placeholder="<?php echo  trans('comments.name')  ; ?> " class="form-control <?php echo  !empty(get_error('name'))?'is-invalid':''  ; ?>  " value="<?php echo  $comment['name']  ; ?> "/>
            </div>
        </div>
        <!-- <div class="col-md-6">
            <div class="form-group">
                <label for="news_id"><?php echo  trans('comments.news_id')  ; ?> </label>
                 <a href="<?php echo aurl('news/show?id='.$comment['news_id']) ; ?> "><?php echo $comment['news_id'] ; ?> </a>            
            </div>
        </div> -->

        <div class="col-md-6">
            <div class="form-group">
                <label for="status"><?php echo  trans('comments.status')  ; ?> </label>
                <select name="status" class="form-select <?php echo  !empty(get_error('status'))?'is-invalid':''  ; ?>  ">
                    <option value="hide" <?php echo  $comment['status'] =='hide'?'selected':''  ; ?> ><?php echo trans('comments.hide') ; ?> </option>
                    <option value="show" <?php echo  $comment['status'] =='show'?'selected':''   ; ?> ><?php echo trans('comments.show') ; ?> </option>
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="email"><?php echo  trans('comments.email')  ; ?> </label>
                <textarea name="email" placeholder="<?php echo trans('comments.email') ; ?> " 
                class="form-control <?php echo  !empty(get_error('email'))?'is-invalid':''  ; ?>  "><?php echo  $comment['email']  ; ?> </textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="comment"><?php echo  trans('comments.comment')  ; ?> </label>
                <textarea name="comment" placeholder="<?php echo trans('comments.comment') ; ?> " 
                class="form-control <?php echo  !empty(get_error('comment'))?'is-invalid':''  ; ?>  "><?php echo  $comment['comment']  ; ?> </textarea>
            </div>
        </div>



    </div>
    <input type="submit" class="btn btn-success" value="<?php echo  trans('admin.save')  ; ?> ">
</form>
<?php
view('admin.layouts.footer');

?>