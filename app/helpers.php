<?php


use Illuminate\Http\UploadedFile;

function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');
    if (func_num_args() == 0) {
        return $flash;
    }
    return $flash->info($title, $message);
}

function getTypeOfUser($str){

    switch ($str) {
        case "1":
            return "سوپر ادمین";
        case "2":
            return "ادمین";
        case "3":
            return "استاد اولیه";
        case "4":
            return "استاد";
        case "5":
            return "کاربر";
        default:
            return "نامعلوم";
    }
}

function getLevelOfUser($str){

    switch ($str) {
        case "1":
            return "مربی";
        case "2":
            return "استادیار";
        case "3":
            return "دانشیار";
        case "4":
            return "استاد";
        case "5":
            return "دانشجو";
        case "6":
            return "کاربر عادی";
        default:
            return "نامعلوم";
    }
}

function getCourseType($str){

    switch ($str) {
        case "1":
            return "1";
        case "2":
            return "2";
        case "3":
            return "3";
        case "4":
            return "4";
        case "5":
            return "5";
        default:
            return "نامعلوم";
    }
}

function getTestType($str){

    switch ($str) {
        case "1":
            return "1";
        case "2":
            return "2";
        case "3":
            return "3";
        case "4":
            return "4";
        case "5":
            return "5";
        default:
            return "نامعلوم";
    }
}

function makePhotoTypeFile(UploadedFile $file,$type){
    /* set the path */
    $path=photoPath($type);
    /* set the name of file */
    $name=namedFile($file->getClientOriginalName());
    /* save file*/
    $file->move($path, $name);

    $file_path=$path.''.$name;

    /* return file path */
    return $file_path;
}

/* set photo path */
function photoPath($type){
    $date=\Carbon\Carbon::now()->format('Y-m-d');
    return 'photos/'.$type.'/'.$date.'/';
}

/* set the name of file */
function namedFile($name){
    return time().'_'.$name;
}
