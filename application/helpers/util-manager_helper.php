<?

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 *
 * @package		GestionCMS
 * @category	Helpers
 * @author		Ivan Fretes
 */



// Verify the 'Ñ' letter	
if (! function_exists('verify_chars')){
	function verify_chars($value){
		return str_replace('Ã‘', 'Ñ', $value);
	}
}




/**
 * Soluciona inconvenietes con el X frame, 
 * Busca entre todos los proveedores de video existentes
 * 
 * @var {string} $abbr_url : url abreviada (enlace a remplazar) 
 * @var {string} $embed_url : nueva url (enlace remplazador)
 * @var {array} $video_providers : Proveedores de Video
 * 
 * @param {string} $video_abbr_url, URL sin modificar
 * @param {string} $video_other_provider : No implemando, 
 * 		   pero la idea es que sean otros proveedores de video 
 * 
 * @return {string} : la nueva url o
 * 		   {boolean} : no se encontro url  
 */
if (! function_exists('video_embed_provider')){
	function video_embed_provider($video_abbr_url, 
								  $video_other_provider = array()){

		$video_providers = array('youtu.be' =>  'www.youtube.com/embed'); 

		foreach ($video_providers as $abbr_url => $embed_url ) {
			// Si coincide el enlace abreviado con el del proveedor
			if (FALSE !== strpos(strtolower($video_abbr_url) , $abbr_url)){

				// Nueva url del video
				$video_url = str_replace($abbr_url, $embed_url, 
										 $video_abbr_url);
				return $video_url;
			}
		}

		return FALSE;
	}
}



/**
 * Paginacion por defecto
 * 
 * @param {number} : cantidad de filas
 */
if (! function_exists('pagination_custom')){
	function pagination_custom($per_page, $total_row,$custom_config = array()){
		
		//$ci = & get_instance();

		// Cantidad total de Filas
		$config['total_rows'] = $total_row;

        $config['base_url'] = '';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 2;
        $config['full_tag_open'] = `<nav aria-label="Pagination">
        								<ul class="pagination">`;
        $config['full_tag_close'] = '</ul></nav>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_link'] = '«';
        $config['last_link'] = '»';
        $config['next_link'] = '';
        $config['prev_link'] = '';
		

        // Agregamos o sobreescribimos la configuracion por defecto
		if (0 < count($custom_config)){
			foreach ($custom_config as $key => $value) {
				$config[$key] = $value;
			}	
		}
		
		//$ci->load->library('pagination');
		//$ci->pagination->initialize($config);
		return $config;
		
	}
} 



/**
 * Generamos un mensaje JSON
 */
if (! function_exists('print_json_msg')){
	function print_json_msg($msg, $error){

		echo json_encode(array('msg' => $msg, 
								'error' => $error ));
		
	}
}



/**
 * Genera el listado de menu a mostrarse en la vista del front
 * 
 * @return {void}
 */
/*if (! function_exists('get_menu_front')){
	function get_menu_front(){
		$ci = & get_instance();
		
		$ci->load->model('General/menu_model','menu_model');
		
		$data['list_menu'] = $ci->menu_model->get_all_menu();
		$ci->load->view('frontend/theme/nav',$data);
	}
}*/


/**
 * Verifica si los campos del formulario, deben tener valores 
 * por defecto, es decir agregar el attr 'value', del tag 
 * <input value='...'> 
 * 
 * Si tiene un valor asignado crea el attr value
 * @example <input type="x" value="value">
 * 
 * @param {mixed} $value referencia al valor del campo
 * @return {string} : 
 */
if (! function_exists('default_value_input')){
	function default_value_input(&$value){
		
		if (not_value($value))
			return '';

		return "value=\"$value\"";
	}
}



/**
 * Verifica si un checkbox, tiene algun valor asignado
 * 
 * Si tiene un valor asignado crea el attr value
 * @example <input type="x" value="value">
 * 
 * @param {mixed} $value referencia al valor del campo
 * @return {string} : 
 */
if (! function_exists('default_value_icheckbox')){
	function default_value_icheckbox(&$value, $checked_disable ,
									 $disabled = FALSE){
		
		$t = '';

		if (TRUE === $disabled)
			$t .= ' disabled ';

		if (NULL !== $value)
			$t .= ' checked ';
		
		
		return $t;

	}
}





