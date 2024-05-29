<?php

use App\Modules\Biblioteca\Models\TrabajoGrado;

it("genera un codigo valido cuando la base de datos esta vacia", function(){
    $this->travelTo("2020/05/11");
    $trabajoGrado = TrabajoGrado::factory()->create();
    expect($trabajoGrado->codigo)->toBe("2020/1");
});

it("genera un codigo valido cuando existen trabajos registrados", function(){
    $this->travelTo("2020/05/11");
    TrabajoGrado::factory(4)->create();
    $trabajoGrado = TrabajoGrado::factory()->create();    
    expect($trabajoGrado->codigo)->toBe("2020/5");
});

it("genera un codigo valido cuando existen trabajos registrados en distintos años", function(){
    $this->travelTo("2020/05/11");
    TrabajoGrado::factory(4)->create();
    $this->travelTo("2021/05/11");
    TrabajoGrado::factory(6)->create();
    $trabajoGrado = TrabajoGrado::factory()->create();
    expect($trabajoGrado->codigo)->toBe("2021/7");
});