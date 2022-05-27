<?php  if (count($error_array) > 0) : ?>
  <div class="error-block">
  	<?php foreach ($error_array as $error) : ?>
  	  <p class="error-text"><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>