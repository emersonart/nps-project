<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="row g-4 mb-4 justify-content-center">
	<div class="col-6">
		<div class="app-card app-card-stat shadow-sm h-100 text-start">
			<div class="app-card-body p-3 p-lg-4">
				<?= form_open('',[],['id_company'=>$auth_user['id_company']]) ?>
				<div class="mb-3">
					<label for="login">Login</label>
					<input id="login" name="login" type="text" class="form-control" required="required" value="<?=set_value('login')?>">
					<small class="text-muted">Sem espaços e acentos, precisa ser único</small>
				</div><!--//form-group-->
				<div class="mb-3">
					<label for="name">Nome</label>
					<input id="name" name="name" type="text" class="form-control" required="required" value="<?=set_value('name')?>">
				</div><!--//form-group-->
				<div class="mb-3">
					<label for="active">Ativo</label>
					<select name="active" class="form-select" id="active">
						<option value="1" <?=set_select('active',1,true)?>>Sim</option>
						<option value="0" <?=set_select('active',0,)?>>Não</option>
					</select>
				</div><!--//form-group-->
				<div class="mb-3">
					<label for="admin">Administrador</label>
					<select name="admin" class="form-select" id="admin">
						<option value="1" <?=set_select('admin',1)?>>Sim</option>
						<option value="0" <?=set_select('admin',0,false)?>>Não</option>
					</select>
					<small class="text-danger">Esta opção não pode ser alterada futuramente, caso seja administrador só terá acesso a este painel, caso contrário só terá acesso a página de avaliação</small>
				</div><!--//form-group-->
				
				<hr>
				<div class="mb-3">
					<label for="password">Senha</label>
					<input id="password" name="password" required type="password" class="form-control">
				</div><!--//form-group-->
				<hr>
				<div class="mb-3 text-center">
					<div class="row justify-content-center">
						<button class="col-6 btn btn-primary text-white" type="submit">Salvar</button>
					</div>
					
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>
