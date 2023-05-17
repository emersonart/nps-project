<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row g-4 mb-4">
	<div class="col-12">
		<div class="app-card app-card-stat shadow-sm h-100 text-start">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="mb-1">Filtrar dados</h4>
				<?= form_open('', ['method' => 'GET']) ?>
				<div class="row g-3 align-items-center justify-content-end">
					<div class="col-auto">
						<div class="row g-3 align-items-center justify-content-end" id="filter_range">
							<div class="col-auto">
								<label for="init_date" class="col-form-label">Data inicial</label>
							</div>
							<div class="col-auto">
								<input type="text" id="init_date" name="init_date" class="form-control" aria-labelledby="init_date" value="<?= date('d/m/Y', strtotime($init_date)) ?>">
							</div>
							<div class="col-auto">
								<label for="end_date" class="col-form-label">Data final</label>
							</div>
							<div class="col-auto">
								<input type="text" id="end_date" name="end_date" class="form-control" aria-labelledby="auto" value="<?= date('d/m/Y', strtotime($end_date)) ?>">
							</div>
						</div>
					</div>

					<div class="col-auto">
						<button type="submit" class="btn btn-primary text-white">Filtrar</button>
					</div>
				</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
<div class="row g-4 mb-4">
	<div class="col-4">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Média de avaliações (Geral)</h4>
				<div class="stats-figure"><?= round(($answers_avg_all + $answers_food_avg_all) / 2,1)?> <img src="<?= base_url('assets/images/emojis/ans_' . round(($answers_avg_all + $answers_food_avg_all) / 2) . ".svg") ?>" class="img-fluid" style="margin-top: -8px" width="32"></div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->
	<div class="col-4">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Média de atendimento (Geral)</h4>
				<div class="stats-figure"><?= $answers_avg_all ?> <img src="<?= base_url('assets/images/emojis/ans_' . round($answers_avg_all) . ".svg") ?>" class="img-fluid" style="margin-top: -8px" width="32"></div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->
	<div class="col-4">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Média de comida (Geral)</h4>
				<div class="stats-figure"><?= $answers_food_avg_all ?> <img src="<?= base_url('assets/images/emojis/ans_' . round($answers_food_avg_all) . ".svg") ?>" class="img-fluid" style="margin-top: -8px" width="32"></div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->
</div>
<div class="row g-4 mb-4">
	<div class="col-6 col-lg-3">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Total de avaliações (<?= $diffDays ?> dia<?= $diffDays > 1 ? 's' : '' ?>)</h4>
				<div class="stats-figure"><?= count($answers_total) ?></div>
				<div class="stats-meta text-<?= $diffCountAnswers > 0 ? 'success' : ($diffCountAnswers == 0 ? 'dark' : 'danger') ?>" data-bs-toggle="tooltip" title="<?= $diffDays ?> dia(s) atrás">
					<i class="fa fa-<?= $diffCountAnswers > 0 ? 'arrow-up' : ($diffCountAnswers == 0 ? 'circle' : 'arrow-down') ?>"></i>
					<?= $diffCountAnswers ?>%
				</div>
			</div><!--//app-card-body-->
			<!-- <a class="app-card-link-mask" href="#"></a> -->
		</div><!--//app-card-->
	</div><!--//col-->

	<div class="col-6 col-lg-3">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Média de atendimento (<?= $diffDays ?> dia<?= $diffDays > 1 ? 's' : '' ?>)</h4>
				<div class="stats-figure"><?= $average ?> <img src="<?= base_url('assets/images/emojis/ans_' . round($average) . ".svg") ?>" class="img-fluid" style="margin-top: -8px" width="32"></div>
				<div class="stats-meta text-<?= $diffCountAveragePast > 0 ? 'success' : ($diffCountAveragePast == 0 ? 'dark' : 'danger') ?>">
					<i class="fa fa-<?= $diffCountAveragePast > 0 ? 'arrow-up' : ($diffCountAveragePast == 0 ? 'circle' : 'arrow-down') ?>"></i>
					<?= $diffCountAveragePast ?>%
				</div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->
	<div class="col-6 col-lg-3">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Média de comida (<?= $diffDays ?> dia<?= $diffDays > 1 ? 's' : '' ?>)</h4>
				<div class="stats-figure"><?= $average_food ?> <img src="<?= base_url('assets/images/emojis/ans_' . round($average_food) . ".svg") ?>" class="img-fluid" style="margin-top: -8px" width="32"></div>
				<div class="stats-meta text-<?= $diffCountAverageFoodPast > 0 ? 'success' : ($diffCountAverageFoodPast == 0 ? 'dark' : 'danger') ?>">
					<i class="fa fa-<?= $diffCountAverageFoodPast > 0 ? 'arrow-up' : ($diffCountAverageFoodPast == 0 ? 'circle' : 'arrow-down') ?>"></i>
					<?= $diffCountAverageFoodPast ?>%
				</div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->
	<div class="col-6 col-lg-3">
		<div class="app-card app-card-stat shadow-sm h-100">
			<div class="app-card-body p-3 p-lg-4">
				<h4 class="stats-type mb-1">Usuários</h4>
				<div class="stats-figure"><?= count($users) ?></div>
				<div class="stats-meta">
					Tablets</div>
			</div><!--//app-card-body-->
			<a class="app-card-link-mask" href="#"></a>
		</div><!--//app-card-->
	</div><!--//col-->
