<?php 
// Funcion para registrar los roles personalizados 
function alquilha_registrar_roles() { 
    // Se elimina el rol de gerente si existe 
    if (get_role('gerente')) { 
        remove_role('gerente'); 
    } 
    // Se crea el rol de gerente con capacidades específicas 
    // sobre el cpt de viviendas y habitaciones 
    add_role('gerente', 'Gerente de Alquilha', array( 
        'read' => true, // Permite leer el sitio 
        'edit_vivienda' => true, // Permite editar viviendas individuales 
        'read_vivienda' => true, // Permite leer viviendas individuales 
        'delete_vivienda' => true, // Permite eliminar viviendas individuales 
        'publish_vivienda' => true, // Permite publicar viviendas individuales 
        'edit_viviendas' => true, // Permite editar el listado de viviendas 
        'read_viviendas' => true, // Permite leer el listado de viviendas 
        'delete_viviendas' => true, // Permite eliminar el listado de viviendas 
        'publish_viviendas' => true, // Permite publicar el listado de viviendas 
        'edit_others_viviendas' => true, // Permite editar viviendas de otros usuarios 
        'edit_published_viviendas' => true, // Permite editar viviendas publicadas
        'read_private_viviendas' => true, // Permite leer viviendas privadas 
        'delete_others_viviendas' => true, // Permite eliminar viviendas de otros usuarios 
        'delete_private_viviendas' => true, // Permite eliminar viviendas privadas 
        'delete_published_viviendas' => true, // Permite eliminar viviendas publicadas 
        'edit_habitacion' => true, // Permite editar habitaciones individuales 
        'read_habitacion' => true, // Permite leer habitaciones individuales 
        'delete_habitacion' => true, // Permite eliminar habitaciones individuales 
        'publish_habitacion' => true, // Permite publicar habitaciones individuales 
        'edit_habitaciones' => true, // Permite editar el listado de habitaciones 
        'read_habitaciones' => true, // Permite leer el listado de habitaciones 
        'delete_habitaciones' => true, // Permite eliminar el listado de habitaciones 
        'publish_habitaciones' => true, // Permite publicar el listado de habitaciones 
        'edit_others_habitaciones' => true, // Permite editar habitaciones de otros usuarios 
        'edit_published_habitaciones' => true, // Permite editar habitaciones publicadas 
        'read_private_habitaciones' => true, // Permite leer habitaciones privadas 
        'delete_others_habitaciones' => true, // Permite eliminar habitaciones de otros usuarios 
        'delete_private_habitaciones' => true, // Permite eliminar habitaciones privadas 
        'delete_published_habitaciones' => true, // Permite eliminar habitaciones publicadas 
    )); 
} 
 
// Funcion para añadir capacidades sobre los cpt a los administradores 
function alquilha_asignar_capacidades_administradores() { 
    // Obtener el rol de administrador 
    $admin_role = get_role('administrator'); 
    // si es administrador, se le asignan las capacidades sobre 
    // los cpt de viviendas y habitaciones 
    if($admin_role) { 
        // capacidad cpt vivienda individual  
        $admin_role->add_cap('edit_vivienda'); 
        $admin_role->add_cap('read_vivienda'); 
        $admin_role->add_cap('delete_vivienda'); 
        $admin_role->add_cap('publish_vivienda'); 
        // capacidad cpt vivienda general 
        $admin_role->add_cap('edit_viviendas'); 
        $admin_role->add_cap('read_viviendas'); 
        $admin_role->add_cap('delete_viviendas'); 
        $admin_role->add_cap('publish_viviendas'); 
        $admin_role->add_cap('edit_others_viviendas'); 
        $admin_role->add_cap('edit_published_viviendas'); 
        $admin_role->add_cap('read_private_viviendas'); 
        $admin_role->add_cap('delete_others_viviendas'); 
        $admin_role->add_cap('delete_private_viviendas'); 
        $admin_role->add_cap('delete_published_viviendas'); 
        // capacidad cpt habitacion individual 
        $admin_role->add_cap('edit_habitacion'); 
        $admin_role->add_cap('read_habitacion'); 
        $admin_role->add_cap('delete_habitacion'); 
        $admin_role->add_cap('publish_habitacion'); 
        // capacidad cpt habitacion general 
        $admin_role->add_cap('edit_habitaciones'); 
        $admin_role->add_cap('read_habitaciones'); 
        $admin_role->add_cap('delete_habitaciones'); 
        $admin_role->add_cap('publish_habitaciones'); 
        $admin_role->add_cap('edit_others_habitaciones'); 
        $admin_role->add_cap('edit_published_habitaciones'); 
        $admin_role->add_cap('read_private_habitaciones'); 
        $admin_role->add_cap('delete_others_habitaciones'); 
        $admin_role->add_cap('delete_private_habitaciones'); 
        $admin_role->add_cap('delete_published_habitaciones'); 
    } 
} 
// añadir funcion de registro de capacidades 
//add_action('init', 'alquilha_asignar_capacidades_administradores'); 