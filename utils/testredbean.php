<?php
// Include the RedBean framework
require '../redbean/rb.php';

// Setup database connection
R::setup( 'mysql:host=localhost;dbname=cartodb', 'root', '' ); 

// Freeze the model in production
R::freeze(TRUE);

//$book = R::dispense( 'book' );
//$book->title = 'Cartotool';
//$book->price = 3.459;
//$id = R::store( $book );

$book = R::load( 'book', 1 ); //reloads our book

print_r($book);




