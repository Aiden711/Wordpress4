document.addEventListener('alpine:init', () => { 
    Alpine.data('formHabitacion', (data = {}) => ({ 
        // estado inicial 
        metros: '', 
        precio: '', 
        camas: '', 
        mesa: false, 
        bano: false, 
        // mezclar datos PHP 
        ...data, 
    })); 
});