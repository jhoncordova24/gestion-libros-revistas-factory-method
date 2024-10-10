const navBar = document.querySelector("nav"),
  menuBtns = document.querySelectorAll(".menu-icon"),
  overlay = document.querySelector(".overlay");

menuBtns.forEach((menuBtn) => {
  menuBtn.addEventListener("click", () => {
    navBar.classList.toggle("open");
  });
});

overlay.addEventListener("click", () => {
  navBar.classList.remove("open");
});


document.addEventListener("DOMContentLoaded", function () {
 
  const deleteButtons = document.querySelectorAll(".btn-eliminar");

 
  deleteButtons.forEach((button) => {
    button.addEventListener("click", function () {
      // Obtener el id de la revista
      const revistaId = this.getAttribute("data-id");

      Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "red",
        cancelButtonColor: "#2B5BFF",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
         
          eliminarRevista(revistaId);
        }
      });
    });
  });


  function eliminarRevista(id) {
   
    const form = document.createElement("form");
    form.method = "POST";
    form.action = ""; 

   
    const inputId = document.createElement("input");
    inputId.type = "hidden";
    inputId.name = "id";
    inputId.value = id;

  
    form.appendChild(inputId);

   
    document.body.appendChild(form);
    form.submit();
  }
});



