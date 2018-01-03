<?php
header("HTTP/1.0 404 Not Found");

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

// 获取当前状态码，并设置新的状态码
var_dump(http_response_code(404));

//获取新的状态码
var_dump(http_response_code());

// We'll be outputting a PDF
header('Content-type: application/pdf');
// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="downloaded.pdf"');
// The PDF source is in original.pdf
readfile('original.pdf');

header("Location: http://www.example.com/"); /* Redirect browser */

/* Make sure that code below does not get executed when we redirect. */
exit;
?>

