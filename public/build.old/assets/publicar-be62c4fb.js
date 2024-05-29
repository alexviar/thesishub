class v{constructor({id:t,name:n,value:e,onChange:s,placeholder:a,options:o,container:i}){this.container=i,this.value=e,this.onChange=s,this.options=o,i.innerHTML=`<div tabindex="0" class="form-select dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <div style="min-height:1.5em">
                <input type="hidden">
                <div class="dropdown-placeholder"></div>
                <div class="dropdown-label"></div>
            </div>
        </div>
        <ul class="dropdown-menu dropdown-menu-span" style="max-height:20em;overflow-y:auto" aria-label="Lista de carreras">
            <li class="dropdown-search-item"><span class="dropdown-item-text" href="#"><input class="form-control" type="search" aria-label="Buscar"></span></li>
        </ul>`,this.menu=i.querySelector(".dropdown-menu"),this.hiddenInput=i.querySelector("input[type=hidden]"),this.placeholderContainer=i.querySelector(".dropdown-placeholder"),this.labelContainer=i.querySelector(".dropdown-label"),this.searchInput=i.querySelector("input[type=search]"),this.lastActiveItem=null,this.hiddenInput.id=t,this.hiddenInput.name=n,this.placeholderContainer.innerHTML=a??"",i.classList.add("dropdown"),i.addEventListener("shown.bs.dropdown",()=>{this.searchInput.focus(),setTimeout(()=>{var r;(r=this.lastActiveItem)==null||r.scrollIntoView({block:"nearest",inline:"start"})})}),i.addEventListener("hidden.bs.dropdown",()=>{var c;this.searchInput.value="";const r=new Event("input",{bubbles:!0});this.searchInput.dispatchEvent(r);const d=this.menu.querySelector(".active");d&&this.lastActiveItem!==d&&(d.classList.remove("active"),(c=this.lastActiveItem)==null||c.classList.add("active"))}),this.searchInput.addEventListener("keydown",r=>{if(r.key=="ArrowDown")(()=>{const c=[].concat(...this.menu.querySelectorAll(".dropdown-item:not(li.d-none > *):not(.disabled):not(:disabled)")),u=c.findIndex(p=>p.classList.contains("active"));u!=-1&&c[u].classList.remove("active");const h=c[(u+1)%this.options.length];h.classList.add("active"),h.scrollIntoView({block:"nearest",inline:"start"})})();else if(r.key=="ArrowUp")(()=>{const c=[].concat(...this.menu.querySelectorAll(".dropdown-item:not(li.d-none > *):not(.disabled):not(:disabled)")),u=c.findIndex(p=>p.classList.contains("active"));u!=-1&&c[u].classList.remove("active");const h=c[(u-1+this.options.length)%this.options.length];h.classList.add("active"),h.scrollIntoView({block:"nearest",inline:"start"})})();else if(r.key=="Enter"){const d=this.menu.querySelector(".active");return d&&d.click(),r.preventDefault(),r.stopPropagation(),!1}}),this.searchInput.addEventListener("keydown",r=>{}),this.renderOptions()}activeItem(t){var n;(n=this.lastActiveItem)==null||n.classList.remove("active"),t.classList.add("active"),this.lastActiveItem=t}selectOption({id:t,label:n,item:e}){this.value=t,this.activeItem(e),this.hiddenInput.value=t,this.labelContainer.innerHTML=n,this.placeholderContainer.classList.add("d-none"),this.labelContainer.classList.remove("d-none")}renderOptions(){for(let t of this.options){const{id:n,label:e,subtext:s}=t,a=document.createElement("li"),o=a.appendChild(document.createElement("div"));o.tabIndex="0",o.classList.add("dropdown-item"),this.value==n&&this.selectOption({id:n,label:`${e} - ${s}`,item:o}),o.innerHTML=`<div>${e}</div><div class="text-muted small">${s}</div>`,o.addEventListener("focus",i=>{this.searchInput.focus()}),a.addEventListener("click",()=>{this.selectOption({id:n,label:`${e} - ${s}`,item:o}),this.onChange(n)}),this.searchInput.addEventListener("input",({target:{value:i}})=>(!i||e.toLowerCase().includes(i.toLowerCase())?a.classList.remove("d-none"):a.classList.add("d-none"),!0)),this.menu.appendChild(a)}}}class b{constructor(t){this.index=+t,this.prefixId=`estudiante-${t}`,this.inputs={}}_createIdInput(){const[t,n]=[this.index,this.prefixId],e=document.createElement("input");return e.id=`${n}-id`,e.type="hidden",e.name=`estudiantes[${t}][id]`,e.value=this.value.id,e.addEventListener("change",s=>this.onChange({...this.value,id:s.currentTarget.value})),this.inputs.id=e,e}_createNroRegistroFormGroup(){const[t,n]=[this.index,this.prefixId],e=`${n}-nro-registro`,s=document.createElement("div");s.className="col-lg-3 col-md-6 mb-3";const a=document.createElement("label");a.classList.add("form-label"),a.for=e,a.innerHTML="Nro. de Registro",s.appendChild(a);const o=document.createElement("div");o.classList.add("input-group"),o.classList.add("mb-3"),s.appendChild(o);const i=document.createElement("input");this.inputs.nro_registro=i,i.id=e,i.classList.add("form-control"),i.name=`estudiantes[${t}][nro_registro]`,i.value=this.value.nro_registro,i.addEventListener("change",d=>this.onChange({...this.value,nro_registro:d.currentTarget.value})),o.appendChild(i);const r=document.createElement("button");return r.type="button",r.classList.add("btn"),r.classList.add("btn-outline-secondary"),r.innerHTML=`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>`,r.addEventListener("click",()=>this.onSearch(i.value)),o.appendChild(r),s}_createNombreCompletoFormGroup(){const[t,n]=[this.index,this.prefixId],e=`${n}-nombre-completo`,s=document.createElement("div");s.className="col-12 mb-3";const a=document.createElement("label");a.classList.add("form-label"),a.for=e,a.innerHTML="Nombre completo",s.appendChild(a);const o=document.createElement("input");return this.inputs.nombre_completo=o,o.id=e,o.classList.add("form-control"),o.name=`estudiantes[${t}][nombre_completo]`,o.value=this.value.nombre_completo,o.readOnly=!0,o.addEventListener("change",i=>this.onChange({...this.value,nombre_completo:i.currentTarget.value})),s.appendChild(o),s}_createCarreraFormGroup(){const[t,n]=[this.index,this.prefixId],e=`${n}-carrera`,s=document.createElement("div");s.className="col-12 mb-3";const a=document.createElement("label");a.classList.add("form-label"),a.for=e,a.innerHTML="Carrera",s.appendChild(a);const o=document.createElement("div");o.id=`${e}-dropdown`,s.appendChild(o);const i=new v({container:o,id:e,name:`estudiantes[${t}][carrera_id]`,value:this.value.carrera_id,onChange:r=>this.onChange({...this.value,carrera_id:r}),options:this.carreras});return this.inputs.carreras=i.hiddenInput,s}_createQuitarButton(){const t=document.createElement("div");t.classList.add("col-12");const n=document.createElement("button");return n.className="btn btn-danger",n.innerHTML="Quitar",n.type="button",n.addEventListener("click",()=>this.onQuitar()),t.appendChild(n),t}_createRow(){const t=document.createElement("div");return t.classList.add("row"),t}setValue(t){this.value=t}setCarreras(t){this.carreras=t}setOnChange(t){this.onChange=t}setOnSearch(t){this.onSearch=t}setOnQuitar(t){this.onQuitar=t}render(t){const n=document.createElement("div");n.className="rounded p-3 mb-3",n.style="background-color:rgba(0,0,0,0.05)",n.innerHTML=`<div class="row"><div class="col-auto ms-auto">Estudiante #${this.index+1}</div></div>`;let e;e=this._createRow(),e.appendChild(this._createIdInput()),e.appendChild(this._createNroRegistroFormGroup()),n.appendChild(e),e=this._createRow(),e.appendChild(this._createNombreCompletoFormGroup()),n.appendChild(e),e=this._createRow(),e.appendChild(this._createCarreraFormGroup()),n.appendChild(e),e=this._createRow(),e.appendChild(this._createQuitarButton()),n.appendChild(e),t.appendChild(n)}}async function g(l){const t=document.getElementById("codigo-tutor").value,n=document.getElementsByName("tutor[nombre_completo]").item(0),e=document.getElementsByName("tutor[id]").item(0);if(!t)return;const s=await fetch("/tutores/"+t);if(s.status==404){n.readOnly=!1;return}if(s.status==200){const a=await s.json();n.value=a.nombre_completo,n.dispatchEvent(new Event("change")),e.value=a.id,e.dispatchEvent(new Event("change")),n.readOnly=!0}}window.addEventListener("load",function(){document.getElementById("agregar-estudiantes").addEventListener("click",w),document.getElementById("buscar-tutor").addEventListener("click",g),m()});function w(){const l=document.getElementById("estudiantes-fieldset");estudiantes.push({id:"",nro_registro:"",nombre_completo:"",carrera_id:""}),l.innerHTML="",m();const t=l.lastElementChild;t.scrollIntoView(),t.querySelector("div.input-group input").focus()}function m(){const l=document.getElementById("estudiantes-fieldset");for(let t in estudiantes){let n=estudiantes[t];const e=new b(t);e.setValue(n),e.setCarreras(carreras),e.setOnChange(s=>{e.setValue(s),estudiantes[t]=s}),e.setOnQuitar(()=>{estudiantes.splice(t,1),l.innerHTML="",m()}),e.setOnSearch(async s=>{const a=e.inputs.nombre_completo,o=e.inputs.id;if(!s)return;const i=await fetch("/estudiantes/"+s);if(i.status==404){a.readOnly=!1;return}if(i.status==200){const r=await i.json();a.value=r.nombre_completo,a.dispatchEvent(new Event("change")),o.value=r.id,o.dispatchEvent(new Event("change")),a.readOnly=!0}}),e.render(l)}}
