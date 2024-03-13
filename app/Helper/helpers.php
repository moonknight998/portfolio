<?php

use Detection\MobileDetect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

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

function ShowLocaleSetting() : string {
    $currentLocale = app()->getLocale();
    switch ($currentLocale) {
        case 'en':
            return __('admin/common.english');
        case 'vi':
            return __('admin/common.vietnamese');
        default:
            return __('admin/common.vietnamese');
    }
}

function ShowLocaleDropdown() : string {
    $currentLocale = app()->getLocale();
    switch ($currentLocale) {
        case 'en':
            return __('admin/common.vietnamese');
        case 'vi':
            return __('admin/common.english');
        default:
            return __('admin/common.vietnamese');
    }
}

function RefeshLocale($locale)
{
    app()->setLocale($locale);
    redirect(Route::currentRouteName());
}
