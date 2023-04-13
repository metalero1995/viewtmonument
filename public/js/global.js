/*------------------------------------------------

FUNCIÓN DEL DESPLEGADO DE IDIOMA

--------------------------------------------------*/
const areaDelimitada3 = document.querySelector("body"),
  botonIdioma = document.querySelector(".boton_Idioma"),
  listaIdioma = document.querySelector(".desplegar-contenido");
/*
botonIdioma.onclick = () => {
  listaIdioma.classList.toggle("show");
}
*/
const areaDelimitada4 = document.querySelector("body"),
  botonToggle = document.querySelector(".toggle"),
  listaPrincipal = document.querySelector(".desplegar_principal");

botonToggle.onclick = () => {
  listaPrincipal.classList.toggle("show_principal");

}
/* Close the dropdown menu if the user clicks outside of it*/
window.onclick = function (event) {
  /*
  if (!event.target.matches('.boton_Idioma')) {
    var dropdowns = document.getElementsByClassName("desplegar-contenido");
    var i;
    for (i = 0; i < dropdowns.length; i++) {

      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }*/
  if (!event.target.matches('.toggle')) {
    var dropdowns = document.getElementsByClassName("desplegar_principal");
    var i;
    for (i = 0; i < dropdowns.length; i++) {

      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show_principal')) {
        openDropdown.classList.remove('show_principal');
      }
    }
  }
}
/*----------------------------------------------------------

CAMBIAR EL CSS DEPENDIENDO DE LA PÁGINA EN DONDE ESTOY

-------------------------------------------------------------- */
window.onload = function () {
  const localizacion = location.href;
  const menuElementos = document.querySelectorAll('.botonNav');
  const menuLongitud = menuElementos.length;



  const botonSeleccionado = "botonSeleccionado";
  let cont = 0;
  for (let i = 0; i < menuLongitud; i++) {
    if (menuElementos[i].href === localizacion) {
      menuElementos[i].classList.add(botonSeleccionado);

      cont = 1;
    }


  }
  if (cont == 0) {
    const menuElementos = document.querySelectorAll('.botonNav_footer');
    const menuLongitud = menuElementos.length;

    for (let i = 0; i < menuLongitud; i++) {
      if (menuElementos[i].href === localizacion) {
        menuElementos[i].classList.add(botonSeleccionado);
        cont = 1;
      }
    }
  }
/*
  if (cont == 0) {
    menuElementos[0].classList.add(botonSeleccionado);
  }*/
};
/*-------------------------------------------------------------------

CAMBIA EL COLOR DEL FAVICON DEPENDIENDO DEL TEMA PUESTO 

-------------------------------------------------------------------


const favicon = document.querySelector('#favicon')
  if (window.matchMedia && 
      window.matchMedia('(prefers-color-scheme: dark)').matches) {
    favicon.href="img/Isotipo_crema.ico"
  }else{
    favicon.href="img/Isotipo_cerceta.ico"
  }


/*Prueba*/



