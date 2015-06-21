<?php

include("model/model.php");
include("view/view.php");


$_model = new model();
switch($_GET['strona']){

    case 'rezerwacja' :
        $bookId = $_GET['bookId'];
        if(!empty($bookId)){
            $res = $_model->rezerwacja_ksiazki($bookId);
            if($res){
                echo "{status:zarezerwowana}";
            }else{
                echo "{status:blad-rezerwacji}";
            }
        }

        break;



}
