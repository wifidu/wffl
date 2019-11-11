<?php

namespace App\Handlers;

use Illuminate\Support\Str;

class ImageUploadsHandler
{
    //只允许下列后缀名图片文件上传
    protected $allowed_ext = ['png', 'jpg', 'gif', 'jpeg'];

    public function save($file, $folder, $file_prefix)
    {
        //构建存储的文件夹规则，值如：uploads/images/avatars/201802/03
        //文件夹切割能让查找效率更高
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());
        
        //文件具体的物理存储路径，`public_path()` 获取的是`public`
        //文件夹的物理路径。值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201802/03
        $upload_path = public_path() . '/' . $folder_name;

        //获取文件夹的后缀名，因为图片从剪贴板里粘贴的时后缀为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getCilentOriginalExtension()) ?: 'png';

        //拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的ID
        //值如：1_1493521050_7BVc9v9ujP.png
        $filename = $fiel
    }
}

?>
