document.addEventListener("DOMContentLoaded", () => {
    // ---------- PRODUCTO ----------
    let cantidad = 0;
    let stockMaximo = 1000;
    let idProductoSeleccionado = null;

    const contador = document.getElementById("contador");
    const btnMas = document.getElementById("btn-mas");
    const btnMenos = document.getElementById("btn-menos");
    const productoSelect = document.getElementById("producto");
    const productoImg = document.getElementById("producto-img");
    const productoNombre = document.getElementById("producto-nombre");
    const mensajeOpcional = document.getElementById("mensajeOpcional");


    const productoPrecio = document.getElementById("producto-precio");
    const inputIdProducto = document.getElementById("idProductoSeleccionado");
    const inputCantidadProducto = document.getElementById("cantidadProducto");
    // Valores por defecto al cargar
    productoImg.src = "https://via.placeholder.com/150";
    productoNombre.textContent = "producto";
    mensajeOpcional.style.display = "block"; // Mostrar mensaje inicialmente


    productoSelect.addEventListener("change", function () {
        let selectedOption = this.options[this.selectedIndex];
        idProductoSeleccionado = selectedOption.value;

        if (idProductoSeleccionado === "") {
            productoImg.src = "https://via.placeholder.com/150";
            productoNombre.textContent = "producto";
            productoPrecio.textContent = "";
            productoPrecio.classList.add("oculto"); // ⛔️ Ocultamos el precio

            inputIdProducto.value = "";
            inputCantidadProducto.value = 0;
            cantidad = 0;
            contador.textContent = cantidad;
            mensajeOpcional.style.display = "block";
            return;
        }

        let stock = parseInt(selectedOption.getAttribute("data-stock"));
        let precio = selectedOption.getAttribute("data-precio") || "0";
        stockMaximo = stock;

        inputIdProducto.value = idProductoSeleccionado;
        cantidad = 0;
        inputCantidadProducto.value = cantidad;

        productoNombre.textContent = selectedOption.textContent;
        productoImg.src = selectedOption.getAttribute("data-img") || "https://via.placeholder.com/150";
        productoPrecio.textContent = `$${parseFloat(precio).toLocaleString('es-CO')}`;
        productoPrecio.classList.remove("oculto"); // ✅ Mostramos el precio
        contador.textContent = cantidad;

        mensajeOpcional.style.display = "none";
    });

    btnMas.addEventListener("click", () => {
        if (cantidad < stockMaximo) {
            cantidad++;
            contador.textContent = cantidad;
            inputCantidadProducto.value = cantidad;
        } else {
            alert("Has alcanzado el límite de productos en stock");
        }
    });

    btnMenos.addEventListener("click", () => {
        if (cantidad > 0) {
            cantidad--;
            contador.textContent = cantidad;
            inputCantidadProducto.value = cantidad;
        }
    });

    // ---------- STAFF ----------
    const staffData = JSON.parse(document.getElementById("staff-data").textContent);
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
            idStaff.value = staffData[index].id_staff;
        } else {
            staffImg.src = "https://via.placeholder.com/150";
            staffNombre.textContent = "No hay staff disponible";
            idStaff.value = "";
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

    actualizarStaff(currentIndex);
});
