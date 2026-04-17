<?php 
// Seguridad: Evitar el acceso directo al archivo 
defined('ABSPATH') or die('¡No tienes permiso para acceder a este 
archivo!'); 
    // funcion que desactiva el editor de bloques de wordpress para el cpt de viviendas 
    function 
alquilha_desactivar_editor_bloques_viviendas($use_block_editor, 
$post_type) { 
        // Si el tipo de post es 'viviendas', desactivar el editor de bloques 
        if ($post_type === 'viviendas' || $post_type === 'habitaciones') { 
            return false; // Desactivar el editor de bloques para el cpt de viviendas 
        } 
        // Mantener el editor de bloques para otros tipos de contenido     
        return $use_block_editor;  
    } 
    // Registrar la función para desactivar el editor de  
    // bloques en el hook 'use_block_editor_for_post_type' 
    add_filter('use_block_editor_for_post_type', 
'alquilha_desactivar_editor_bloques_viviendas', 10, 2);