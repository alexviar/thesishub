<form id="form-busquedatrabajo" method="GET">
    <div class="form-group mb-3">
        <label for="keyword">Palabra Clave:</label>
        <input type="text" class="form-control" id="keyword" name="keyword" value="{{old('keyword')}}">
    </div>
    <div class="form-group mb-3">
        <label for="theme">Tema:</label>
        <input type="text" class="form-control" id="theme" name="theme" value="{{old('theme')}}">
    </div>
    <div class="form-group mb-3">
        <label for="author">Autor:</label>
        <input type="text" class="form-control" id="author" name="author" value="{{old('author')}}">
    </div>
    <div class="form-group mb-3">
        <label for="tutor">Tutor:</label>
        <input type="text" class="form-control" id="tutor" name="tutor" value="{{old('tutor')}}">
    </div>
    <div class="row">
        <div class="col-12 mb-2">Fecha de defensa</div>
        <div class="form-group mb-3 col-lg-6">
            <label for="start_date">Desde:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{old('start_date')}}">
        </div>
        <div class="form-group mb-3 col-lg-6">
            <label for="end_date">Hasta:</label>
            <input type="date" class="form-control" id="end_date" name="end_date"  value="{{old('end_date')}}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('#form-busquedatrabajo');

        form.addEventListener('submit', (e)=>{
            const allInputs = form.getElementsByTagName('input');

            for (var i = 0; i < allInputs.length; i++) {
                var input = allInputs[i];

                if (input.name && !input.value) {
                    input.name = '';
                }
            }
        });
    });
</script>
@endpush