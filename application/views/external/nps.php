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

<body class=" p-0 h-100d-flex flex-column">
	<div class="d-flex flex-column">
		<div class="container-header">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-8 col-sm-4 text-center">
						<img src="<?= base_url('assets/images/o-bar.png') ?>" class="img-fluid p-4 img-header" alt="">
					</div>
					<div class="col-12 col-sm-8 d-flex flex-column justify-content-center align-items-center">
						<h1>Como você <br><b>nos avalia?</b></h1>
					</div>
				</div>
			</div>
		</div>
		<div class="container-nps h-100">
			<div class="container-xl d-flex justify-content-center flex-column h-100">
				<div class="container-itens-ans">
					<div class="row justify-content-center no-gutters">
						<div class="col">
							<h4 class="ms-2">Como você avalia nosso atendimento?</h4>
						</div>
					</div>
					<div class="row justify-content-center no-gutters">
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
				<div class="container-itens-ans">
					<div class="row justify-content-center no-gutters">
						<div class="col">
							<h4 class="ms-2">Como você avalia nossa comida?</h4>
						</div>
					</div>
					<div class="row justify-content-center no-gutters">
						<div class="col h-100">
							<div class="card answer-trigger-food" data-answer="1">
								<img src="<?= base_url('assets/images/emojis/ans_1.svg') ?>" class="img-fluid card-img-top" alt="Péssimo">
								<div class="card-footer d-none d-md-block">
									<small class="text-body-secondary">Péssimo</small>
								</div>
							</div>
						</div>
						<div class="col h-100">
							<div class="card answer-trigger-food" data-answer="2">
								<img src="<?= base_url('assets/images/emojis/ans_2.svg') ?>" class="img-fluid card-img-top" alt="Ruim">
								<div class="card-footer d-none d-md-block">
									<small class="text-body-secondary">Ruim</small>
								</div>
							</div>
						</div>
						<div class="col h-100">
							<div class="card answer-trigger-food" data-answer="3">
								<img src="<?= base_url('assets/images/emojis/ans_3.svg') ?>" class="img-fluid card-img-top" alt="Regular">
								<div class="card-footer d-none d-md-block">
									<small class="text-body-secondary">Regular</small>
								</div>
							</div>
						</div>
						<div class="col h-100">
							<div class="card answer-trigger-food" data-answer="4">
								<img src="<?= base_url('assets/images/emojis/ans_4.svg') ?>" class="img-fluid card-img-top" alt="Bom">
								<div class="card-footer d-none d-md-block">
									<small class="text-body-secondary">Bom</small>
								</div>
							</div>
						</div>
						<div class="col h-100">
							<div class="card answer-trigger-food" data-answer="5">
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
	<div id="responseModal" class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-body text-center">
					<div class="container-icon-modal py-3">
						<i class="fa fa-6x modal-icon"></i>
					</div>
					<h2 class="modal-info-title mt-4"></h2>
				</div>
			</div>
		</div>
	</div>
	<script>
		const base_url = '<?= base_url() ?>'
	</script>
	<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/answers.js') ?>"></script>
</body>

</html>
