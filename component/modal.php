

<?php 
if ( isset($messageModal)){
}else{
    $messageModal=['show'=>FALSE,'title'=>'...','body'=>'...'];
}
?>

  <!-- Modal -->
  <div class="modal fade" id="myModal55" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?=$messageModal['title']?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><?=$messageModal['body']?></p>
        </div>

      </div>
    </div>
  </div>


  <script>
    var myModal = new bootstrap.Modal(document.getElementById('myModal55'), {});

    <?php
    if ($messageModal['show']) {
      echo 'myModal.toggle();';

    }?>
  </script>
