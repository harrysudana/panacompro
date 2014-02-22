<?php
$this->the_header('admin');
?>

      <form class="form-signin" role="form" method="post">
        <h2 class="form-signin-heading">Register</h2>
        <?php
        if(isset($error)){
        	echo "<p class='bg-warning'>".$error."</p>";
        }
        ?>
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <input type="email" name="email" class="form-control" placeholder="Email address" required>
        
        <input type="hidden" name="regSignature" value="<?php echo $signature;?>" >
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnregister" value="register">Register</button>
      </form>

<?php
$this->the_footer();
?>