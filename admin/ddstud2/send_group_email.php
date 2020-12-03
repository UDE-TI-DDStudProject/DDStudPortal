<?php
$count = count($export_arr['email']);

$receivers = "";

//2do: check if email not empty or #adresses = #names
for ($i = 2; $i < $count; $i++) {

    $receivers = $receivers . $export_arr['firstname'][$i] . "%20" . $export_arr['surname'][$i] . "%20%3C" . $export_arr['email'][$i] . "%3E;";
}
$pre = "onclick=\"location.href='mailto:";
$post = "?subject=%20&body=Dear all,%20%0A '\";";
$nim = $pre . $receivers . $post;
echo $nim;
?>   