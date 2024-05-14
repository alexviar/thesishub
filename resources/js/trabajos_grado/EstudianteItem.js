import { SearchableSelect } from "../components/SearchableSelect";

export class EstudianteItem {

    constructor(index) {
        this.index = +index;
        this.prefixId = `estudiante-${index}`
        this.inputs = {}
    }

    _createIdInput() {
        const [i, prefixId] = [this.index, this.prefixId];
        const idInput = document.createElement("input");
        idInput.id = `${prefixId}-id`;
        idInput.type = "hidden";
        idInput.name = `estudiantes[${i}][id]`;
        idInput.value = this.value.id
        idInput.addEventListener("change", (event) => this.onChange({
            ...this.value,
            id: event.currentTarget.value
        }))
        this.inputs["id"] = idInput
        return idInput;
    }

    _createNroRegistroFormGroup() {
        const [i, prefixId] = [this.index, this.prefixId];
        const controlId = `${prefixId}-nro-registro`;

        const formGroup = document.createElement("div");
        formGroup.className = "col-lg-3 col-md-6 mb-3";

        const label = document.createElement("label");
        label.classList.add("form-label");
        label.for = controlId;
        label.innerHTML = "Nro. de Registro";
        formGroup.appendChild(label);

        const inputGroup = document.createElement("div");
        inputGroup.classList.add("input-group");
        inputGroup.classList.add("mb-3");
        formGroup.appendChild(inputGroup);

        const input = document.createElement("input");
        this.inputs["nro_registro"] = input
        input.id = controlId;
        input.classList.add("form-control");
        input.name = `estudiantes[${i}][nro_registro]`;
        input.value = this.value.nro_registro
        input.addEventListener("change", (event)=>this.onChange({
            ...this.value,
            nro_registro: event.currentTarget.value
        }))
        inputGroup.appendChild(input)

        const searchGroupButton = document.createElement("button")
        searchGroupButton.type = "button"
        searchGroupButton.classList.add("btn")
        searchGroupButton.classList.add("btn-outline-secondary")
        searchGroupButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>`;
        searchGroupButton.addEventListener("click", () => this.onSearch(input.value));
        inputGroup.appendChild(searchGroupButton)

        return formGroup;
    }

    _createNombreCompletoFormGroup() {
        const [i, prefixId] = [this.index, this.prefixId];
        const controlId = `${prefixId}-nombre-completo`;
        
        const formGroup = document.createElement("div");
        formGroup.className = "col-12 mb-3";
        
        const label = document.createElement("label");
        label.classList.add("form-label");
        label.for = controlId;
        label.innerHTML = "Nombre completo";
        formGroup.appendChild(label);
        
        const input = document.createElement("input");
        this.inputs["nombre_completo"] = input
        input.id = controlId;
        input.classList.add("form-control");
        input.name = `estudiantes[${i}][nombre_completo]`;
        input.value = this.value.nombre_completo
        input.readOnly = true;
        input.addEventListener("change", (event) =>this.onChange({
            ...this.value,
            nombre_completo: event.currentTarget.value
        }));
        formGroup.appendChild(input);

        return formGroup;
    }

    _createCarreraFormGroup() {
        const [i, prefixId] = [this.index, this.prefixId];
        const controlId = `${prefixId}-carrera`;

        const formGroup = document.createElement("div");
        formGroup.className = "col-12 mb-3";
        const label = document.createElement("label");
        label.classList.add("form-label");
        label.for = controlId;
        label.innerHTML = "Carrera";
        formGroup.appendChild(label);
        const select = document.createElement("div");
        select.id = `${controlId}-dropdown`;
        formGroup.appendChild(select);
        const searchableSelect = new SearchableSelect({
            container: select,
            id: controlId,
            name: `estudiantes[${i}][carrera_id]`,
            value: this.value.carrera_id,
            onChange: (carrera_id)=>this.onChange({
                ...this.value,
                carrera_id
            }),
            options: this.carreras
        });
        this.inputs["carreras"] = searchableSelect.hiddenInput

        return formGroup
    }

    _createQuitarButton() {
        const col = document.createElement("div");
        col.classList.add("col-12");

        const btnQuitar = document.createElement("button");
        btnQuitar.className = "btn btn-danger";
        btnQuitar.innerHTML = "Quitar";
        btnQuitar.type = "button";
        btnQuitar.addEventListener("click", ()=>this.onQuitar());
        col.appendChild(btnQuitar);
        return col
    }

    _createRow(){
        const row = document.createElement("div");
        row.classList.add("row");
        return row
    }

    setValue(value){
        this.value = value
    }

    setCarreras(carreras){
        this.carreras = carreras
    }

    setOnChange(callback){
        this.onChange = callback
    }

    setOnSearch(callback){
        this.onSearch = callback
    }

    setOnQuitar(callback){
        this.onQuitar = callback
    }

    render(container){
        const component = document.createElement("div");
        component.className = "rounded p-3 mb-3";
        component.style = "background-color:rgba(0,0,0,0.05)";
        component.innerHTML = `<div class="row"><div class="col-auto ms-auto">Estudiante #${this.index + 1}</div></div>`
    
        let row;
        row = this._createRow();
        row.appendChild(this._createIdInput());
        row.appendChild(this._createNroRegistroFormGroup());
        component.appendChild(row);

        row = this._createRow();
        row.appendChild(this._createNombreCompletoFormGroup());
        component.appendChild(row);

        row = this._createRow();
        row.appendChild(this._createCarreraFormGroup());
        component.appendChild(row);

        row = this._createRow();
        row.appendChild(this._createQuitarButton());
        component.appendChild(row);

        container.appendChild(component);
    }
}