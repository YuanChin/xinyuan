<?php

namespace App\Services\Web;

use Illuminate\Http\Request;

class UserService
{
    public function selectView(Request $request)
    {  
        $tab = $request->tab;
        switch ($tab) {
            case 'information':
                return view('users.parts.information');
                break;
            case 'post':
                return view('users.parts.post');
                break;
            case 'comment':
                return view('users.parts.comment');
                break;
            case 'favor':
                return view('users.parts.favor');
                break;
            case 'follow':
                return view('users.parts.follow');
                break;
            case 'fans':
                return view('users.parts.fans');
                break;
            default:
                return view('users.parts.information');
        }
    }
}