<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{


    public function home(): View
    {

        $feedItems = [];
        if(auth()->check()) {
            $feedItems = auth()->user()->feed->paginate(15);
        }
        return view('static_pages/home', compact('feedItems'));
    }

    public function help(): View
    {
        return view('static_pages/help');
    }

    public function about(): View
    {
        return view('static_pages/about');
    }
}
