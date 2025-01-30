<?php
view('admin.layouts.header',['title'=>trans('admin.comments').'-'.trans('admin.show')]);
//$comment= db_find('comments',request('id'));

$comment= db_first("comments","JOIN news on news.id = comments.news_id" ,
"comments.name,
comments.email,
comments.comment,
comments.status,
comments.news_id,
news.title as title
");


redirect_if(empty($comment),aurl('comments'));
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h2><?php echo  trans('admin.comments')  ; ?>  - #<?php echo $comment['name'] ; ?> <?php echo  trans('admin.show')  ; ?>  </h2>
<a class="btn btn-info" href="<?php echo  aurl('comments')  ; ?> "><?php echo  trans('admin.comments')  ; ?> </a>
</div>
    <div class="row">
        <!-- name information -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="name"><?php echo  trans('comments.name')  ; ?> </label>
                <?php echo $comment['name'] ; ?> 
            </div>
        </div>
       <!-- email information -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="email"><?php echo  trans('comments.email')  ; ?> </label>
                <?php echo $comment['email'] ; ?> 
            </div>
        </div>
        <!-- comments_id information -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="comments_id"><?php echo  trans('news.title')  ; ?> </label>
                <?php echo $comment['title'] ; ?> 
            </div>
        </div>
        <!-- status information -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="status"><?php echo  trans('comments.status')  ; ?> </label>
                <?php echo $comment['status'] ; ?> 
            </div>
        </div>
       <!-- comment information -->
        <div class="col-md-12">
            <div class="form-group">
                <label for="comment"><?php echo  trans('comments.comment')  ; ?> </label>
                <?php echo $comment['comment'] ; ?> 
            </div>
        </div>
               <!-- comment id information -->
               <div class="col-md-12">
            <div class="form-group">
                <label for="comment"><?php echo  trans('comments.news_id')  ; ?> </label>
                <?php echo $comment['news_id'] ; ?> 
            </div>
        </div>


    </div>



<?php
view('admin.layouts.footer');

?>