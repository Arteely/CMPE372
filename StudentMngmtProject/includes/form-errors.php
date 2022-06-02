<?php  if (count($error_array) > 0) : ?>
  <div class="error-block">
  	<?php foreach ($error_array as $error) : ?>
  	  <p class="error-text"><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>

<style>
.error-block{
    background-color:#f4f4f4;
    border-radius: 25px;
    margin: 1rem;
	padding: 0.2rem;
}

.error-text{
    font-size: 12px;
    font-weight: 400;
    color: #ed4337;
}
</style>