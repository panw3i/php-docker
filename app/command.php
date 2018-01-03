<?php 

exec("cat ~/.zsh_history", $data);
exec("cat ~/.bash_history", $data);

foreach ($data as $str) {
    $str = preg_replace('/[0-9]|:|;/', "", $str);

    $str = trim($str);

    $pattern = '/^[a-z]+/';
    preg_match($pattern, $str, $match);

    $tmp = array_shift($match);
    if ($tmp ! ==null) {
        $buff[] = $tmp;
    }
}
$buff = array_count_values($buff);
asort($buff);
var_dump($buff);
?>  