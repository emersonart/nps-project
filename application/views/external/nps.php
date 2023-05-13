<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= $title ?></title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="NPS">
	<meta name="author" content="Emerson Bruno">
	<meta name="generator" content="NPS Project 1.0">
	<link rel="shortcut icon" href="favicon.ico">

	<!-- FontAwesome JS-->
	<script defer src="<?= base_url('assets/plugins/fontawesome/js/all.min.js') ?>"></script>

	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="<?= base_url('assets/css/portal.css'); ?>">
	<link id="theme-style" rel="stylesheet" href="<?= base_url('assets/css/nps.css'); ?>">

</head>

<body class="app p-0 h-100d-flex flex-column">
	<div class="d-flex flex-column">
		<div class="h-100 w-100 ">
			
		</div>
		<div class="container-nps h-100">
			<div class="container d-flex justify-content-center flex-column h-100">
				<div class="container-itens-ans">
					<div class="row justify-content-center no-gutters h-100">
						<div class="col h-100">
							<div class="card answer-trigger" data-answer="1">
								<img src="<?= base_url('assets/images/emojis/ans_1.svg') ?>" class="img-fluid card-img-top" alt="Péssimo">
								<div class="card-footer d-none d-md-block">
									<small class="text-body-secondary">Péssimo</small>
								</div>
							</div>
						</div>
						<div class="col h-100">
							<div class="card answer-trigger" data-answer="2">
								<img src="<?= base_url('assets/images/emojis/ans_2.svg') ?>" class="img-fluid card-img-top" alt="Ruim">
								<div class="card-footer d-none d-md-block">
									<small class="text-body-secondary">Ruim</small>
								</div>
							</div>
						</div>
						<div class="col h-100">
							<div class="card answer-trigger" data-answer="3">
								<img src="<?= base_url('assets/images/emojis/ans_3.svg') ?>" class="img-fluid card-img-top" alt="Regular">
								<div class="card-footer d-none d-md-block">
									<small class="text-body-secondary">Regular</small>
								</div>
							</div>
						</div>
						<div class="col h-100">
							<div class="card answer-trigger" data-answer="4">
								<img src="<?= base_url('assets/images/emojis/ans_4.svg') ?>" class="img-fluid card-img-top" alt="Bom">
								<div class="card-footer d-none d-md-block">
									<small class="text-body-secondary">Bom</small>
								</div>
							</div>
						</div>
						<div class="col h-100">
							<div class="card answer-trigger" data-answer="5">
								<img src="<?= base_url('assets/images/emojis/ans_5.svg') ?>" class="img-fluid card-img-top" alt="Muito bom">
								<div class="card-footer d-none d-md-block">
									<small class="text-body-secondary">Ótimo</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<script>
		const base_url = '<?=base_url()?>'
	</script>
	<script src="<?=base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
	<script src="<?=base_url('assets/js/answers.js')?>"></script>
</body>

</html>
