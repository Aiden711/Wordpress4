<?php 
// Función de registro del cpt de viviendas 
function alquilha_registrar_cpt_viviendas() { 
    $etiquetas = array( 
        'name' => 'Viviendas', // Nombre plural del cpt 
        'singular_name' => 'Vivienda', // Nombre singular del cpt 
        'menu_name' => 'Viviendas', // Nombre del menú en el panel de administración 
        'name_admin_bar' => 'Vivienda', // Nombre del menú barra de administración 
        'add_new' => 'Añadir nueva', // Texto del botón de añadir nueva 
        'add_new_item' => 'Añadir nueva vivienda', // Texto del botón de añadir nueva vivienda 
        'new_item' => 'Nueva vivienda', // Texto del botón de nueva vivienda 
        'edit_item' => 'Editar vivienda', // Texto del botón de editar vivienda 
        'view_item' => 'Ver vivienda', // Texto del botón de ver vivienda 
        'all_items' => 'Todas las viviendas', // Texto del botón de todas las viviendas 
        'search_items' => 'Buscar viviendas', // Texto del botón de buscar viviendas 
        'parent_item_colon' => '', // Texto del botón de vivienda padre (no se utiliza en este caso) 
        'not_found' => 'No se han encontrado viviendas.', // Texto del mensaje de no se han encontrado viviendas 
        'not_found_in_trash' => 'No se han encontrado viviendas en la papelera.', // Texto del mensaje de no se han encontrado viviendas en la papelera 
    ); 
    $argumentos = array( 
        'labels' => $etiquetas, // Etiquetas del cpt 
        'public' => true, // El cpt es público 
        'has_archive' => true, // El cpt tiene archivo 
        'menu_icon' => 'dashicons-admin-home', // Icono del menú del cpt 
        'rewrite' => array('slug' => 'viviendas'), // Slug del cpt 
        'supports' => array('title', 'editor', 'thumbnail'), // Soporta título, editor y miniatura 
        'show_in_rest' => true, // Mostrar el cpt en la API REST 
        'capability_type' => 'vivienda', // Tipo de capacidad personalizada para el cpt 
        'map_meta_cap' => true, // Mapear las capacidades personalizadas al rol de usuario 
    ); 
    register_post_type('viviendas', $argumentos); // Registrar el cpt de viviendas 
} 
 
// Registrar el cpt de viviendas en el hook 'init' 
add_action('init', 'alquilha_registrar_cpt_viviendas'); 