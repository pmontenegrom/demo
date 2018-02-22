<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		DB::table('adm_events')->delete();
		DB::table('adm_actions')->delete();
		DB::table('adm_modules')->delete();
		DB::table('adm_menus')->delete();
		DB::table('users')->delete();
		DB::table('profiles')->delete();

		DB::table('crm_register_fields')->delete();
		DB::table('crm_registers')->delete();
		DB::table('crm_form_fields')->delete();
		DB::table('crm_notifies')->delete();
		DB::table('crm_forms')->delete();

		DB::table('cms_articles')->delete();
		DB::table('cms_schemas')->delete();
		DB::table('cms_langs')->delete();

		DB::table('cms_directories')->delete();
		DB::table('cms_filetypes')->delete();

		DB::table('cms_parameters')->delete();
		DB::table('cms_parameters_group')->delete();

		DB::table('cms_translates')->delete();
		DB::table('cms_translates_alias')->delete();
		DB::table('cms_translates_group')->delete();

		
		// Seeding cms_configs
		\App\CmsConfig::create(['type' => 'string', 'name' => 'Nombre del Site', 'alias' => 'site_name', 'value' => 'Layqa']);
		\App\CmsConfig::create(['type' => 'string', 'name' => 'Cuenta Postmaster', 'alias' => 'postmaster', 'value' => 'no-reply@gmail.com']);
		\App\CmsConfig::create(['type' => 'text', 'name' => 'Google Analytics', 'alias' => 'analytics']);

		
		// Seeding cms_translates_group
		$tgroup_general= \App\CmsTranslateGroup::create(['name' => 'General', 'active'=>'1']);
		$tgroup_forms = \App\CmsTranslateGroup::create(['name' => 'Formularios', 'active'=>'1']);


		// Seeding cms_translates_alias


		// Seeding cms_parameters_group
		$pgroup_asuntos= \App\CmsParameterGroup::create(['name' => 'Asuntos de Contacto', 'alias'=>'contacto', 'active'=>'1']);
		//$pgroup_areas = \App\CmsParameterGroup::create(['name' => 'Áreas de Interés', 'active'=>'1']);

		// Seeding cms_filetypes
		$ftype_image = \App\CmsFileType::create(['name' => 'Imagen', 'extensions' => 'jpg,jpeg,gif,png', 'active'=>'1']);
		$ftype_doc   = \App\CmsFileType::create(['name' => 'Documento', 'extensions' => 'pdf,doc,docx,xls,xlsx,ppt,pptx', 'active'=>'1']);
		$ftype_audio = \App\CmsFileType::create(['name' => 'Audio', 'extensions' => 'mp3,aif,wav', 'active'=>'1']);
		$ftype_video = \App\CmsFileType::create(['name' => 'Video', 'extensions' => 'mov,avi,mpg,mpeg,mp4,wmv', 'active'=>'1']);


		// Seeding cms_directories
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Página: imagen', 'alias' => 'pagina_imagen', 'path' => 'cms/pagina/imagen/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Página: icono', 'alias' => 'pagina_icono', 'path' => 'cms/pagina/icono/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_video->id, 'name' => 'Página: video', 'alias' => 'pagina_video', 'path' => 'cms/pagina/video/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_doc->id, 'name' => 'Página: documento', 'alias' => 'pagina_documento', 'path' => 'cms/pagina/documento/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Seccion: imagen', 'alias' => 'seccion_imagen', 'path' => 'cms/seccion/imagen/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Proyecto: icono', 'alias' => 'proyecto_icono', 'path' => 'cms/proyecto/icono/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Proyecto: mapa', 'alias' => 'proyecto_mapa', 'path' => 'cms/proyecto/mapa/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Proyecto: plano', 'alias' => 'proyecto_plano', 'path' => 'cms/proyecto/plano/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Proyecto: fondo', 'alias' => 'proyecto_fondo', 'path' => 'cms/proyecto/fondo/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_doc->id, 'name' => 'Proyecto: manual', 'alias' => 'proyecto_manual', 'path' => 'cms/proyecto/manual/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_doc->id, 'name' => 'Proyecto: documento', 'alias' => 'proyecto_documento', 'path' => 'cms/proyecto/documento/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Animación: foto', 'alias' => 'animacion_home', 'path' => 'cms/home/foto/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Galería: imagen', 'alias' => 'galeria_imagen', 'path' => 'cms/galeria/imagen/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Galería: ícono', 'alias' => 'galeria_icono', 'path' => 'cms/galeria/icono/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Evento: imagen', 'alias' => 'evento_imagen', 'path' => 'cms/evento/imagen/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Término: Imagenes de Texto', 'alias' => 'termino_imagen', 'path' => 'cms/termino/imagen/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Acceso: ícono', 'alias' => 'acceso_icono', 'path' => 'cms/acceso/icono/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_video->id, 'name' => 'Acceso: ícono', 'alias' => 'acceso_video', 'path' => 'cms/acceso/video/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Widget: imagen', 'alias' => 'widget_imagen', 'path' => 'cms/widget/imagen/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Widget: ícono', 'alias' => 'widget_icono', 'path' => 'cms/widget/icono/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Widget: canal', 'alias' => 'widget_canal', 'path' => 'cms/widget/canal/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Redes Sociales: ícono', 'alias' => 'redes_icono', 'path' => 'cms/redes/icono/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Noticias: imagen', 'alias' => 'noticia_imagen', 'path' => 'cms/noticia/imagen/', 'active'=>'1']);
		\App\CmsDirectory::create(['type_id' => $ftype_image->id, 'name' => 'Meta-tag: imagen', 'alias' => 'metatag_imagen', 'path' => 'cms/metatag/imagen/', 'active'=>'1']);

		// Seeding cms_langs
		$lang_default = \App\CmsLang::create(['name' => 'Español', 'code_iso' => 'es-PE', 'active'=>'1']);

		//=============================================================================================================================

		// Seeding crm_forms
		$form_contact = \App\CrmForm::create(['name' => 'Formulario de Contacto', 'alias'=>'contacto', 'active'=>'1']);


		// Seeding crm_form_fields
		//$form_contact_fields = \App\CrmFormField::create(['form_id' => $form_denuncia->id, 'name' => 'Infraestructura', 'alias'=>'infraestructura', 'type'=>'4', 'active'=>'1']);
		//$form_upload_fields = \App\CrmFormField::create(['form_id' => $form_denuncia->id, 'name' => 'Upload', 'alias'=>'upload', 'type'=>'5', 'active'=>'1']);


		// Seeding profiles
		$perfil_sa = \App\Profile::create(['name' => 'Super Admin', 'active'=>'1', 'sa'=>'1']);
		$perfil_admin = \App\Profile::create(['name' => 'Admin', 'active'=>'1']);
		$perfil_webmaster = \App\Profile::create(['name' => 'Webmaster', 'active'=>'1']);


		// Seeding users
		$user_admin = \App\User::create(['email' => 'fishdev@gmail.com', 'password' => 'admin', 'name' => 'Administrador', 'profile_id' => $perfil_sa->id, 'active' => '1', 'default' => '1']);
		$user_admin = \App\User::create(['email' => 'gcoquis@asixonline.com', 'password' => 'asixon', 'name' => 'Gabriela Coquis', 'profile_id' => $perfil_admin->id, 'active' => '1']);


		// Seeding menus
		$menu_home = \App\AdmMenu::create(['name' => 'Inicio', 'position'=>'0', 'active'=>'0']);
		$menu_conf = \App\AdmMenu::create(['name' => 'Configuración', 'icon' => 'fa-gear', 'position'=>'1', 'active'=>'1']);
		$menu_info = \App\AdmMenu::create(['name' => 'Información general', 'icon' => 'fa-info-circle', 'position'=>'2', 'active'=>'1']);
		$menu_webs = \App\AdmMenu::create(['name' => 'Website Principal', 'icon' => 'fa-sitemap', 'position'=>'3', 'active'=>'1']);

		$menu_back = \App\AdmMenu::create(['parent_id'=>$menu_conf->id, 'name' => 'Administrador', 'icon' => 'fa-dashboard', 'position'=>'1', 'active'=>'1']);
		$menu_web = \App\AdmMenu::create(['parent_id'=>$menu_conf->id, 'name' => 'Website', 'icon' => 'fa-sitemap', 'position'=>'2', 'active'=>'1']);
		$menu_cms = \App\AdmMenu::create(['parent_id'=>$menu_conf->id, 'name' => 'CMS', 'icon' => 'fa-edit', 'position'=>'3', 'active'=>'1']);
		$menu_forms = \App\AdmMenu::create(['parent_id'=>$menu_info->id, 'name' => 'Formularios', 'icon' => 'fa-list-alt', 'position'=>'2', 'active'=>'1']);
		$menu_param = \App\AdmMenu::create(['parent_id'=>$menu_info->id, 'name' => 'Parámetros de Sistema', 'icon' => 'fa-cogs', 'position'=>'1', 'active'=>'1']);
		$module_contenido = \App\AdmMenu::create(['parent_id'=>$menu_webs->id, 'name' => 'Contenido Web', 'icon' => 'fa-globe', 'position'=>'1', 'active'=>'1']);


		// Seeding adm_modules
		$module_inicio = \App\AdmModule::create(['menu_id' => $menu_home->id, 'name' => 'Dashboard', 'controller' => 'home', 'position'=>'0', 'active'=>'1']);
		$module_acceso = \App\AdmModule::create(['menu_id' => $menu_home->id, 'name' => 'Acceso al Sistema', 'controller' => 'login', 'position'=>'0', 'active'=>'1']);
		$module_usradm = \App\AdmModule::create(['menu_id' => $menu_back->id, 'name' => 'Usuarios del Sistema', 'title' => 'usuario', 'controller' => 'user', 'icon'=>'fa-user', 'position'=>'1', 'active'=>'1']);
		$module_perfil = \App\AdmModule::create(['menu_id' => $menu_back->id, 'name' => 'Perfiles', 'title' => 'perfil', 'controller' => 'profile', 'icon'=>'fa-male', 'position'=>'2', 'active'=>'1']);
		$module_reglog = \App\AdmModule::create(['menu_id' => $menu_back->id, 'name' => 'Registro de Logs', 'title' => 'log', 'controller' => 'log', 'icon'=>'fa-book', 'position'=>'3', 'active'=>'1']);
		$module_idioma = \App\AdmModule::create(['menu_id' => $menu_web->id, 'name' => 'Idiomas', 'title' => 'idioma', 'controller' => 'lang', 'icon'=>'fa-flag', 'position'=>'2', 'active'=>'1']);
		$module_transl= \App\AdmModule::create(['menu_id' => $menu_web->id, 'name' => 'Traducciones', 'title' => 'traducción', 'controller' => 'translate', 'icon'=>'fa-list', 'position'=>'4', 'active'=>'1']);
		$module_usrweb = \App\AdmModule::create(['menu_id' => $menu_web->id, 'name' => 'Usuarios de la Web', 'title' => 'usuario', 'controller' => 'webuser', 'icon'=>'fa-users', 'position'=>'5', 'active'=>'0']);
		$module_config = \App\AdmModule::create(['menu_id' => $menu_cms->id, 'name' => 'Configuración', 'title' => 'configuración', 'controller' => 'config', 'icon'=>'fa-cog', 'position'=>'3', 'active'=>'1']);
		$module_mensaje= \App\AdmModule::create(['menu_id' => $menu_forms->id, 'name' => 'Mensajes recibidos', 'title' => 'mensaje', 'controller' => 'register', 'icon'=>'fa-inbox', 'position'=>'1', 'active'=>'1']);
		$module_cuenta = \App\AdmModule::create(['menu_id' => $menu_forms->id, 'name' => 'Cuentas de correo', 'title' => 'cuenta', 'controller' => 'notify', 'icon'=>'fa-at', 'position'=>'2', 'active'=>'1']);
		$module_article = \App\AdmModule::create(['menu_id' => $module_contenido->id, 'name' => 'Páginas', 'title' => 'contenido', 'controller' => 'article', 'icon'=>'fa-file', 'position'=>'1', 'active'=>'1']);
		$module_schema = \App\AdmModule::create(['menu_id' => $menu_cms->id, 'name' => 'Esquemas', 'title' => 'esquema', 'controller' => 'schema', 'icon'=>'fa-random', 'position'=>'8', 'active'=>'1']);
		$module_directory = \App\AdmModule::create(['menu_id' => $menu_cms->id, 'name' => 'Directorio de Archivos', 'title' => 'directorio', 'controller' => 'directory', 'icon'=>'fa-folder-open', 'position'=>'2', 'active'=>'1']);
		$module_parameter = \App\AdmModule::create(['menu_id' => $menu_param->id, 'name' => 'Parámetros', 'title' => 'parámetro', 'controller' => 'parameter', 'icon'=>'fa-bell', 'position'=>'1', 'active'=>'1']);


		// Seeding adm_actions
		$action_lista = \App\AdmAction::create(['name' => 'Listar (solo lectura)', 'alias'=>'listar', 'write_log'=>'0']);
		$action_admin = \App\AdmAction::create(['name' => 'Administrar (agregar/modificar/eliminar)', 'alias'=>'administrar', 'write_log'=>'1']);
		$action_login = \App\AdmAction::create(['name' => 'Login (ingresar al sistema)', 'alias'=>'login', 'write_log'=>'1']);
		$action_logout = \App\AdmAction::create(['name' => 'Logout (salir del sistema)', 'alias'=>'logout', 'write_log'=>'1']);

		
		// Seeding adm_events
		\App\AdmEvent::create(['module_id' => $module_acceso->id, 'action_id' => $action_login->id]);
		\App\AdmEvent::create(['module_id' => $module_acceso->id, 'action_id' => $action_logout->id]);
		\App\AdmEvent::create(['module_id' => $module_usradm->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_usradm->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_perfil->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_perfil->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_reglog->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_reglog->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_idioma->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_idioma->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_transl->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_transl->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_usrweb->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_usrweb->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_config->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_config->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_schema->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_schema->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_directory->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_directory->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_mensaje->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_mensaje->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_cuenta->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_cuenta->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_parameter->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_parameter->id, 'action_id' => $action_admin->id]);
		\App\AdmEvent::create(['module_id' => $module_article->id, 'action_id' => $action_lista->id]);
		\App\AdmEvent::create(['module_id' => $module_article->id, 'action_id' => $action_admin->id]);

	}

}
