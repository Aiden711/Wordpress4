<?php 
// Seguridad: Evitar el acceso directo al archivo 
defined('ABSPATH') or die('¡No tienes permiso para acceder a este 
archivo!'); 
// Poner en cola el script alpine.js para el metabox de viviendas 
function alquilha_enqueue_scripts_metabox_viviendas($hook) 
{ 
// Se obtiene el tipo de post actual 
// para asegurarse de que el script solo se cargue en  
    // el cpt de viviendas 
    global $post_type; 
    if ($post_type !== 'viviendas') { 
        return; // Si no es el cpt de viviendas, salir de la función 
    } 
    // Se registra el script de alpine.js cargando desde el directorio 
    // del plugin assets/js/alpine.js 
    wp_enqueue_script( 
        'alpinejs', // Handle del script 
        plugin_dir_url(__FILE__) . '../assets/js/alpine.js', // URL del script 
        ALQUILHA_URL . 'assets/js/alpine.js', 
        array(), // Dependencias (ninguna en este caso) 
        null, // Versión del script 
        false // Cargar el script en el footer 
    ); 
    /* 
    wp_enqueue_script( 
        'alpinejs', 
        'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js', 
        array(), 
        null, 
        false // IMPORTANTE (cargar en el header para que esté disponible 
en el metabox) 
    );*/ 
    // Se registra el script personalizado para el metabox de viviendas 
    wp_enqueue_script( 
        'alquilha_metabox_vivienda_info', 
        ALQUILHA_URL . 'assets/js/metabox-viviendas.js', 
        array('alpinejs'), 
        '1.0', 
        true 
    ); 
    // Se registra el estilo personalizado para el metabox de viviendas 
    wp_enqueue_style( 
        'alquilha_metabox_vivienda_info', // Handle del estilo 
        ALQUILHA_URL . 'assets/css/metabox-viviendas.css', // URL del estilo 
        array(), // Dependencias (ninguna en este caso) 
        '1.0', // Versión del estilo 
    ); 
} 
// Poner en cola los scripts y estilos para el metabox de viviendas   
// utilizando el gancho 'admin_enqueue_scripts' 
add_action('admin_enqueue_scripts', 
'alquilha_enqueue_scripts_metabox_viviendas'); 
 
// Agregar el atributo defer al script de alpine.js para mejorar el rendimiento 
// defer permite que el script se cargue de forma asíncrona sin bloquear 
// la renderización de la página 
add_filter('script_loader_tag', function ($tag, $handle) { 
    if ($handle === 'alpinejs') { 
        return str_replace('<script ', '<script defer ', $tag); 
    } 
    return $tag; 
}, 10, 2); 
 
// Función para agregar metaboxes al cpt de viviendas 
function alquilha_agregar_metaboxes_viviendas() 
{ 
    add_meta_box( 
        'alquilha_metabox_vivienda_info', // ID del metabox 
        'Información de la Vivienda', // Título del metabox 
        'alquilha_renderizar_metabox_vivienda_info', // Función de renderizado del metabox 
        'viviendas', // Pantalla donde se mostrará el metabox (cpt de viviendas) 
        'normal', // Contexto (normal, side, advanced) 
        'default' // Prioridad (default, low, high) 
    ); 
} 
// Registrar los metaboxes para el cpt de viviendas en el hook 'add_meta_boxes' 
add_action('add_meta_boxes', 'alquilha_agregar_metaboxes_viviendas'); 
 
// Función para renderizar el contenido del metabox de información de la vivienda 
function alquilha_renderizar_metabox_vivienda_info($post) 
{ 
    // Campo de seguridad 
    wp_nonce_field('alquilha_guardar_metabox_vivienda_info', 
'alquilha_metabox_vivienda_info_nonce'); 
    // Obtener los valores guardados previamente (si existen) 
    $direccion = get_post_meta($post->ID, '_av_direccion', true); 
    $metros = get_post_meta($post->ID, '_av_metros', true); 
    $habitaciones = get_post_meta($post->ID, '_av_habitaciones', true); 
    $banyos = get_post_meta($post->ID, '_av_banyos', true); 
    $precio = get_post_meta($post->ID, '_av_precio', true); 
    $parking = get_post_meta($post->ID, '_av_parking', true); 
    // Renderizar el formulario del metabox con los campos personalizados 
    // utilizando alpine.js para la interactividad y el diseño del formulario 
    // tipo multipaso con un paso para cada dos campos personalizado 
?> 
    <!-- Contenedor principal del formulario con Alpine.js --> 
    <div x-data="formVivienda({ 
        direccion: '<?php echo esc_attr($direccion); ?>', 
        metros: '<?php echo esc_attr($metros); ?>', 
        habitaciones: '<?php echo esc_attr($habitaciones); ?>', 
        banyos: '<?php echo esc_attr($banyos); ?>', 
        precio: '<?php echo esc_attr($precio); ?>', 
        parking: <?php echo $parking ? 'true' : 'false'; ?>, 
    })"> 
        <!-- Paso No. 1 solicitar direccion y metros --> 
        <div x-show="step === 1"> 
            <h3>No. 1</h3> 
            <input data-campo="direccion" type="text" name="_av_direccion" x-model="direccion" placeholder="Dirección"> 
            <input data-campo="metros" type="number" name="_av_metros" x-model="metros" placeholder="Metros cuadrados"> 
        </div> 
        <!-- Paso No. 2 solicitar habitaciones y banyos --> 
        <div x-show="step === 2"> 
            <h3>No. 2</h3> 
            <input data-campo="habitaciones" type="number" name="_av_habitaciones" x-model="habitaciones" placeholder="Habitaciones"> 
            <input data-campo="banyos" type="number" name="_av_banyos" x-model="banyos" placeholder="banyos"> 
        </div> 
        <!-- Paso No. 3 solicitar precio y parking --> 
        <div x-show="step === 3"> 
            <h3>No. 3</h3> 
            <input data-campo="precio" type="number" name="_av_precio" x-model="precio" placeholder="Precio"> 
            <p>Parking: 
            <div class="checkbox-wrapper-18"> 
                <div class="check"> 
                    <input id="check-5" type="checkbox" name="_av_parking" x-model="parking"> 
                    <label for="check-5"></label> 
                </div> 
            </div> 
            </p> 
        </div> 
        <!-- Boton Siguiente y Anterior --> 
        <button class="button button-primary button-large" type="button" @click="prev()">Anterior</button> 
        <button class="button button-primary button-large" type="button" @click="next()">Siguiente</button> 
    </div> 
    <!-- /Contenedor principal del formulario con Alpine.js --> 
