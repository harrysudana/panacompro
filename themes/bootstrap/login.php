<?php
$this->the_header('admin');
?>

      <form class="form-signin" role="form" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <?php
        if(isset($error)){
        	echo "<p class='bg-warning'>".$error."</p>";
        }
        ?>
        <input type="email" name="username" class="form-control" placeholder="Email address" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <input type="hidden" name="loginSignature" value="<?php echo $signature;?>" >
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnlogin" value="login">Sign in</button>
      </form>

<?php
$this->the_footer();
?>