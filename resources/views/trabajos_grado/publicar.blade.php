@extends("layouts.app")
@section("content")
<div class="container bg-white my-4 p-4 shadow-sm rounded" style="min-height:80vh">
    <form id="reg-form" aria-label="Registro de trabajos de grado" method="post" enctype="multipart/form-data" action="{{route("trabajos_grado.publicar")}}" class="d-flex flex-column">
        @if($ui["show_confirmation_message"])
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            El trabajo de grado ha sido guardado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @push("scripts")
        <script>
            window.addEventListener("load", () => document.getElementById("reg-form").scrollIntoView());
        </script>
        @endpush
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @csrf
        <fieldset class="bg-light p-3 mb-3">
            <legend>Informacion general</legend>
            <div class="mb-3">
                <label class="form-label" form="tema">Tema</label>
                <input id="tema" class="form-control" name="tema">
            </div>
            <div class="mb-3">
                <label class="form-label" form="resumen">Resumen</label>
                <textarea id="resumen" class="form-control" rows="10" name="resumen"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" form="fecha-defensa">Fecha de defensa</label>
                <input id="fecha-defensa" type="date" class="form-control" name="fecha_defensa">
            </div>
            <div class="mb-3">
                <label class="form-label" form="documento">Documento</label>
                <input id="documento" type="file" class="form-control" name="documento">
            </div>
        </fieldset>

        <fieldset class="bg-light p-3 mb-3">
            <legend>Tutor</legend>
            <div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="mb-3">
                            <label for="codigo-tutor" class="form-label">Código</label>
                            <div class="input-group mb-3">
                                <input id="codigo-tutor" class="form-control" name="tutor[codigo]">
                                <button class="btn btn-outline-secondary" type="button" onclick="buscarTutor(event)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="mb-3">
                            <label for="nombre-completo-tutor" class="form-label">Nombre Completo</label>
                            <input id="nombre-completo-tutor" class="form-control" disabled name="tutor[nombre_completo]">
                        </div>
                    </div>
                    <input type="hidden" name="tutor[id]">
                </div>
            </div>
        </fieldset>
        <fieldset class="bg-light p-3 mb-3">
            <legend>Estudiantes</legend>
            <div id="estudiantes-fieldset">
            </div>
            <button type="button" class="btn btn-primary" onclick="agregarEstudiantes()">Agregar</button>
        </fieldset>

        <div class="row">
            <div class="col-auto">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</div>

