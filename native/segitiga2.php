<?php  
$jumlah = 3;

for($a=1; $a<=$jumlah; $a++){
    for($b=1; $b<=$a; $b++){
        echo "&nbsp;";
    }
    for($c=$jumlah; $c>=$a; $c-=1){
        echo '*';
    }
    echo "<br>";
}
for($c=$jumlah; $c>=$a; $c-=1){
    echo '* ';
}
for($a=1+1; $a<=$jumlah; $a++){
    for($b=$jumlah; $b>=$a; $b-=1){
        echo "&nbsp;";
    }
    for($c=1; $c<=$a; $c++){
        echo '*';
    }
    echo "<br>";
}
?>
