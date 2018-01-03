<?php

var_dump($_FILES);

// 获取上传文件信息
$fileName = $_FILES['upload_file']['name'];
$fileType = $_FILES['upload_file']['type'];
$fileError = $_FILES['upload_file']['error'];
$fileSize = $_FILES['upload_file']['size'];

// 定义上传文件的类型
$typelist = array("image/jpeg", "image/jpg", "image/png", "image/gif");

if ($fileError > 0) {
// 上传文件错误编号判断
    switch ($fileError) {
        case 1:
            $message = "上传的文件超过了php.ini 中 upload_max_filesize 选项限制的值。";
            break;
        case 2:
            $message = "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。";
            break;
        case 3:
            $message = "文件只有部分被上传。";
            break;
        case 4:
            $message = "没有文件被上传。";
            break;
        case 6:
            $message = "找不到临时文件夹。";
            break;
        case 7:
            $message = "文件写入失败";
            break;
        case 8:
            $message = "由于PHP的扩展程序中断了文件上传";
            break;
    }

    if (!is_uploaded_file($tempName)) {
        exit("不是通过HTTP POST方式上传上来的");
    }
    if (!in_array($fileType, $typeList)) {
        exit("上传的文件不是指定类型");
    } else {
        if (!getimagesize($tempName)) {
            exit("上传的文件不是图片");                              // 避免用户上传恶意文件,如把病毒文件扩展名改为图片格式
        }
    }
    if ($fileSize > 100000) {
        exit("上传文件超出限制大小");                                 // 对特定表单的上传文件限制大小
    } else {
        //避免上传文件的中文名乱码
        $fileName = iconv("UTF-8", "GBK", $fileName);              // 把iconv抓取到的字符编码从utf-8转为gbk输出
        $fileName = str_replace(".", time() . ".", $fileName);       // 在图片名称后加入时间戳，避免重名文件覆盖
        if (move_uploaded_file($tempName, "uploads/" . $fileName)) {
            echo "上传文件成功！";
        } else {
            echo "上传文件失败";
        }
    }


    /**关于php上传文件的一些常用函数：

file_exists：检查文件或目录是否存在
is_uploaded_file：判断文件是否是通过 HTTP POST 上传的
move_uploaded_file：将上传的文件移动到新位置
is_writable：判断给定的文件名是否可写
iconv：字符编码互转
str_replace：字符串替换（更改文件名，防重名）
getimagesize：检查是否为图片文件（其他类型的文件就算后缀名改了也能被检测到），如果不能访问 filename 指定的图像或者其不是有效的图像，getimagesize() 将返回 FALSE 并产生一条 E_WARNING 级的错误。
   
     * 
     */
}
?>