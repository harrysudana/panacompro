<?php
$this->the_header();
?>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">PCompro</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="<?php echo $this->get_home_url();?>administration">Home</a></li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Posts <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">All Posts</a></li>
						<li><a href="#">Add New</a></li>
						<li><a href="#">Tags</a></li>
					</ul>

				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">All Pages</a></li>
						<li><a href="#">Add New</a></li>
					</ul>

				</li>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Edit</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo $this->get_home_url();?>administration/auth/logout">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>

<div class="container">

	<!-- Main component for a primary marketing message or call to action -->
	<div class="jumbotron">
		<h1>Welcome</h1>
		<p>
		To contribute the project, fork on github <a href="https://github.com/harrysudana/panacompro">https://github.com/harrysudana/panacompro</a>
		</p>
	</div>

</div> <!-- /container -->


<?php
$this->the_footer();
?>