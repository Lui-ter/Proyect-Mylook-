document.addEventListener("DOMContentLoaded", () => {
    let cantidad = 0;
    let stockMaximo = 1000;
    let idProductoSeleccionado = null;

    const contador = document.getElementById("contador");
    const btnMas = document.getElementById("btn-mas");
    const btnMenos = document.getElementById("btn-menos");
    const productoSelect = document.getElementById("producto");
    const productoImg = document.getElementById("producto-img");
    const productoNombre = document.getElementById("producto-nombre");

    // **Capturar los inputs ocultos**
    const inputIdProducto = document.getElementById("idProductoSeleccionado");
    const inputCantidadProducto = document.getElementById("cantidadProducto");

    // Mantener la imagen por defecto hasta que el usuario seleccione un producto
    productoImg.src = "https://via.placeholder.com/150";
    productoNombre.textContent = "Selecciona un producto";

    productoSelect.addEventListener("change", function () {
        let selectedOption = this.options[this.selectedIndex];
        idProductoSeleccionado = selectedOption.value;
        let stock = parseInt(selectedOption.getAttribute("data-stock"));
        stockMaximo = stock;

        // **Actualizar los inputs ocultos**
        inputIdProducto.value = idProductoSeleccionado;

        // **No asignar directamente el stock como cantidad**
        cantidad = 0; // Reiniciar cantidad al cambiar producto
        inputCantidadProducto.value = cantidad;

        // Actualizar la carta con los datos seleccionados
        productoNombre.textContent = selectedOption.textContent;
        productoImg.src = selectedOption.getAttribute("data-img") || "https://via.placeholder.com/150";
        contador.textContent = cantidad;
    });

    btnMas.addEventListener("click", () => {
        if (cantidad < stockMaximo) {
            cantidad++;
            contador.textContent = cantidad;
            inputCantidadProducto.value = cantidad; // **Actualizar el input hidden**
        } else {
            alert("Has alcanzado el límite de productos en stock");
        }
    });

    btnMenos.addEventListener("click", () => {
        if (cantidad > 0) {
            cantidad--;
            contador.textContent = cantidad;
            inputCantidadProducto.value = cantidad; // **Actualizar el input hidden**
        }
    });
});

//cambiar de staff
document.addEventListener("DOMContentLoaded", () => {
    const staffData = JSON.parse(document.getElementById("staff-data").textContent); // Obtener datos filtrados del backend
    const staffImg = document.getElementById("staff-img");
    const staffNombre = document.getElementById("staff-nombre");
    const idStaff = document.getElementById("idStaff");
    const btnPrev = document.querySelector(".btn-prev-staff");
    const btnNext = document.querySelector(".btn-next-staff");

    let currentIndex = 0;

    function actualizarStaff(index) {
        if (staffData.length > 0) {
            staffImg.src = staffData[index].imagen || "https://via.placeholder.com/150";
            staffNombre.textContent = staffData[index].nombre;
            idStaff.textContent = staffData[index].idStaff;
        } else {
            staffImg.src = "https://via.placeholder.com/150";
            staffNombre.textContent = "No hay staff disponible";
        }
    }

    btnNext.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % staffData.length;
        actualizarStaff(currentIndex);
    });

    btnPrev.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + staffData.length) % staffData.length;
        actualizarStaff(currentIndex);
    });

    // Cargar el primer staff al inicio
    actualizarStaff(currentIndex);
});