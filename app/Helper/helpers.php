<?php

use Detection\MobileDetect;
use Illuminate\Support\Facades\File;

function HandleUpload($inputName, $model = null)
{
    try
    {
        if(request()->hasFile($inputName))
        {
            if(File::exists(public_path($model->{$inputName})))
            {
                File::delete(public_path($model->{$inputName}));
            }

            $file = request()->file($inputName);
            $fileName = rand().$file->getClientOriginalName();
            $file->move(public_path('/uploads'), $fileName);

            $filePath = "/uploads/".$fileName;

            return $filePath;
        }
    }
    catch(\Exception $e)
    {
        throw $e;
    }
}

function ShowTextData($model, $name, $previewText)
{
    if($model)
    {
        if($model->{$name} === "")
        {
            return $previewText;
        }
        else
        {
            return $model->{$name};
        }
    }
    else
    {
        return $previewText;
    }
}

function ShowFormValue($model, $name)
{
    if($model)
    {
        if($model->{$name} === "")
        {
            return old($name);
        }
        else
        {
            return $model->{$name};
        }
    }
    else
    {
       return "";
    }
}

function MobileDetect()
{
    $detect = new MobileDetect();
    return $detect;
}

function GetMaxFileSizeUpload() : int {
    return 2097152;
}
