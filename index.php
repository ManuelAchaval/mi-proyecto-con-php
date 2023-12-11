<?php
include 'clases/autoload.php';

$productos = Productos::product_select();

include 'views/home.html';
/*ejemplo de como imprimir una variable como en javascript
    $hola= "buenas ";
    echo '<pre>
    '.$hola.' loco,m soy cada dia mas pobre
    </pre>';*/