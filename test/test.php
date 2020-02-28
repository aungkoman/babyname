<?php
header('Content-Type: text/html; charset=utf-8');
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


$num = "4ks5jdf;";
$newstr = filter_var($num, FILTER_VALIDATE_INT);
if(filter_var($num, FILTER_VALIDATE_INT)){
        echo "num is int";
} else{
        echo "num is not int";
}
echo "num 23 is ".$newstr;


echo "<hr>";
//$dad = "အောင်";
$dad = "aung";
$dadData = "အောင်";
echo "<br> dad is ".$dad;
echo "<script> ";
echo "var i = 'အောင်'; ";
echo "console.log(i); ";
echo "console.log(i.length); ";

/*
        ref; https://www.php.net/manual/en/function.strlen.php
        I want to share something seriously important for newbies or beginners of PHP who plays with strings of UTF8 encoded characters or the languages like: Arabic, Persian, Pashto, Dari, Chinese (simplified), Chinese (traditional), Japanese, Vietnamese, Urdu, Macedonian, Lithuanian, and etc.
As the manual says: "strlen() returns the number of bytes rather than the number of characters in a string.", so if you want to get the number of characters in a string of UTF8 so use mb_strlen() instead of strlen().

*/
/*
        For example:

        $str = "Kąt";
        $str[0] = "K";
        $str[1] = "�";
        $str[2] = "�";
        $str[3] = "t";
        but I would like to have:

        $str[0] = "K";
        $str[1] = "ą";
        $str[2] = "t";
        It is possible with mb_substr but this is extremely slow, ie.

        mb_substr($str, 0, 1) = "K"
        mb_substr($str, 1, 1) = "ą"
        mb_substr($str, 2, 1) = "t"
*/
echo "</script>";
// mb_strlen()
me("strlen for $dad ".strlen($dad));
me("strlen for $dad ".mb_strlen($dad));
me("----------------------------------------");

for($i = 0 ; $i < mb_strlen($dad); $i++){
        echo "<br> $i : ".mb_substr($dad,$i,1);
}
# utf8_encode ( string $data ) : string
$dad = utf8_encode ( $dad ) ;
echo "<br> utf8 dad is ".$dad;
echo "<br>strlen for dadData";
echo strlen($dadData);
echo "<br> this is ".$dadData[0];
echo "<br> this is ".$dadData[1];
echo "<br> uniord .".uniord($dadData[1]);
for($j = 0; $j < strlen($dadData); $j++){
        if($j >= strlen($dad) ) continue;
        echo "<br>codePoint for $dadData[$j] is ".codePoint($dadData[$j]);
        echo "<br>codePoint for $dad[$j] is ".codePoint($dad[$j]);
        $dadDiff += abs(codePoint($dadData[$j]) - codePoint($dad[$j]) );
        echo "<br>dadDiff is ".$dadDiff;
}

function codePoint($u) {
        $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
        $k1 = ord(substr($k, 0, 1));
        $k2 = ord(substr($k, 1, 1));
        return $k2 * 256 + $k1;
}
function me($str){
        echo "<p>".$str."</p>";
}

?>