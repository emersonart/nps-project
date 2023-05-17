<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row g-4 mb-4">
	<div class="col-12">
		<div class="app-card app-card-stat shadow-sm h-100 text-start">
			<div class="app-card-body p-3 p-lg-4">
				<div class="table-responsive">
					<table id="table_users" class="table table-striped table-hover dataTable">
						<thead>
							<tr>
								<th>#</th>
								<th>Data/Hora</th>
								<th>Nome</th>
								<th>Média atendimento</th>
								<th>Média comida</th>
								<th>Admin</th>
								<th>Opções</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($users as $k => $u) { ?>
								<tr>
									<td><?= $u['id_user'] ?></td>
									<td><?= date('d/m/Y \à\s H:i', strtotime($u['created_at'])) ?></td>
									<td><?= $u['name'] ?></td>
									<td><?= $u['average_service'] ?></td>
									<td><?= $u['average_food'] ?></td>
									<td><?= $u['admin'] == 1 ? 'Sim' : 'Não' ?></td>
									<td>
										<div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
											<a href="<?=base_url('panel/users/edit/'.$u['id_user'])?>" class="btn btn-primary text-white">Editar</a>
											<a href="<?=base_url('panel/users/delete/'.$u['id_user'])?>" class="btn btn-danger text-white <?=$auth_user['id_user'] == $u['id_user'] ? 'd-none':''?>">Excluir</a>
										</div>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
