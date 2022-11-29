/**
 * BackOffice File Thumbs JavaScript
 * @version 1.0
 */

$(document).ready(function () {
    // Detectar cuando se modifica un file para mostrar la preview
    $('body').on('change', '.js-imagen-input-file', function () {
        console.log('aaaa');
        readURL(this, $(this));
    });
});


/**
 * Funcion para leer la ruta del fichero subido y poder actualizar la imagen.
 * @param {type} input
 * @param {type} input2
 * @returns {undefined}
 */
function readURL(input, input2) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const id = input2.attr('id');
        const imgThumbContainer = $(`.img-thumb-container[data-field=${id}]`);

        reader.onload = function (e) {
            imgThumbContainer.find('a').attr('href', e.target.result);
            imgThumbContainer.find('img').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
