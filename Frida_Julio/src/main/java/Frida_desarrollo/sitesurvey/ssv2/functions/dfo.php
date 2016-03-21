<?php
function dfo(){
    $dfo = '';
    for($i = 101; $i <= 9999; $i++){
        if($i >= 101 && $i <= 999){
            $dfo .= '<option value="0'.$i.'">0'.$i.'</option>';
        }
        else{
            $dfo .= '<option value="'.$i.'">'.$i.'</option>';
        }
    }
    return $dfo;
}
?>
