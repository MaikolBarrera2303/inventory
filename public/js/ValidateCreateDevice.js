let responsible = document.getElementById("responsible_id")
let  state = document.getElementById("state")

responsible.addEventListener('change', validateResponsibleState);
state.addEventListener('change', validateResponsibleState);

function validateResponsibleState() {
    if (responsible.value === "" && state.value === "en servicio"){
        window.alert('Debe seleccionar un Responsable Primero');
        state.value = "";
    }

    if (responsible.value !== "" && (state.value === "sin asignar" || state.value === "fuera de servicio")){
        window.alert('El estado no puede ser "sin asignar" ni "fuera de servicio" , cuando hay un responsable');
        responsible.value = "";
        state.value = "";
    }

}

/////////////////////////////////////////////////////////////////////////////////////

let sdd = document.getElementById("ssd")
let hdd = document.getElementById("hdd")

sdd.addEventListener('change', function() {
    if (sdd.checked) hdd.checked = false;
});

hdd.addEventListener('change', function() {
    if (hdd.checked) sdd.checked = false;
});