</div><!--//row-->

<div class="row g-4 mb-4">
	<div class="col-12 col-lg-8">
		<div class="app-card app-card-chart h-100 shadow-sm">

			<div class="app-card-header p-3">
				<div class="row justify-content-between align-items-center">
					<div class="col-auto">
						<h4 class="app-card-title">Quantidade de avaliações por dia</h4>
					</div><!--//col-->
					<div class="col-auto">
						<div class="card-header-action">
							<a href="javascript:;" class="btn btn-primary text-white btn-sm" onclick="dowloadDataChart('#canvas-linechart')">Download</a>
						</div>
					</div>
				</div><!--//row-->
			</div><!--//app-card-header-->
			<div class="app-card-body p-3 p-lg-4">
				<div id="labelsLineChart" class="d-none">
					<?= json_encode($arrayLabelsLineChart) ?>
				</div>
				<div id="dataLineService" class="d-none">
					<?= json_encode($answers_by_day) ?>
				</div>
				<div id="dataLineFood" class="d-none">
					<?= json_encode($answers_food_by_day) ?>
				</div>
				<div class="chart-container">
					<canvas id="canvas-linechart" data-filename="grafico_quantidade_avaliacoes_<?= date('d\_m\_Y', strtotime($init_date)) ?>_ate_<?= date('d\_m\_Y', strtotime($end_date)) ?>" data-init-date="<?= date('d\_m\_Y', strtotime($init_date)) ?>" data-end-date="<?= date('d\_m\_Y', strtotime($end_date)) ?>"></canvas>
				</div>
			</div><!--//app-card-body-->
		</div><!--//app-card-->
	</div><!--//col-->
	<div class="col-12 col-lg-4">
		<div class="app-card app-card-progress-list h-100 shadow-sm">
			<div class="app-card-header p-3">
				<div class="row justify-content-between align-items-center">
					<div class="col-auto">
						<h4 class="app-card-title">Média de avaliações por usuário</h4>
						<h6 class="text-muted mt-2"><small>Legenda: <span class="text-success fw-bold">Atendimento</span> | <span class="text-primary fw-bold">Comida</span> </small></h6>
					</div><!--//col-->
				</div><!--//row-->
			</div><!--//app-card-header-->
			<div class="app-card-body ">
				<?php foreach ($users as $k => $u) { ?>
					<div class="item p-3">
						<div class="row align-items-center">
							<div class="col">
								<div class="title mb-1 "><?= $u['name'] ?></div>
								<div class="progress mb-2" style="height: 40px">
									<div class="progress-bar progress-bar-striped bg-success overflow-visible text-black" role="progressbar" style="width: <?= round(($u['answers_average'] / 5 * 100)) ?>%;" aria-valuenow="<?= round(($u['answers_average'] / 5 * 100)) ?>" aria-valuemin="1" aria-valuemax="5"><b><?= $u['answers_average'] ?></b> de <?= count($u['answers']) ?> avaliações</div>
								</div>
								<div class="progress" style="height: 40px">
									<div class="progress-bar progress-bar-striped bg-primary overflow-visible" role="progressbar" style="width: <?= round(($u['answers_food_average'] / 5 * 100)) ?>%;" aria-valuenow="<?= round(($u['answers_food_average'] / 5 * 100)) ?>" aria-valuemin="1" aria-valuemax="5"><b><?= $u['answers_food_average'] ?></b> de <?= count($u['answers_food']) ?> avaliações</div>
								</div>
							</div><!--//col-->
							<div class="col-auto d-none">
								<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
								</svg>
							</div><!--//col-->
						</div><!--//row-->
						<a class="item-link-mask" href="#"></a>
					</div><!--//item-->
				<?php } ?>

			</div><!--//app-card-body-->
		</div><!--//app-card-->
	</div><!--//col-->


</div><!--//row-->


<div class="row g-4 mb-4">
	<div class="col-12">
		<div class="app-card app-card-chart h-100 shadow-sm">
			<div class="app-card-header p-3">
				<div class="row justify-content-between align-items-center">
					<div class="col-auto">
						<h4 class="app-card-title">Avaliações (<?= $diffDays ?> dia<?= $diffDays > 1 ? 's' : '' ?>)</h4>
					</div><!--//col-->
				</div><!--//row-->
			</div><!--//app-card-header-->
			<div class="app-card-body p-3 p-lg-4">
				<div class="table-responsive">
					<table id="table_answers" class="table table-striped table-hover" data-init-date="<?= date('d\_m\_Y', strtotime($init_date)) ?>" data-end-date="<?= date('d\_m\_Y', strtotime($end_date)) ?>">
						<thead>
							<tr>
								<th>#</th>
								<th>Data/Hora</th>
								<th>Usuário</th>
								<th>Tipo de avaliação</th>
								<th>Avaliação</th>
								<th>Emoji</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($answers_total as $k => $ans) { ?>
								<tr>
									<td><?= $ans['id_answer'] ?></td>
									<td><?= date('d/m/Y \à\s H:i', strtotime($ans['created_at'])) ?></td>
									<td><?= $ans['name'] ?></td>
									<td><?= $ans['type'] ?></td>
									<td><?= $ans['value'] ?></td>
									<td><img src="<?= base_url('assets/images/emojis/ans_' . $ans['value'] . ".svg") ?>" class="img-fluid" width="20px"></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
