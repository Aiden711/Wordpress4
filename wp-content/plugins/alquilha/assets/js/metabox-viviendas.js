document.addEventListener('alpine:init', () => { 
    Alpine.data('formVivienda', (data = {}) => ({ 
        step: 1, 
 
        direccion: '', 
        metros: '', 
        habitaciones: '', 
        banyos: '', 
        precio: '', 
        parking: false, 
 
        ...data, 
 
        next() { 
            if (this.step < 3) this.step++; 
        }, 
 
        prev() { 
            if (this.step > 1) this.step--; 
        } 
    })); 
});