<?php 
} 
 
// Función para guardar los datos del metabox de información de la vivienda 
function alquilha_guardar_metabox_vivienda_info($post_id) 
{ 
    // Verificar el nonce de seguridad 
    if (!isset($_POST['alquilha_metabox_vivienda_info_nonce']) || 
!wp_verify_nonce($_POST['alquilha_metabox_vivienda_info_nonce'], 
'alquilha_guardar_metabox_vivienda_info')) { 
        return; // Si el nonce no es válido, salir de la función 
    } 
    // Verificar si el usuario tiene permisos para editar el post 
    if (!current_user_can('edit_viviendas', $post_id)) { 
        return; // Si el usuario no tiene permisos, salir de la función 
    } 
    // Guardar los datos del metabox en los campos personalizados del post 
    if (isset($_POST['_av_direccion'])) { 
        update_post_meta($post_id, '_av_direccion', sanitize_text_field($_POST['_av_direccion'])); 
    } 
    if (isset($_POST['_av_metros'])) { 
        update_post_meta($post_id, '_av_metros', sanitize_text_field($_POST['_av_metros'])); 
    } 
    if (isset($_POST['_av_habitaciones'])) { 
        update_post_meta($post_id, '_av_habitaciones', sanitize_text_field($_POST['_av_habitaciones'])); 
    } 
    if (isset($_POST['_av_banyos'])) { 
        update_post_meta($post_id, '_av_banyos', sanitize_text_field($_POST['_av_banyos'])); 
    } 
    if (isset($_POST['_av_precio'])) { 
        update_post_meta($post_id, '_av_precio', sanitize_text_field($_POST['_av_precio'])); 
    } 
    $parking_value = isset($_POST['_av_parking']) ? '1' : '0'; 
    update_post_meta($post_id, '_av_parking', $parking_value); 
} 
 
// Registrar la función de guardado del 
// metabox en el hook 'save_post' para el cpt de viviendas 
add_action('save_post_viviendas', 
'alquilha_guardar_metabox_vivienda_info');