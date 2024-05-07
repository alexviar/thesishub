@extends('layout.main')
@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Formulario de búsqueda -->
            <div class="card">
                <div class="card-header">Buscar Registros</div>
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="keyword">Palabra Clave:</label>
                            <input type="text" class="form-control" id="keyword" name="keyword">
                        </div>
                        <div class="form-group">
                            <label for="theme">Tema:</label>
                            <input type="text" class="form-control" id="theme" name="theme">
                        </div>
                        <div class="form-group">
                            <label for="author">Autor:</label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                        <div class="form-group">
                            <label for="tutor">Tutor:</label>
                            <input type="text" class="form-control" id="tutor" name="tutor">
                        </div>
                        <div class="form-group">
                            <div class="row"> 
                            <div class=col-md-6>
                                <label for="start_date">Fecha Inicio:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class=col-md-6>
                                <label for="end_date">Fecha Fin:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                            </div>
                           
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Listado de registros -->
            <div class="card">
                <div class="card-header">Resultados de Búsqueda</div>
                <div class="card-body">
                 
                        <table class="table">
                           
                            <tbody>
                        
                                <tr>
                                  <td> 2024/#2345 </td>
                                </tr>
                                <tr>
                                  <td> TItulo </td>
                                </tr>
                                <tr>
                                  <td> Detalle <br> <hr> </td>
                                </tr>


                                <tr>
                                  <td> 2024/#2346 </td>
                                </tr>
                                <tr>
                                  <td> TItulo </td>
                                </tr>
                                <tr>
                                  <td> Detalle <br> <hr> </td>
                                </tr>


                                <tr>
                                  <td> 2024/#2347 </td>
                                </tr>
                                <tr>
                                  <td> TItulo </td>
                                </tr>
                                <tr>
                                  <td> Detalle <br> <hr> </td>
                                </tr>


                                <tr>
                                  <td> 2024/#2348 </td>
                                </tr>
                                <tr>
                                  <td> TItulo </td>
                                </tr>
                                <tr>
                                  <td> Detalle <br> <hr> </td>
                                </tr>
                            </tbody>
                        </table>
               
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
