<?php if(!empty($image)):
    $rand=md5(rand(000,999));
    //var_dump($image);
?>

<!-- Button trigger modal -->
<img src="<?php echo  $image  ; ?> " data-bs-toggle="modal" data-bs-target="#showImage<?php echo $rand ; ?> "  
style="width:25px;height:25px;cursor:pointer">

</button>

<!-- Modal -->
<div class="modal fade" id="ShowImage<?php echo $rand ; ?> " tabindex="-1" aria-labelledby="ShowImageLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
      <img src="<?php echo  $image  ; ?> "  style="width:100%; height:80%">
      </div>
    </div>
  </div>
</div>
<?php endif;?>