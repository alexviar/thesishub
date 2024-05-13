export class SearchableSelect {
    constructor({
        id,
        name,
        value,
        onChange,
        placeholder,
        options,
        container
    }){
        this.container = container
        this.value = value
        this.onChange = onChange
        this.options = options
        container.innerHTML = `<div tabindex="0" class="form-select dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <div style="min-height:1.5em">
                <input type="hidden">
                <div class="dropdown-placeholder"></div>
                <div class="dropdown-label"></div>
            </div>
        </div>
        <ul class="dropdown-menu dropdown-menu-span" style="max-height:20em;overflow-y:auto" aria-label="Lista de carreras">
            <li class="dropdown-search-item"><span class="dropdown-item-text" href="#"><input class="form-control" type="search" aria-label="Buscar"></span></li>
        </ul>`
        this.menu = container.querySelector(".dropdown-menu");
        this.hiddenInput = container.querySelector("input[type=hidden]");
        this.placeholderContainer = container.querySelector(".dropdown-placeholder");
        this.labelContainer = container.querySelector(".dropdown-label");
        this.searchInput = container.querySelector("input[type=search]");
        this.lastActiveItem = null

        this.hiddenInput.id = id
        this.hiddenInput.name = name
        this.placeholderContainer.innerHTML = placeholder ?? ""

        container.classList.add("dropdown")
        container.addEventListener('shown.bs.dropdown', () => {
            this.searchInput.focus();

            setTimeout(()=>{
                this.lastActiveItem?.scrollIntoView({ block: 'nearest', inline: 'start' })
            })
        });
        container.addEventListener('hidden.bs.dropdown', () => {
            this.searchInput.value = "";

            const event = new Event('input', {
                bubbles: true,
            });
            this.searchInput.dispatchEvent(event);

            const activeItem = this.menu.querySelector(".active")
            if(activeItem && this.lastActiveItem !== activeItem){
                activeItem.classList.remove("active")
                this.lastActiveItem?.classList.add("active")
            }
        })

        this.searchInput.addEventListener("keydown", (e) => {
            if (e.key == "ArrowDown") {
                const navigateDown = ()=>{
                    const items = [].concat(
                        ...this.menu.querySelectorAll(".dropdown-item:not(li.d-none > *):not(.disabled):not(:disabled)")
                    );
                    const activeItemIndex = items.findIndex(item => item.classList.contains("active"))
                    if(activeItemIndex != -1){
                        items[activeItemIndex].classList.remove("active")
                    }
                    const item = items[(activeItemIndex + 1) % this.options.length]
                    item.classList.add("active")
                    item.scrollIntoView({ block: 'nearest', inline: 'start' })
                }
                navigateDown()
            }
            else if (e.key == "ArrowUp") {
                const navigateDown = ()=>{
                    const items = [].concat(
                        ...this.menu.querySelectorAll(".dropdown-item:not(li.d-none > *):not(.disabled):not(:disabled)")
                    );
                    const activeItemIndex = items.findIndex(item => item.classList.contains("active"))
                    if(activeItemIndex != -1){
                        items[activeItemIndex].classList.remove("active")
                    }
                    const item = items[(activeItemIndex -  1 + this.options.length) % this.options.length]
                    item.classList.add("active")
                    item.scrollIntoView({ block: 'nearest', inline: 'start' })
                }
                navigateDown()
            }
            else if(e.key == "Enter") {
                const activeItem = this.menu.querySelector(".active")
                if(activeItem){
                    activeItem.click();
                }
                e.preventDefault()
                e.stopPropagation()
                return false
            }
        })
        this.searchInput.addEventListener("keydown", (e) => {

        });

        this.renderOptions();
    }    

    activeItem(item) {
        this.lastActiveItem?.classList.remove("active");
        item.classList.add("active");
        // this.lastActiveItem?.classList.remove("d-none");
        // item.classList.add("d-none");

        this.lastActiveItem = item
    }

    selectOption({
        id,
        label,
        item
    }) {
        this.value = id;
        this.activeItem(item);
        this.hiddenInput.value = id;
        this.labelContainer.innerHTML = label;
        this.placeholderContainer.classList.add("d-none");
        this.labelContainer.classList.remove("d-none");
    }
    

    renderOptions() {
        for (let option of this.options) {
            const {
                id,
                label,
                subtext
            } = option
            const item = document.createElement("li")
            const content = item.appendChild(document.createElement("div"));
            content.tabIndex = "0"
            content.classList.add("dropdown-item")

            if (this.value == id) {
                this.selectOption({
                    id,
                    label: `${label} - ${subtext}`,
                    item: content
                });
            }
            content.innerHTML = `<div>${label}</div><div class="text-muted small">${subtext}</div>`;
            content.addEventListener("focus", (e)=>{
                this.searchInput.focus()
            })
            item.addEventListener("click", () => {
                this.selectOption({
                    id,
                    label: `${label} - ${subtext}`,
                    item: content
                })
                this.onChange(id)
            });
            this.searchInput.addEventListener("input", ({
                target: {
                    value
                }
            }) => {
                const match = !value || label.toLowerCase().includes(value.toLowerCase());
                if (match) {
                    item.classList.remove("d-none");
                } else {
                    item.classList.add("d-none");
                }
                return true
            })

            this.menu.appendChild(item)
        }
    }
}