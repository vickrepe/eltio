(function (Drupal) {
    Drupal.behaviors.toggleObservacionesField = {
      attach: function (context) {
        // Selecciona el wrapper de Observaciones.
        const wrapper = context.querySelector('.observaciones-wrapper');
        if (wrapper) {
          const toggleButton = wrapper.querySelector('.observaciones-toggle');
          const textArea = wrapper.querySelector('.observaciones-field');
  
          if (toggleButton && textArea) {
            // Ocultar el textarea inicialmente.
            textArea.style.display = 'none';
  
            // Asegúrate de que solo un evento está asignado.
            if (!toggleButton.dataset.eventAttached) {
              toggleButton.addEventListener('click', (event) => {
                event.preventDefault(); // Prevenir comportamiento predeterminado.
                const isHidden = textArea.style.display === 'none';
                textArea.style.display = isHidden ? 'block' : 'none';
              });
  
              // Marca el botón como con evento asignado para evitar duplicados.
              toggleButton.dataset.eventAttached = true;
            }
          }
        }
      },
    };
  })(Drupal);
  