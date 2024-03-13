<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        session()->put('locale', 'en');
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
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
