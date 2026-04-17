<?php 
    // Definir función de seguridad para evitar el acceso directo al archivo 
    defined('ABSPATH') or die('¡No tienes permiso para acceder a este archivo!'); 
 
    // Agregar scripts y estilos para el metabox de habitaciones 
    function alquilha_enqueue_scripts_metabox_habitaciones($hook) { 
        // Se obtiene el tipo de post actual para asegurarse de que el  
        // script solo se cargue en el cpt de habitaciones 
        global $post_type; 
        if ($post_type !== 'habitaciones') { 
            return; // Si no es el cpt de habitaciones, salir de la función 
        } 
        // Se registra el script de alpine.js cargando desde el directorio 
        // del plugin assets/js/alpine.js 
        wp_enqueue_script( 
            'alpinejs', // Handle del script 
            plugin_dir_url(__FILE__) . '../assets/js/alpine.js', // URL del script 
            ALQUILHA_URL . 'assets/js/alpine.js', 
            array(), // Dependencias (ninguna en este caso) 
            null, // Versión del script 
            false // la opción false indica que se carga en el header 
        ); 
        // Se registra el script personalizado para el metabox de habitaciones 
        wp_enqueue_script( 
            'alquilha_metabox_habitaciones', 
            ALQUILHA_URL . 'assets/js/metabox-habitaciones.js', 
            array('alpinejs'), 
            '1.0', 
            true 
        ); 
        // Se registra el estilo personalizado para el metabox de habitaciones 
        wp_enqueue_style( 
            'alquilha_metabox_habitaciones', // Handle del estilo 
            ALQUILHA_URL . 'assets/css/metabox-habitaciones.css', // URL del estilo 
            array(), // Dependencias (ninguna en este caso) 
            '1.0', // Versión del estilo 
        ); 
    } 
    // Poner en cola los scripts y estilos para el metabox de habitaciones 
    // utilizando el gancho 'admin_enqueue_scripts' 
    add_action('admin_enqueue_scripts', 'alquilha_enqueue_scripts_metabox_habitaciones'); 
 
    // Agregar metabox para el Custom Post Type de habitaciones 
    function alquilha_agregar_metabox_habitaciones() { 
        add_meta_box( 
            'alquilha_metabox_habitaciones', // ID del metabox 
            'Información de la habitación', // Título del metabox 
            'alquilha_render_metabox_habitaciones', // Función de renderizado del metabox 
            'habitaciones', // Pantalla en la que se mostrará el metabox (cpt de habitaciones) 
            'normal', // Contexto (normal, side, advanced) 
            'default' // Prioridad (default, low, high) 
        ); 
    } 
    // Registrar el metabox utilizando el gancho 'add_meta_boxes' 
    add_action('add_meta_boxes', 'alquilha_agregar_metabox_habitaciones'); 
 
    // Función de renderizado del metabox para habitaciones 
    function alquilha_render_metabox_habitaciones($post) { 
        // Obtener las viviendas asociadas a la habitación utilizando la función personalizada 
        $viviendas = get_posts(array( 
            'post_type' => 'viviendas', 
            'numberposts' => -1, 
        )); 
        $vivienda_identificador = get_post_meta($post->ID, 
'_ah_vivienda_identificador', true); 
        // Campo de seguridad para verificar el nonce al guardar los datos del metabox 
        wp_nonce_field('alquilha_guardar_metabox_habitaciones', 
'alquilha_nonce_habitaciones'); 
        // Obtener los valores guardados en los campos personalizados del metabox 
        $numerometros = get_post_meta($post->ID, '_ah_numerometros', 
true); 
        $numerocamas = get_post_meta($post->ID, '_ah_numerocamas', true); 
        $precio = get_post_meta($post->ID, '_ah_precio', true); 
        $mesaestudio = get_post_meta($post->ID, '_ah_mesaestudio', true); 
        $banoprivado = get_post_meta($post->ID, '_ah_banoprivado', true); 
        // Crear rutas para los iconos del metabox utilizando la constante del plugin 
        $iconos = ALQUILHA_URL . 'assets/iconos/'; 
        // Renderizar el contenido del metabox utilizando alpine.js para la interactividad 
        ?> 
        <div x-data="formHabitacion({ 
            numerometros: '<?php echo esc_attr($numerometros); ?>', 
            numerocamas: '<?php echo esc_attr($numerocamas); ?>', 
            precio: '<?php echo esc_attr($precio); ?>', 
            mesaestudio: <?php echo $mesaestudio ? 'true' : 'false'; ?>, 
            banoprivado: <?php echo $banoprivado ? 'true' : 'false'; ?>, 
        })"> 
            <!-- Metros cuadrados --> 
            <div class="alquilha-input-group"> 
                <img src="<?php echo $iconos; ?>metros.svg" alt="Metros cuadrados" class="alquilha-input-icon">
                <input type="number" x-model="numerometros" name="_ah_numerometros" placeholder="Metros cuadrados"> 
            </div> 
            <!-- Precio --> 
            <div class="alquilha-input-group"> 
                <img src="<?php echo $iconos; ?>precio.svg" alt="Precio" class="alquilha-input-icon"> 
                <input type="number" x-model="precio" name="_ah_precio" placeholder="Precio"> 
            </div> 
            <!-- Número de camas --> 
            <div class="alquilha-input-group" :class="numerocamas > 2 ? 'destacar' : ''"> 
                <img 
                    :src="numerocamas > 1 
                    ? '<?php echo $iconos; ?>camass.svg' 
                    : '<?php echo $iconos; ?>camas.svg'" 
                    class="alquilha-input-icon" alt="Número de camas"> 
                <input type="number" x-model="numerocamas" name="_ah_numerocamas" placeholder="Número de camas"> 
            </div> 
            <!-- Mesa de estudio --> 
            <div class="alquilha-input-group"> 
                <img src="<?php echo $iconos; ?>mesaestudio.svg" alt="Mesa de estudio" class="alquilha-input-icon"> 
                <label> 
                    <input type="checkbox" x-model="mesaestudio" name="_ah_mesaestudio"> 
                    Mesa de estudio 
                </label> 
            </div> 
            <!-- Banio privado --> 
            <div class="alquilha-input-group"> 
                <img src="<?php echo $iconos; ?>banyo.svg" alt="Baño privado" class="alquilha-input-icon"> 
                <label> 
                    <input type="checkbox" x-model="banoprivado" name="_ah_banoprivado"> 
                    Baño privado 
                </label> 
            </div> 
            <!-- Vivienda asociada --> 
            <div class="alquilha-input-group"> 
                <img src="<?php echo $iconos; ?>vivienda.svg" alt="Vivienda asociada" class="alquilha-input-icon"> 
                <select name="_ah_vivienda_identificador" x-model="vivienda_identificador"> 
                    <option value="">Selecciona una vivienda</option> 
                    <?php foreach ($viviendas as $vivienda) : ?> 
                        <option value="<?php echo esc_attr($vivienda->ID); ?>" <?php selected($vivienda_identificador, $vivienda->ID); ?>> 
                            <?php echo esc_html($vivienda->post_title); ?> 
                        </option> 
                    <?php endforeach; ?> 
                </select> 
            </div> 
        </div> 
                
        <?php 
    } 
    // Guardar los datos del metabox de habitaciones al guardar el post 
    function alquilha_guardar_metabox_habitaciones($post_id) { 
        // Verificar el nonce para asegurar que la solicitud es válida 
        if (!isset($_POST['alquilha_nonce_habitaciones']) || !wp_verify_nonce($_POST['alquilha_nonce_habitaciones'], 'alquilha_guardar_metabox_habitaciones')) { 
            return; // Si el nonce no es válido, salir de la función 
        } 
        // Verificar si es autoguardo para evitar guardar los datos del metabox durante el autoguardado 
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { 
            return; // Si es autoguardo, salir de la función 
        } 
        // Verificar si el usuario tiene permisos para editar el post 
        if (!current_user_can('edit_post', $post_id)) { 
            return; // Si el usuario no tiene permisos, salir de la función 
        } 
        // Guardar los valores de los campos personalizados del metabox utilizando update_post_meta 
        if (isset($_POST['_ah_numerometros'])) { 
            update_post_meta($post_id, '_ah_numerometros', sanitize_text_field($_POST['_ah_numerometros'])); 
        } 
        if (isset($_POST['_ah_numerocamas'])) { 
            update_post_meta($post_id, '_ah_numerocamas', sanitize_text_field($_POST['_ah_numerocamas'])); 
        } 
        if (isset($_POST['_ah_precio'])) { 
            update_post_meta($post_id, '_ah_precio', sanitize_text_field($_POST['_ah_precio'])); 
        } 
        update_post_meta($post_id, '_ah_mesaestudio', isset($_POST['_ah_mesaestudio']) ? '1' : '0'); 
        update_post_meta($post_id, '_ah_banoprivado', isset($_POST['_ah_banoprivado']) ? '1' : '0'); 
        if (isset($_POST['_ah_vivienda_identificador'])) { 
            update_post_meta($post_id, '_ah_vivienda_identificador', sanitize_text_field($_POST['_ah_vivienda_identificador'])); 
        } 
    } 
    // Registrar la función de guardado del metabox utilizando el gancho 'save_post' 
    add_action('save_post', 'alquilha_guardar_metabox_habitaciones');