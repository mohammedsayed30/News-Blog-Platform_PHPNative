<?php
 view('layout.header',['title'=>trans('main.home')]);
?>

@if(any_errors())
<div class="alert alert-danger">
    <ol>
            @foreach(all_errors() as $error) 
                    <li><?php echo $error ?></li> 
            @endforeach  
    </ol>

</div>
@endif


<?php //<a href="<?php echo url('../php/storage/files/images/img.png')?>

<?php 
   $email_valid = get_error('email');
   $mobile_valid = get_error('mobile');
   $address_valid = get_error('address');
   end_errors();
   //<?php echo url('/upload'); 
?>
{{url('/upload')}}
<form method="post" action="{{url('upload')}}" enctype="multipart/form-data">
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
<?php
/*
When submitted, the backend interprets this 
as a POST request instead of POST \
if value="PUT" -->the backend interprets this 
as a PUT request instead of POST */
?>     
<input type="hidden" name="_method" value="post" />
<input type="submit" value="Send" class="btn btn-success" />
</form>     


<?php view('layout.footer');?>