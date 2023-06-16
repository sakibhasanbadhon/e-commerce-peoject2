<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    protected function file_upload($file,$location) {
        $image_file = $file;
        $file_extension = $file->getClientOriginalExtension();
        $image_rename = time().rand().'.'.$file_extension;
        $image_file->move($location,$image_rename);
        return $image_rename;

    }


    protected function file_update($file,$folder,$old_file)
    {
        // previous file delete from resource
        if ($old_file != null) {
            file_exists($folder.$old_file) ? unlink($folder.$old_file) : false;
        }


        $file_extension = $file->getClientOriginalExtension();
        $product_image_name =  time().rand().'.'.$file_extension;
        $file->move($folder,$product_image_name);
        return $product_image_name;
    }





}
