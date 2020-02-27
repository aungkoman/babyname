<?php
echo "ord ( A ) is : ";
echo ord('A');
echo "<br>";
echo "ord ( က ) is : ";
echo ord('က');

function uniord($u) {
        $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
        $k1 = ord(substr($k, 0, 1));
        $k2 = ord(substr($k, 1, 1));
        return $k2 * 256 + $k1;
}
echo uniord('ب');
echo "<br> uniord ( က  ) is : ".uniord('က');
echo "<br> uniord ( h ) is : ".uniord('h');

$numArr = array(12, 4, 4, 97, 26);
echo "<br> Min value for (12, 4, 62, 97, 26)  is ";
echo (min(12, 4, 4, 97, 26)); 

$index = array_keys($numArr, min($numArr));
print_r($index);
?>