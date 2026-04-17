<?php 
    // definir funcion de seguridad para evitar el acceso directo al archivo 
    defined('ABSPATH') or die('¡No tienes permiso para acceder a este 
archivo!'); 
    // Registrar el Custom Post Type de habitaciones 
    function alquilha_registrar_cpt_habitaciones() { 
        $labels = array( 
            'name' => 'Habitaciones', 
            'singular_name' => 'Habitación', 
            'menu_name' => 'Habitaciones', 
            'name_admin_bar' => 'Habitación', 
            'add_new' => 'Añadir nueva', 
            'add_new_item' => 'Añadir nueva habitación', 
            'new_item' => 'Nueva habitación', 
            'edit_item' => 'Editar habitación', 
            'view_item' => 'Ver habitación', 
            'all_items' => 'Todas las habitaciones', 
            'search_items' => 'Buscar habitaciones', 
            'parent_item_colon' => '', 
            'not_found' => 'No se han encontrado habitaciones.', 
            'not_found_in_trash' => 'No se han encontrado habitaciones en la papelera.' 
        ); 
        $argumentos = array( 
            'labels' => $labels,   
            'public' => true, // El cpt es público 
            'has_archive' => true, // tiene archivo de habitaciones 
            'menu_icon' => 'dashicons-admin-home', // Icono del menú del cpt             
            'rewrite' => array('slug' => 'habitaciones'), // Slug del cpt 
            'supports' => array('title', 'editor', 'thumbnail'), 
            'show_in_rest' => true, // Habilitar para el editor de bloques 
            'capability_type' => ['habitacion','habitaciones'], // Tipo de capacidad personalizada 
            'map_meta_cap' => true, // Mapear las capacidades personalizadas 
        ); 
        register_post_type('habitaciones', $argumentos); 
    } 
    // Registrar el Custom Post Type de habitaciones utilizando el gancho 'init' 
    add_action('init', 'alquilha_registrar_cpt_habitaciones');