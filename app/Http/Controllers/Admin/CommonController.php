<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    public function upload()
    {
        $targetFolder = '/uploads'; // Relative to the root
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $fileParts = pathinfo($_FILES['file']['name']);
            $extension = strtolower($fileParts['extension']);
            $newName = date('YmdHis') . mt_rand(100, 999) . '.' .$extension;
            $targetFile = rtrim($targetPath, '/') . '/' . $newName;
            //图片格式的验证
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
            if (in_array($extension, $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                $data = [
                    'filepath' => $newName,
                    'status' => 0,
                    'msg' => '图片已上传成功'
                ];
            } else {
                $data = [
                    'filepath' => '',
                    'status' => 1,
                    'msg' => '上传失败，不支持此图片类型'
                ];
            }
            return $data;
        }
    }

    public function imageUpload()
    {
        $targetFolder = '/uploads'; // Relative to the root
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $fileParts = pathinfo($_FILES['file']['name']);
            $extension = strtolower($fileParts['extension']);
            $newName = secure_url('uploads').'/'.date('YmdHis') . mt_rand(100, 999) . '.' .$extension;
            $targetFile = rtrim($targetPath, '/') . '/' . $newName;
            //图片格式的验证
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
            if (in_array($extension, $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                $data['code'] =0;
                $data['msg'] ='';
                $data['data'] =['src'=>$newName];
            } else {
                $data['code'] =1;
                $data['msg'] ='未上传成功';
                $data['data'] =['src'=>''];
            }
            return $data;
        }
    }

    public function uploadVideo()
    {
        $targetFolder = '/uploads'; // Relative to the root
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $fileParts = pathinfo($_FILES['file']['name']);
            $extension = strtolower($fileParts['extension']);
            $newName = date('YmdHis') . mt_rand(100, 999) . '.' .$extension;
            $targetFile = rtrim($targetPath, '/') . '/' . $newName;
            //图片格式的验证
            $fileTypes = array('mp4', 'avi','ogg'); // File extensions
            if (in_array($extension, $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                $data = [
                    'filepath' => $newName,
                    'status' => 0,
                    'msg' => '视频已上传成功'
                ];
            } else {
                $data = [
                    'filepath' => '',
                    'status' => 1,
                    'msg' => '上传失败，不支持此视频类型'
                ];
            }
            return $data;
        }
    }

}

