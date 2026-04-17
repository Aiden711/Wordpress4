<?php 
// Funcion de activacion del plugin 
function alquilha_activar_plugin() { 
    // Registrar los roles personalizados 
    alquilha_registrar_roles(); 
    // Actualizacion de las reglas de reescritura para que  
    // los cpt funcionen correctamente 
    flush_rewrite_rules(); 
    // Asignar capacidades sobre los cpt a los administradores 
    alquilha_asignar_capacidades_administradores(); 
} 
 
// Funcion de desactivacion del plugin 
function alquilha_desactivar_plugin() { 
    // Las opciones de eliminacion de capacidades y roles 
    // se realizan en el archivo de desinstalacion del plugin para evitar 
    // posibles problemas al actualizar el plugin, o simplemente para  
    // mantener los datos en caso de desactivacion temporal del plugin 
}