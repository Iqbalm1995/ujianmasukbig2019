<?php
$jumlah = 5;
for ($i=1; $i<=$jumlah-1; $i++){
    for ($j=1; $j<=$i; $j++){
        echo $j;
    }
    for ($j=1; $j<=$jumlah-$i; $j++){
        echo "&nbsp;&nbsp;";
    }
    for ($j=$i; $j>=1; $j--){
        echo $j;
    }
    echo "<br>";
}
for($i=1; $i<=$jumlah; $i++) echo $i;
for($i=$jumlah-1; $i>=1; $i--) echo $i;
echo "<br>";
for ($i=1; $i<=$jumlah-1; $i++){
    for ($j=1; $j<=$jumlah-$i; $j++){
        echo $j;
    }
    for ($j=1; $j<=$i; $j++){
        echo "&nbsp;&nbsp;";
    }
    for ($j=$jumlah-$i; $j>=1; $j--){
        echo $j;
    }
    echo "<br>";
}
?>