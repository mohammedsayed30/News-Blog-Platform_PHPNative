<?php
 view('layout.header',['title'=>trans('main.home')]);
?>

<?php if(any_errors()): ?>
<div class="alert alert-danger">
    <ol>
            <?php foreach(all_errors() as $error): ?> 
                    <li><?php echo $error ?></li> 
            <?php endforeach; ?>  
    </ol>

</div>
<?php endif; ?>


<?php //<a href="<?php echo url('../php/storage/files/images/img.png')?>

<?php 
   $email_valid = get_error('email');
   $mobile_valid = get_error('mobile');
   $address_valid = get_error('address');
   end_errors();
   //<?php echo url('/upload'); 
?>
<?php echo url('/upload') ; ?> 
<form method="post" action="<?php echo url('upload') ; ?> " enctype="multipart/form-data">
<label>Email: </label>
<input type="text" name="email" 
value="<?php /*to print the old value if was correct */ echo old('email'); ?>" 
class="form-control <?php echo (!empty($email_valid))?'is-invalid':'is-valid'; ?>" />
<div class="<?php echo !empty($email_valid)?'invalid-feedback':'valid-feedback'; ?>">
    <?php echo $email_valid ?>
</div> 
<label>Mobile: </label>
<input type="text" name="mobile" 
 value="<?php /*to print the old value if was correct */ echo old('mobile'); ?>" 
 class="form-control <?php echo !empty($mobile_valid)?'is-invalid':'is-valid'; ?>"/> 
<div class="<?php echo !empty($mobile_valid)?'invalid-feedback':'valid-feedback'; ?>">
    <?php echo $mobile_valid ?>
</div> 
<label>Address: </label>
<input type="text" name="address" 
 value="<?php /*to print the old value if was correct */ echo old('address'); ?>" 
 class="form-control <?php echo !empty($address_valid)?'is-invalid':'is-valid'; ?>" /> 
<div class="<?php echo !empty($address_valid)?'invalid-feedback':'valid-feedback'; ?>">
    <?php echo $address_valid ?>
</div>        
<input type="hidden" name="_method" value="post" />
<input type="submit" value="Send" class="btn btn-success" />
</form>     


<?php view('layout.footer');?>