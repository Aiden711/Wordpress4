<?php 
/** 
* Plugin Name: Alquilha 
* Description: Alquilha es un plugin que gestiona viviendas con sus 
habitaciones para alquiler. 
* Version: 1.0 
* Requires at least: 5.0 
* Requires PHP: 7.0 
* Author: Iván García
* Author URI: https://centrogesfor.com 
* License: GPL2 
* License URI: https://www.gnu.org/licenses/gpl-2.0.html 
*/ 
// Evitar el acceso directo al archivo 
defined('ABSPATH') or die('¡No tienes permiso para acceder a este 
archivo!'); 
// Definir la constante del plugin para usarla en todo el código 
define('ALQUILHA_URL', plugin_dir_url(__FILE__)); 
// Registrar los roles personalizados 
require_once plugin_dir_path(__FILE__) . 'includes/roles.php'; 
// Registrar el activador del plugin con las funciones 
// de activación y desactivación 
require_once plugin_dir_path(__FILE__) . 'includes/activacion.php'; 
// Insertar los ganchos de activación y desactivación del plugin 
register_activation_hook(__FILE__, 'alquilha_activar_plugin'); 
register_deactivation_hook(__FILE__, 'alquilha_desactivar_plugin'); 
// Realizar el registro de los tipos de contenido personalizados 
// en archivos separados para mantener el código organizado 
require_once plugin_dir_path(__FILE__) . 'includes/cpt-viviendas.php'; 
require_once plugin_dir_path(__FILE__) . 'includes/cpt-habitaciones.php'; 
// Opciones de visualizacion en el admin para el cpt de viviendas 
require_once plugin_dir_path(__FILE__) . 'includes/admin-display.php'; 
// Metabox y campos personalizados para el cpt de viviendas 
require_once plugin_dir_path(__FILE__) . 'includes/metaboxes-viviendas.php';