<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="app-sidepanel" class="app-sidepanel">
	<div id="sidepanel-drop" class="sidepanel-drop"></div>
	<div class="sidepanel-inner d-flex flex-column">
		<a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
		<div class="app-branding">
			<a class="app-logo" href="index.html"><span class="logo-text">NPS - Ô bar</span></a>

		</div><!--//app-branding-->

		<nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
			<ul class="app-menu list-unstyled accordion" id="menu-accordion">
				<li class="nav-item">
					<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					<a class="nav-link <?=$active_menu == 'panel/dashboard' ? 'active' : ''?>" href="<?= base_url('panel/dashboard') ?>">
						<span class="nav-icon">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
								<path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
							</svg>
						</span>
						<span class="nav-link-text">Dashboard</span>
					</a><!--//nav-link-->
				</li><!--//nav-item-->
				<li class="nav-item has-submenu">
					<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					<a class="nav-link submenu-toggle <?=in_array($active_menu,['panel/users','panel/users/store','panel/users/edit']) ? 'active' : ''?>" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
						<span class="nav-icon">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
								<path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
							</svg>
						</span>
						<span class="nav-link-text">Usuários</span>
						<span class="submenu-arrow">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
							</svg>
						</span><!--//submenu-arrow-->
					</a><!--//nav-link-->
					<div id="submenu-1" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
						<ul class="submenu-list list-unstyled">
							<li class="submenu-item <?=$active_menu == 'panel/users/store' ? 'active' : ''?>"><a class="submenu-link <?=$active_menu == 'panel/users/store' ? 'active' : ''?>" href="<?= base_url('panel/users/store') ?>">Cadastrar</a></li>
							<li class="submenu-item <?=$active_menu == 'panel/users' ? 'active' : ''?>"><a class="submenu-link <?=$active_menu == 'panel/users' ? 'active' : ''?>" href="<?= base_url('panel/users') ?>">Listar</a></li>
						</ul>
					</div>
				</li><!--//nav-item-->
			</ul><!--//app-menu-->
		</nav><!--//app-nav-->
		<div class="app-sidepanel-footer">
			<nav class="app-nav app-nav-footer">
				<ul class="app-menu footer-menu list-unstyled">
					<li class="nav-item">
						<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
						<a class="nav-link" href="<?=base_url('panel/sair')?>">
							<span class="nav-icon">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
									<path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
									<path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708Z" />
								</svg>
							</span>
							<span class="nav-link-text">Sair</span>
						</a><!--//nav-link-->
					</li><!--//nav-item-->
				</ul><!--//footer-menu-->
			</nav>
		</div><!--//app-sidepanel-footer-->

	</div><!--//sidepanel-inner-->
</div><!--//app-sidepanel-->
