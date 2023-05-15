<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?=$title?></title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="NPS">
	<meta name="author" content="Emerson Bruno">
	<meta name="generator" content="NPS Project 1.0">
	<link rel="shortcut icon" href="favicon.ico">

	<!-- FontAwesome JS-->
	<script defer src="<?=base_url('assets/plugins/fontawesome/js/all.min.js')?>"></script>

	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="<?=base_url('assets/css/portal.css');?>">

</head>

<body class="app app-login p-0">
	<div class="row g-0 app-auth-wrapper">
		<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
			<div class="d-flex flex-column align-content-end">
				<div class="app-auth-body mx-auto">
					<div class="app-auth-branding mb-4"><a class="app-logo" href="<?=base_url()?>"><img class="logo-icon me-2" src="<?=base_url('assets/images/eth_logo.png')?>" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Acessar área restrita</h2>
					<?=get_msg()?>
					<div class="auth-form-container text-start">
						<?=form_open('',['class'=>"auth-form login-form"])?>
							<div class="email mb-3">
								<label class="sr-only" for="signin-login">Login</label>
								<input id="signin-login" name="login" type="text" class="form-control signin-email" placeholder="Login" required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="signin-password">Senha</label>
								<input id="signin-password" name="password" type="password" class="form-control signin-password" placeholder="Senha" required="required">
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Entrar</button>
							</div>
							<?=form_close()?>
					</div><!--//auth-form-container-->

				</div><!--//auth-body-->

				<footer class="app-auth-footer">
					<div class="container text-center py-3">
						<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
						<small class="copyright">Customized by Emerson Bruno.</small>

					</div>
				</footer><!--//app-auth-footer-->
			</div><!--//flex-column-->
		</div><!--//auth-main-col-->
		<div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
			<div class="auth-background-holder">
			</div>
			<div class="auth-background-mask"></div>
			<div class="auth-background-overlay p-3 p-lg-5">
				<div class="d-flex flex-column align-content-end h-100">
					<div class="h-100"></div>
					<div class="overlay-content p-3 p-lg-4 rounded">
						<h5 class="mb-3 overlay-title"><?=SITE_NAME?></h5>
					</div>
				</div>
			</div><!--//auth-background-overlay-->
		</div><!--//auth-background-col-->

	</div><!--//row-->


</body>

</html>
