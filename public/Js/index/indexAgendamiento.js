//cantidad de stock
document.addEventListener("DOMContentLoaded", () => {
    let cantidad = 0;
    const stockMaximo = 10; // Puedes reemplazarlo dinámicamente luego
    const contador = document.getElementById("contador");
    const btnMas = document.getElementById("btn-mas");
    const btnMenos = document.getElementById("btn-menos");

    btnMas.addEventListener("click", () => {
        if (cantidad < stockMaximo) {
            cantidad++;
            contador.textContent = cantidad;
        } else {
            alert("Has alcanzado el límite de productos en stock");
        }
    });

    btnMenos.addEventListener("click", () => {
        if (cantidad > 0) {
            cantidad--;
            contador.textContent = cantidad;
        }
    });
});

//cambiar de staff
document.addEventListener("DOMContentLoaded", function () {
    // Lista de staff simulada (puedes luego llenarla desde backend si quieres)
    const staffList = [
        {
            nombre: "Román",
            img: "https://img.freepik.com/foto-gratis/estilo-vida-emociones-gente-concepto-casual-confiado-agradable-sonriente-mujer-asiatica-brazos-cruzados-pecho-seguro-listo-ayudar-escuchando-companeros-trabajo-participando-conversacion_1258-59335.jpg?semt=ais_hybrid&w=740",
        },
        {
            nombre: "Camila",
            img: "https://img.freepik.com/foto-gratis/mujer-sonriendo-camara_23-2148864937.jpg",
        },
        {
            nombre: "Daniel",
            img: "https://img.freepik.com/foto-gratis/hombre-sonriendo-camara-interior_23-2148899313.jpg",
        },
    ];

    let currentStaffIndex = 0;

    const staffImg = document.getElementById("staff-img");
    const staffNombre = document.getElementById("staff-nombre");
    const btnPrev = document.querySelector(".btn-prev-staff");
    const btnNext = document.querySelector(".btn-next-staff");

    function actualizarStaff(index) {
        staffImg.src = staffList[index].img;
        staffNombre.textContent = staffList[index].nombre;
    }

    btnPrev.addEventListener("click", () => {
        currentStaffIndex =
            (currentStaffIndex - 1 + staffList.length) % staffList.length;
        actualizarStaff(currentStaffIndex);
    });

    btnNext.addEventListener("click", () => {
        currentStaffIndex = (currentStaffIndex + 1) % staffList.length;
        actualizarStaff(currentStaffIndex);
    });
});
