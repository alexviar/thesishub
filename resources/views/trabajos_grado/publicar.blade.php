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
                window.addEventListener("load", ()=>document.getElementsById("reg-form").scrollIntoView());
            </script>
        @endpush
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
                            <label for="codigo-tutor">Código</label>
                            <input id="codigo-tutor" class="form-control" placeholder="Código" name="tutor[codigo]">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="mb-3">
                            <label for="nombre-completo-tutor">Nombre Completo</label>
                            <input id="nombre-completo-tutor" class="form-control" placeholder="Nombre completo" name="tutor[nombre_completo]">
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

    var carreras = {!!$carreras!!}

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
            let estudiante = estudiantes[i];
            const container = document.getElementById("estudiantes-fieldset");
            const component = document.createElement("div");
            component.className = "rounded p-3 mb-3";
            component.style = "background-color:rgba(0,0,0,0.05)";
            const row = document.createElement("div");
            row.classList.add("row");
            let formGroup, controlId, toFocus;

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
            formGroup.appendChild(label);
            formGroup.appendChild(input);
            row.appendChild(formGroup);
            toFocus = input;

            formGroup = document.createElement("div");
            formGroup.className = "col-lg-9 mb-3";
            label = document.createElement("label");
            label.classList.add("form-label");
            controlId = `nombre-completo-${i}`
            label.for = controlId;
            label.innerHTML = "Nombre completo";
            input = document.createElement("input");
            input.id = controlId;
            input.classList.add("form-control");
            input.name = `estudiantes[${i}][nombre_completo]`;
            input.value = estudiantes[i].nombre_completo
            input.addEventListener("change", function(event) {
                estudiantes[i].nombre_completo = event.target.value;
            });
            formGroup.appendChild(label);
            formGroup.appendChild(input);
            row.appendChild(formGroup)

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