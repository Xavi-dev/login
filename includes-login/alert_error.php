<?php if(isset($error)) : ?>
      <div class="alert alert-dismissible fade show message bg-red-color" role="alert">
         <span><?php echo $error; ?></span> 
         <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>
