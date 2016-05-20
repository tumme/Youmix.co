<!-- Modal Sign In -->
<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-popup">
				<a href="#" class="close-link pull-right" data-dismiss="modal" aria-label="Close"><i aria-hidden="true" class="fa fa-times"></i></a>
				<section class="sign-up section-padding text-center" style="padding:100px 0">
				<form action="update_user.php" class="signup-form" method="post">
					<h3>Log in</h3>
						<?php
							if(!isset($_SESSION['logged_in']))
							{
							    echo '<div id="results">';
							    echo '</div>';
							    echo '<div id="LoginButton">';
								  echo '<button type="button" rel="nofollow" class="btn-primary sign-up-btn facebook-btn" onClick="javascript:CallAfterLogin();return false;"><i class="fa fa-facebook"></i> Signin with Facebook</button>';
							    echo '</div>';
							}
							else
							{
								//echo 'Hi '. $_SESSION['user_name'].'! You are Logged in to facebook, <a href="?logout=1">Log Out</a>.';
							}
							?>
					</form>
				</section>
			</div>
		</div>
	</div>

 