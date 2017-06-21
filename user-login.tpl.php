<div id="login-block" class="login-box">
	<div id="login" class="login-box-body">
		<?php print drupal_render_children($form) ?>
		
		<div class="text-center">
			<div class="divider"></div>
			<p>- OR -</p>
			<div class="divider"></div>
			<div class="row">
				<div class="col-sm-6">
					<a href="user/password" class="btn btn-purple-bordered-reverse btn-block btn-rounded-5x">Forgot Password</a>
				</div>
				
				<div class="col-sm-6">
					<a href="user/register" class="btn btn-maroon-bordered-reverse btn-block btn-rounded-5x">Create your Account</a>
				</div>
			</div>
		</div>
	</div>
</div>