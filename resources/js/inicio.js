// More API functions here:
// https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

// the link to your model provided by Teachable Machine export panel
const URL = "https://teachablemachine.withgoogle.com/models/SW0HHMbnn/";

let model, labelContainer, maxPredictions;

// Load the image model
async function init() {
    const modelURL = URL + "model.json";
    const metadataURL = URL + "metadata.json";

    // load the model and metadata
    model = await tmImage.load(modelURL, metadataURL);
    maxPredictions = model.getTotalClasses();

    labelContainer = document.getElementById("label-container");
    for (let i = 0; i < maxPredictions; i++) {
        // and class labels
        labelContainer.appendChild(document.createElement("div"));
    }
}

async function predict() {
    // predict can take in an image, video or canvas html element
    var image = document.getElementById("imagePreview");
    const prediction = await model.predict(image, false);
    let name = "No existe ese monumento";
    for (let i = 0; i < maxPredictions; i++) {
        const classPrediction =
            prediction[i].className +
            ": " +
            prediction[i].probability.toFixed(2);
        labelContainer.childNodes[i].innerHTML = classPrediction;
        if (prediction[i].probability.toFixed(2) >= 0.97) {
            name = prediction[i].className;
        }
    }
    if (!isNaN(name)) {
        abrirModal();
        cargaInfoModal(name);
    }else{
        Swal.fire(name)

    }


    //alert(name);
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#imagePreview").attr("src", e.target.result);
            // $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $("#imagePreview").hide();
            $("#imagePreview").fadeIn(650);
        };
        reader.readAsDataURL(input.files[0]);
        init().then(() => {
            predict();
        });
    }
}
$("#imageUpload").change(function () {
    readURL(this);
});

/*--------------------------------------------

FUNCIÓN DEL DRAG AN DROP

--------------------------------------------*/

//Selección de todos los elementos necesarios
const areaDelimitada = document.querySelector(".cuadrado"),
    dragText = areaDelimitada.querySelector(".sustituir"),
    boton = areaDelimitada.querySelector(".texto_bf"),
    input = areaDelimitada.querySelector("input");

//Esta variable global se usará para múltiples funciones
let file;

//Cuando algo está encima del cuadrado
areaDelimitada.addEventListener("dragover", (event) => {
    //Previene el comportamiento predeterminado
    event.preventDefault();
    areaDelimitada.classList.add("active");
    dragText.textContent = "Suelte para cargar el archivo o";
});

//Cuando algo no está encima del cuadrado
areaDelimitada.addEventListener("dragleave", () => {
    areaDelimitada.classList.remove("active");
    dragText.textContent = "Arrastra y suelta aquí o";
});

//Cuando al es dropeado en el cuadro
areaDelimitada.addEventListener("drop", (event) => {
    event.preventDefault();
    //Obtener el archivo de selección del usuario y [0] esto significa que si el usuario selecciona varios archivos, seleccionaremos solo el primero
    //file = event.dataTransfer.files[0];
    //console.log(event)
    //Llamamos a la función
    readURL(event.dataTransfer);
    //alert("Hola00");
    areaDelimitada.classList.remove("active");
    dragText.textContent = "Arrastra y suelta aquí o";
});

//Si el usuario hace clic en el botón, entonces la entrada también hizo clic
boton.onclick = () => {
    input.click();
};

//Listener para el input
input.addEventListener("change", function () {
    //Obtener el archivo de selección del usuario y [0] esto significa que si el usuario selecciona varios archivos, seleccionaremos solo el primero
    file = this.files[0];
    //Llamamos a la función
    readURL(file);
    //showFile();
});

function showFile() {
    let fileType = file.type;
    //Permitimos los diferentes tipo de archivos que podríamos usar
    let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
    //Si el archivo seleccionado por el usuario es un archivo de imagen
    if (validExtensions.includes(fileType)) {
        //Creamos un nuevo objeto FileReader
        let fileReader = new FileReader();
        fileReader.onload = () => {
            //Pasando la fuente del archivo de usuario en la variable fileURL
            let fileURL = fileReader.result;
            //Creando una etiqueta img y pasando la fuente de archivo seleccionada por el usuario dentro del atributo src
            let imgTag = `<img src="${fileURL}" alt="">`;
            //Agregando esa imgTag creada dentro de areaDelimitada
            //areaDelimitada.innerHTML = imgTag;
        };
        fileReader.readAsDataURL(file);
    } else {
        alert("Esto no es una imagen");
        areaDelimitada.classList.remove("active");
        dragText.textContent = "Arrastra y suelta aquí o";
    }
}

/*--------------------------------------------

FUNCIÓN DEL DESBLOQUEO DE PÁGINA

--------------------------------------------
const areaDelimitada2 = document.querySelector("body"),
    flecha = areaDelimitada2.querySelector(".boton_abajo");

flecha.onclick = () => {
    areaDelimitada2.classList.remove("bloquear");
    flecha.classList.add("bloquear");
    $(".bloquear").css("opacity", "0");

    window.scroll({
        top: 1100,
        left: 0,
        behavior: "smooth"
    });
}

/*--------------------------------------------

FUNCIÓN DE REGRESAR A LA PÁGINA AL MERO INICIO Y=0

--------------------------------------------
$(function () {
    $('html,body').scrollTop(0);
    $(this).scrollTop(0);
});

$(window).on('beforeunload', function () {
    $(window).scrollTop(0);
});

/*--------------------------------------------

FUNCIÓN DEL TOGGLE

--------------------------------------------
$(function () {
    $(".toggle").on("click", function () {
        if ($(".item").hasClass("active")) {
            $(".item").removeClass("active");
            $(this).find("a").html("<i class='fas fa-bars'></i>");
        } else {
            $(".item").addClass("active");
            $(this).find("a").html("<i class='fas fa-times'></i>");
        }
    });
});

/*-------------------------------------------------


--------------------------------------------------*/
