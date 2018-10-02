<?php

use App\Models\AdminSetting;
use Carbon\Carbon;
use App\Models\Role;
//use Intervention\Image\Image;


function checkRolePermission($role_task, $my_role)
{

    $role = Role::findOrFail($my_role);
    if (!empty($role->actions)) {
        if (!empty($role->actions)) {
            $tasks = array_filter(explode('|', $role->actions));
        }
        if (isset($tasks)) {
            if (in_array($role_task, $tasks) && array_key_exists($role_task, actions())) {
                return 1;
            } else {
                return 0;
            }
        }
    }
    return 0;
}

function role($val = null)
{
    $myrole = array(
        1 => __('Admin'),
        2 => __('User')
    );
    if ($val == null) {
        return $myrole;
    } else {
        return $myrole[$val];
    }
    return $myrole;
}

function gender($val = null)
{
    $sex = array(
        1 => __('Not Defined'),
        2 => __('Male'),
        3 => __('Female')
    );
    if ($val == null) {
        return $sex;
    } else {
        return $sex[$val];
    }
}

function allsetting($a = null)
{

    if ($a == null) {
        $allsettings = AdminSetting::get();
        if ($allsettings) {
            $output = [];
            foreach ($allsettings as $setting) {
                $output[$setting->slug] = $setting->value;
            }
            return $output;
        }
        return false;
    } else {
        $allsettings = AdminSetting::where(['slug' => $a])->first();
        if ($allsettings) {
            $output = $allsettings->value;
            return $output;
        }
        return false;
    }
}


//Random string
function randomString($a)
{
    $x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $c = strlen($x) - 1;
    $z = '';
    for ($i = 0; $i < $a; $i++) {
        $y = rand(0, $c);
        $z .= substr($x, $y, 1);
    }
    return $z;
}

// random number
function randomNumber($a = 10)
{
    $x = '0123456789';
    $c = strlen($x) - 1;
    $z = '';
    for ($i = 0; $i < $a; $i++) {
        $y = rand(0, $c);
        $z .= substr($x, $y, 1);
    }
    return $z;
}

//use array key for validator
function arrKeyOnly($array, $seperator = ',', $exception = [])
{
    $string = '';
    $sep = '';
    foreach ($array as $key => $val) {
        if (in_array($key, $exception) == false) {
            $string .= $sep . $key;
            $sep = $seperator;
        }
    }
    return $string;
}





// Multiple image uploading
function multipleuploadimage($images, $path, $width = null, $height = null)
{
    if (isset($images[0])) {
        $imgNames = [];
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        foreach ($images as $img) {

            // saving image in target path
            $imgName = uniqid() . '.' . $img->getClientOriginalExtension();
            $imgPath = public_path($path . '/' . $imgName);

            // making image
            $makeImg = Image::make($img);
            if ($width != null && $height != null && is_int($width) && is_int($height)) {
                $makeImg->fit($width, $height);
            }

            if ($makeImg->save($imgPath)) {
                uploadthumb($img, path_prodthumb(), $imgName, 150, 150);
                $imgNames[] = $imgName;
            }
        }

        return $imgNames;
    }

}


function fileUpload($new_file, $path, $old_file_name = null)
{
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    if (isset($old_file_name) && $old_file_name != "" && file_exists($path . $old_file_name)) {
        unlink($path . '/' . $old_file_name);
    }
    $input['imagename'] = time() . '.' . $new_file->getClientOriginalExtension();
    $destinationPath = public_path($path);
    $new_file->move($destinationPath, $input['imagename']);

    return $input['imagename'];
}

//Image Thumb Upload System
function uploadthumb($img, $path, $name, $width = null, $height = null,$old_file_name=null)
{

    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    if (isset($old_file_name) && $old_file_name != "" && file_exists($path . $old_file_name)) {
        unlink($path.$old_file_name);
    }

    $imgName = $name.$img->getClientOriginalName();
    $imgPath = public_path($path . $imgName);

//    dd($imgPath);
    // making image
    $makeImg = Image::make($img);
    if ($width != null && $height != null && is_int($width) && is_int($height)) {
        $makeImg->fit($width, $height);
    }

    if ($makeImg->save($imgPath)) {
        return $imgName;
    }
    return false;
}

// Remove Uploaded image
function removeuploadedimage($imgName, $path)
{
    $imagePath = public_path($path) . $imgName;
    $deletedImg = File::delete($imagePath);

    if ($deletedImg) {
        return true;
    }
    return false;
}

function removeImage($path, $file_name)
{
    if (isset($file_name) && $file_name != "" && file_exists($path . $file_name)) {
        unlink($path . $file_name);
    }
}


//Advertisement image path
function path_image()
{
    return 'admin/images/img';
}
function path_daily_update()
{
    return 'assets/img/dailyupdate/';
}
function path_user_image()
{
    return 'assets/img/userimg/';
}
function check_language($lang){
    $a=language();
    if(array_key_exists($lang, $a)==true){
        return $lang;
    }
    return null;
}
function language($a=null, $langtype=""){//json
    $directories = array();
    $path = base_path('resources/lang');
    if($langtype=='json'){
        $path .= '/';
        $initial = opendir($path);
        if ($dh = $initial){
            while (($file = readdir($dh)) !== false){
                if(strlen($file)==7 && substr($file, 2)=='.json'){
                    $a=substr($file, 0,2);
                    $directories[$a] = $a;
                }
            }
            closedir($dh);
        }
    }
    else{
        $initial = scandir($path);
        foreach($initial as $init){
            if($init !='.' && $init !='..' && strlen($init)==2 && strpos($init, '.') != true){
                $directories[$init] =  $init;
            }
        }
    }
    if($a==null){
        return $directories;
    }
    else{
        return $directories[$a];
    }



}

