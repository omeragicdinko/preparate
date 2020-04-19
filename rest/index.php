<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');

require '../vendor/autoload.php';

Flight::register('db', 'PDO', array('mysql:host=remotemysql.com;dbname=22D7SSPtYw','22D7SSPtYw','0FZwBnSQli'));

Flight::route('GET /v1/babies', function(){
 $babies = Flight::db()->query('SELECT * FROM babies', PDO::FETCH_ASSOC)->fetchAll();
 Flight::json($babies);
});

Flight::route('GET /v1/baby_count', function(){
 $bab= Flight::db()->query('SELECT SUM(CASE WHEN gender="male" THEN 1 ELSE 0 END) Male,
SUM(CASE WHEN gender="female" THEN 1 ELSE 0 END) Female
FROM babies', PDO::FETCH_ASSOC)->fetchAll();
 Flight::json($bab);
});

Flight::route('POST /babies', function(){
    $request = Flight::request()->data->getData();
    print_r($request);
    $insert = "INSERT INTO babies (mother, gender, date1, time1, height, weight) VALUES(:mother, :gender, :date1, :time1, :height, :weight)";
    $stmt= Flight::db()->prepare($insert);
    $stmt->execute($request);
});

Flight::route('DELETE /babies/@id', function($id){
     $delete = "DELETE FROM babies WHERE id = :id";
     $stmt= Flight::db()->prepare($delete);
     $stmt->execute([":id" => $id]);
});

Flight::start();
?>
