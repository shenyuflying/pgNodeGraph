<?php
$content = $_POST['content'];

$filename = date("Y-m-d-H-i-s").'-'.rand(10000,9999);

$myfile = fopen('text/'.$filename, "w") or die("Unable to open file!");

fwrite($myfile, $content);
fclose($myfile);

$cmd = "bin/node2dot --skip-empty --color  < text/$filename > dot/$filename 2> /dev/null && /usr/bin/dot -Tsvg dot/$filename -o svg/$filename 2>/dev/null && sed 's/:f[0-9][0-9]*//g' -i svg/$filename";

system($cmd);

$showpage = file_get_contents('show.html');
$showpage = str_replace("__________FILENAME__________",$filename,$showpage);
echo $showpage;