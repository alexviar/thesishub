import { EstudianteItem } from './EstudianteItem';

async function buscarTutor(e) {
    const value = document.getElementById("codigo-tutor").value;
    const input = document.getElementsByName("tutor[nombre_completo]").item(0)
    const hiddenInput = document.getElementsByName("tutor[id]").item(0)

    if (!value) return;

    const response = await fetch("/tutores/" + value)

    if (response.status == 404) {
        input.readOnly = false
        return
    }

    if (response.status == 200) {
        const responseJson = await response.json();

        input.value = responseJson.nombre_completo
        input.dispatchEvent(new Event('change'));
        hiddenInput.value = responseJson.id
        hiddenInput.dispatchEvent(new Event('change'));
        input.readOnly = true
    }
}

window.addEventListener("load", function() {
    document.getElementById("agregar-estudiantes").addEventListener("click", agregarEstudiantes)
    document.getElementById("buscar-tutor").addEventListener("click", buscarTutor)
    renderEstudiantes();
});

function agregarEstudiantes() {
    const container = document.getElementById("estudiantes-fieldset");
    estudiantes.push({
        id: "",
        nro_registro: "",
        nombre_completo: "",
        carrera_id: ""
    });
    container.innerHTML = "";
    renderEstudiantes();
    const lastChild = container.lastElementChild;
    lastChild.scrollIntoView();
    lastChild.querySelector(`div.input-group input`).focus();
}

function renderEstudiantes() {
    const container = document.getElementById("estudiantes-fieldset");
    for (let i in estudiantes) {
        let estudiante = estudiantes[i];
        const estudianteItem = new EstudianteItem(i)
        estudianteItem.setValue(estudiante)
        estudianteItem.setCarreras(carreras)
        estudianteItem.setOnChange((value) => {
            estudianteItem.setValue(value)
            estudiantes[i] = value
        })
        estudianteItem.setOnQuitar(() => {
            estudiantes.splice(i, 1);
            container.innerHTML = "";
            renderEstudiantes();
        })
        estudianteItem.setOnSearch(async (value) => {
            const input = estudianteItem.inputs["nombre_completo"]//document.getElementById(`${prefixId}-nombre-completo`)
            const hiddenInput = estudianteItem.inputs["id"]//document.getElementById(`${prefixId}-id`)
            if (!value) return;

            const response = await fetch("/estudiantes/" + value)

            if (response.status == 404) {
                input.readOnly = false
                return
            }

            if (response.status == 200) {
                const responseJson = await response.json();

                input.value = responseJson.nombre_completo
                input.dispatchEvent(new Event('change'));
                hiddenInput.value = responseJson.id
                hiddenInput.dispatchEvent(new Event('change'));
                input.readOnly = true
            }
        })
        estudianteItem.render(container)
    }
}