/**
 * Verifica si el campo select del formulario, tiene un valor
 * por defecto asignado, en dicho caso agrega el atributo selected
 * a la opcion seleccionada 
 * 
 * @example <option selected>
 *
 * @param {array} $options : listado de opciones
 * @param {string} $option_value : <option value="option_value" >
 * @param {string} $option_name : <option>option_name</option> 
 * @param {mixed} $selected : valor del <option selected> 
 * 
 * @return {void}
 */
if (! function_exists('default_value_select')){
	function default_value_select($option_list, $option_value, 
								  $option_name, &$selected){

		foreach ($option_list as $option) {

			echo "<option value=\"{$option[$option_value]}\"";
			if (isset($selected) && 
				$option[$option_value] == $selected)
				echo ' selected >';
			else
				echo '>';

			echo $option[$option_name]."</option>";
		}
			
	}
}


/**
 * Verifica un <select> solo con los parametros un listado
 * para algo mas complejo como gererar de la base de datos
 * vea default_value_select()
 * 
 * @example <option selected>
 *
 * @param {array} $options : listado de opciones
 * @param {mixed} $selected : valor del <option selected> 
 * 
 * @return {void}
 */
if (! function_exists('default_value_select2')){
	function default_value_select2($option_list, &$selected){

		foreach ($option_list as $value => $name) {

			echo "<option value=\"{$value}\"";
			if (isset($selected) && $value == $selected)
				echo ' selected >';
			else
				echo '>';

			echo $name."</option>";
		}
			
	}
}


/**
 * 
 * -- No implementado --
 * Lista todos los assets, <link> or <script>
 * 
 * El orden de ubicacion es el mismo en el cual se encuentra asignados 
 * los indices
 * 
 * @param {array} $asset_list : Listado de link, reconoce dependiendo 
 * de la extension del archivo
 * 
 * @return {void}
 * 
 */
if (! function_exists('assets_files')){
	function assets_files($asset_list = array()){

		// Opcion de tipo de etique a ser generada o link o 
		//$assets_option = array('' => );

		foreach ($asset_list as $source) {
			

			// Si no es un array
			if (!is_array($link)){

				$source = base_url($source);

				
			}
			else {
				echo 'Plan b';
			}


		}

	}
}



/**
 * 
 * -- No implementado --
 * 
 * @example
 * 
 * @param {string} $asset_value
 * @return {string} : Retorna la etiqueta generada
 * 
 */
if (! function_exists('generate_script')){
	function generate_script($script_link){

		return "<script type=\"text/javascript\" src=\"$script_link\">
				 </script>";

	}
}


/**
 * 
 * -- No implementado --
 * 
 * Genera estructuras del tipo link rel
 * 
 * Enlace
 * 
 */
if (! function_exists('generate_link_rel')){
	function generate_link_rel($asset_value){


		// Listado de posibles elementos del tipo link rel
		//$link_rel_list = array('' => , );

	}
}


/**
 * Genera la fila inicial, por página, teniendo 
 * en cuanta la cantidad de filas solicitadas,
 * 
 * Por ej: sirve para el registro inicial de un LIMIT x, 20
 * 
 * @param {number} $page_init : nro de pagina
 * @param {number} $cant : cantidad de registros a visualizar
 * 
 * @return {number} : el registro inicial de conteo
 */

if (! function_exists('set_init_row')){

	function get_init_row($page_init, $cant){
		return ($page_init - 1) * $cant;
	}
}



/**
 * Verifica si se contiene datos, 
 * son nulos, cadenas sin contenido, o 0
 * 
 * 
 * @param {mixed} $data : referencia al valor inicializado
 * @return {boolean}
 */

if(! function_exists('not_value')){

	function not_value($data){
		
		if (!isset($data) || NULL === $data || 0 === $data || '' === $data)
			return TRUE;

		return FALSE;

	}

}


/**
 * Retorna la fecha actual
 * 
 * @return {string}
 */

if(! function_exists('current_date')){

	function current_date(){
		return date("Y-m-d H:i:s");
	}

}

/**
 * Retorna todos los numeros encontrtados en un string,
 * y los convierte en array
 * @param {string} $string 
 * 
 * @return {array}
 */
if (!function_exists('number_in_string')){
	function number_in_string($string){

		try {
			
			if (!is_string($string))
				throw new Exception("Error tipo de dato");

			preg_match_all("/\d+/", $string, $matches);

			// Retornamos los numeros encontrados
			return $matches[0];
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}
}

?>