@endsection
@push("scripts")
<script>
    var estudiantes = [{
        id: "",
        nro_registro: "",
        nombre_completo: "",
        carrera_id: ""
    }];

    var carreras = <?php echo $carreras; ?>;

    async function buscarTutor(e) {
        const value = document.getElementById("codigo-tutor").value;
        const input = document.getElementsByName("tutor[nombre_completo]").item(0)
        const hiddenInput = document.getElementsByName("tutor[id]").item(0)

        if (!value) return;

        const response = await fetch("/tutores/" + value)

        if (response.status == 404) {
            input.disabled = false
            return
        }

        if (response.status == 200) {
            const responseJson = await response.json();

            input.value = responseJson.nombre_completo
            input.dispatchEvent(new Event('change'));
            hiddenInput.value = responseJson.id
            hiddenInput.dispatchEvent(new Event('change'));
            input.disabled = true
        }
    }

    window.addEventListener("load", function() {
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
        lastChild.children[0].children[0].children[1].focus();
        // lastChild.firstChild().focus();
        // toFocus.focus();
        // component.scrollIntoView();
    }

    function renderEstudiantes() {
        for (let i in estudiantes) {
            const prefixId = `estudiante-${i}`
            let estudiante = estudiantes[i];
            const container = document.getElementById("estudiantes-fieldset");
            const component = document.createElement("div");
            component.className = "rounded p-3 mb-3";
            component.style = "background-color:rgba(0,0,0,0.05)";
            const row = document.createElement("div");
            row.classList.add("row");
            let formGroup, controlId, toFocus;

            const hiddenInput = document.createElement("input")
            hiddenInput.id = `${prefixId}-id`
            hiddenInput.type = "hidden"
            hiddenInput.name = `estudiantes[${i}][id]`;
            hiddenInput.value = estudiantes[i].id ?? "";
            hiddenInput.addEventListener("change", function(e) {
                estudiantes[i].id = event.target.value;
            })

            formGroup = document.createElement("div");
            formGroup.className = "col-lg-3 col-md-6 mb-3";
            label = document.createElement("label");
            label.classList.add("form-label");
            controlId = `nro-registro-${i}`
            label.for = controlId;
            label.innerHTML = "Nro. de Registro";
            input = document.createElement("input");
            input.id = controlId;
            input.classList.add("form-control");
            input.name = `estudiantes[${i}][nro_registro]`;
            input.value = estudiantes[i].nro_registro;
            input.addEventListener("change", function(event) {
                estudiantes[i].nro_registro = event.target.value;
            });
            inputGroup = document.createElement("div");
            inputGroup.classList.add("input-group")
            inputGroup.classList.add("mb-3")
            inputGroup.appendChild(input)
            let inputGroupButton = document.createElement("button")
            inputGroupButton.type = "button"
            inputGroupButton.classList.add("btn")
            inputGroupButton.classList.add("btn-outline-secondary")
            inputGroupButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>`
            inputGroup.appendChild(inputGroupButton)
            formGroup.appendChild(label);
            formGroup.appendChild(inputGroup);
            row.appendChild(formGroup);
            toFocus = input;

            formGroup = document.createElement("div");
            formGroup.className = "col-lg-9 mb-3";
            label = document.createElement("label");
            label.classList.add("form-label");
            controlId = `${prefixId}-nombre-completo`
            label.for = controlId;
            label.innerHTML = "Nombre completo";
            input = document.createElement("input");
            input.id = controlId;
            input.classList.add("form-control");
            input.name = `estudiantes[${i}][nombre_completo]`;
            input.value = estudiantes[i].nombre_completo
            input.disabled = true;
            input.addEventListener("change", function(event) {
                estudiantes[i].nombre_completo = event.target.value;
            });
            formGroup.appendChild(label);
            formGroup.appendChild(input);
            row.appendChild(formGroup)


            inputGroupButton.addEventListener("click", async (e) => {
                const value = e.currentTarget.previousSibling.value
                const input = document.getElementById(`${prefixId}-nombre-completo`)
                const hiddenInput = document.getElementById(`${prefixId}-id`)
                if (!value) return;

                const response = await fetch("/estudiantes/" + value)

                if (response.status == 404) {
                    input.disabled = false
                    return
                }

                if (response.status == 200) {
                    const responseJson = await response.json();

                    input.value = responseJson.nombre_completo
                    input.dispatchEvent(new Event('change'));
                    hiddenInput.value = responseJson.id
                    hiddenInput.dispatchEvent(new Event('change'));
                    input.disabled = true
                }
            })

            formGroup = document.createElement("div");
            formGroup.className = "col-12 mb-3";
            label = document.createElement("label");
            label.classList.add("form-label");
            controlId = `carrera-${i}`
            label.for = controlId;
            label.innerHTML = "Carrera";
            formGroup.appendChild(label);
            select = document.createElement("div");
            select.innerHTML = `@include("components.searchable_select")`;
            select.id = controlId
            initializeSelector(select, {
                name: `estudiantes[${i}][carrera_id]`,
                value: estudiantes[i].carrera_id,
                onChange: function(id) {
                    estudiantes[i].carrera_id = id;
                },
                options: carreras
            })
            formGroup.appendChild(select);
            row.appendChild(formGroup)

            function quitar() {
                estudiantes.splice(i, 1);
                container.innerHTML = "";
                renderEstudiantes();
            }

            const btnQuitar = document.createElement("button");
            btnQuitar.className = "btn btn-danger";
            btnQuitar.innerHTML = "Quitar";
            btnQuitar.type = "button";
            btnQuitar.addEventListener("click", quitar);
            const col = document.createElement("div");
            col.classList.add("col-12");
            col.appendChild(btnQuitar);
            row.appendChild(col);
            component.appendChild(row);

            const inId = document.createElement("input");
            inId.type = "hidden";
            inId.name = `estudiantes[${i}][id]`;
            inId.value = estudiantes[i].id;
            component.appendChild(inId);
            container.appendChild(component);
        }
    }
</script>
<script></script>
@endpush