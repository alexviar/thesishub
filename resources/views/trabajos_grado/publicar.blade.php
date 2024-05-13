@extends("layouts.app")
@section("content")
<div class="container bg-white my-4 p-4 shadow-sm rounded" style="min-height:80vh">
    <form id="reg-form" autocomplete="off" aria-label="Registro de trabajos de grado" method="post" enctype="multipart/form-data" action="{{route("trabajos_grado.publicar")}}" class="d-flex flex-column">
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
                <input id="tema" class="form-control" name="tema" value="{{old('tema')}}">
            </div>
            <div class="mb-3">
                <label class="form-label" form="resumen">Resumen</label>
                <textarea id="resumen" class="form-control" rows="10" name="resumen">{{old('resumen')}}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" form="fecha-defensa">Fecha de defensa</label>
                <input id="fecha-defensa" type="date" class="form-control" name="fecha_defensa" value="{{old('fecha_defensa')}}">
            </div>
            <div class="mb-3">
                <label class="form-label" form="documento">Documento</label>
                <input id="documento" type="file" accept="application/pdf" class="form-control" name="documento">
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
                                <input id="codigo-tutor" class="form-control" name="tutor[codigo]" value="{{optional(old('tutor'))['codigo']}}">
                                <button id="buscar-tutor" class="btn btn-outline-secondary" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="nombre-completo-tutor" class="form-label">Nombre Completo</label>
                            <input id="nombre-completo-tutor" class="form-control" readonly name="tutor[nombre_completo]" value="{{optional(old('tutor'))['nombre_completo']}}">
                        </div>
                    </div>
                    <input type="hidden" name="tutor[id]" value="{{optional(old('tutor'))['id']}}">
                </div>
            </div>
        </fieldset>
        <fieldset class="bg-light p-3 mb-3">
            <legend>Estudiantes</legend>
            <div id="estudiantes-fieldset">
            </div>
            <button id="agregar-estudiantes" type="button" class="btn btn-primary">Agregar</button>
        </fieldset>

        <div class="row">
            <div class="col-auto">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</div>

@endsection
@include('components.searchable_select')
@push("scripts")
@vite('resources/js/trabajos_grado/EstudianteItem.js')
<script type="module">
    import { EstudianteItem } from "{{Vite::asset('resources/js/trabajos_grado/EstudianteItem.js')}}";
    var estudiantes = <?php echo json_encode(old("estudiantes") ?? [
        [
            'id'=> '',
            'nro_registro'=> '',
            'nombre_completo'=> '',
            'carrera_id'=> ''
        ]
    ]); ?>

    var carreras = <?php echo $carreras; ?>;

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
</script>
<script></script>
@endpush