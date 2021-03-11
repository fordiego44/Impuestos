$(document).ready(function(){

 
  /* document.getElementById("first").innerHTML = "Hola Marte!!!!";
   document.getElementById("image").src = "entrada.jpg";*/

   const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
   $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

   // Escuchar cuando cambie
   $seleccionArchivos.addEventListener("change", () => {
   // Los archivos seleccionados, pueden ser muchos o uno
     const archivos = $seleccionArchivos.files;
     console.log(archivos[0]);
   // Si no hay archivos salimos de la función y quitamos la imagen
     let direcciondire = $('#imagen').val();
     console.log(direcciondire);

     if (!archivos || !archivos.length) {
       $imagenPrevisualizacion.src = direcciondire;
       return;
     }
   // Ahora tomamos el primer archivo, el cual vamos a previsualizar
     const primerArchivo = archivos[0];
   // Lo convertimos a un objeto de tipo objectURL
     const objectURL = URL.createObjectURL(primerArchivo);
     console.log(objectURL);
   // Y a la fuente de la imagen le ponemos el objectURL
     $imagenPrevisualizacion.src = objectURL;
     });

     $('#file').change(function(e) {
        var filename = e.target.files[0].name
        console.log(filename);
        $('span').html(filename);
      });

});
