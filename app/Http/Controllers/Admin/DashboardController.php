<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $user_id = auth()->user()->id;
        $language = User::where('id', $user_id)->value('language');
        session()->put('locale', $language);
        return view('admin.pages.dashboard');
    }

    /**
     * Change the application language.
     *
     * @param string $locale Locale to be set.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLanguage(string $locale): \Illuminate\Http\RedirectResponse
    {
        $user_id = auth()->user()->id;
        User::where('id', $user_id)->update(['language' => $locale]);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
