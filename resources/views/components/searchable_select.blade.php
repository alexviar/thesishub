@once
@push("styles")
<style>
    .form-select.dropdown-toggle:after {
        content: none;
    }

    .form-select.dropdown-toggle {
        text-align: left
    }

    .form-select + .dropdown-menu {
        user-select: none;
    }

    .dropdown-label {
        overflow-x: auto;
        scrollbar-width: none;
    }

    .dropdown-label::-webkit-scrollbar {
        display: none; /* Oculta la barra de desplazamiento */
    }

    div.dropdown-item:focus-visible {
        outline: none;
    }

    .dropdown-menu-span {
        left: 0 !important;
        right: 0 !important;
    }

    .dropdown-item.active .text-muted, .dropdown-item:active .text-muted {
        color: #fff !important;
        font-weight: 100;
    }

    .dropdown-search-item {
        position: sticky;
        top: -0.5em;
        background: #fff;
        border-top: #fff solid 0.5em;
        margin-top: -0.5em;
        border-bottom: #fff solid 0.5em;
    }
</style>
@endpush
@push("scripts")
<script>
    function initializeSelector(id, {
        name,
        value,
        options,
        placeholder,
        onChange
    }) {
        const container = typeof id == "string" ? document.querySelector(`#${id}`) : id;
        const menu = container.querySelector(".dropdown-menu");
        const hiddenInput = container.querySelector("input[type=hidden]");
        const placeholderContainer = container.querySelector(".dropdown-placeholder");
        const labelContainer = container.querySelector(".dropdown-label");
        const searchInput = container.querySelector("input[type=search]");
        let lastActiveItem = null

        hiddenInput.name = name
        placeholderContainer.innerHTML = placeholder ?? ""

        container.classList.add("dropdown")
        container.addEventListener('shown.bs.dropdown', function() {
            searchInput.focus();
        });
        container.addEventListener('hidden.bs.dropdown', function() {
            searchInput.value = "";

            const event = new Event('input', {
                bubbles: true,
            });
            searchInput.dispatchEvent(event);
        })
        searchInput.addEventListener("keyup", function(e) {
            if (e.key == "ArrowDown") {
                menu.querySelectorAll(".dropdown-item:not(li.d-none > *)")[0].focus()
            }
        })

        function activeItem(item) {
            // lastActiveItem?.classList.remove("active");
            // item.classList.add("active");
            lastActiveItem?.classList.remove("d-none");
            item.classList.add("d-none");

            lastActiveItem = item
        }

        function selectOption({
            id,
            label,
            item
        }) {
            value = id;
            activeItem(item);
            hiddenInput.value = id;
            labelContainer.innerHTML = label;
            placeholderContainer.classList.add("d-none");
            labelContainer.classList.remove("d-none");
        }

        function renderOptions() {
            for (option of options) {
                const {
                    id,
                    label,
                    subtext
                } = option
                const item = document.createElement("li")
                const content = item.appendChild(document.createElement("div"));
                content.tabIndex = "0"
                content.classList.add("dropdown-item")

                if (value == id) {
                    selectOption({
                        id,
                        label: `${label} - ${subtext}`,
                        item: content
                    });
                }
                content.innerHTML = `<div>${label}</div><div class="text-muted small">${subtext}</div>`;
                item.addEventListener("click", () => {
                    selectOption({
                        id,
                        label: `${label} - ${subtext}`,
                        item: content
                    })
                    onChange(id)
                });
                item.addEventListener("keyup", (e) => {
                    if (e.key == "Enter") {
                        item.click();
                    }
                });
                searchInput.addEventListener("input", ({
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

                menu.appendChild(item)
            }
        }

        renderOptions();
    }
</script>
@endpush
@endonce

<div tabindex="0" class="form-select dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    <div style="min-height:1.5em">
        <input type="hidden">
        <div class="dropdown-placeholder"></div>
        <div class="dropdown-label"></div>
    </div>
</div>
<ul class="dropdown-menu dropdown-menu-span" style="max-height:22em;overflow-y:auto" aria-label="Lista de carreras">
    <li class="dropdown-search-item"><span class="dropdown-item-text" href="#"><input class="form-control" type="search" aria-label="Buscar"></span></li>
</ul>