document.addEventListener("DOMContentLoaded", () => {
    const nombreInput = document.getElementById("nombreCategoria");
    const descripcionInput = document.getElementById("descripcion");
    const imagenInput = document.getElementById("imagen");
    
    const vistaNombre = document.getElementById("vistaNombre");
    const vistaDescripcion = document.getElementById("vistaDescripcion");
    const vistaImagen = document.getElementById("imagenCategoria");
  
    nombreInput.addEventListener("input", () => {
      vistaNombre.textContent = nombreInput.value.trim();
    });
  
    descripcionInput.addEventListener("input", () => {
      vistaDescripcion.textContent = descripcionInput.value.trim();
    });
  
    imagenInput.addEventListener("change", (event) => {
      const file = event.target.files[0];
  
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          vistaImagen.src = e.target.result;
          vistaImagen.style.display = "block"; // Mostrar la imagen
        };
        reader.readAsDataURL(file);
      } else {
        vistaImagen.src = "";
        vistaImagen.style.display = "none"; // Ocultar si no hay imagen
      }
    });
  });