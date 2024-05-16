<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    /**
     * web route
     * Display avatar image
     * Use middleware with web route to protect image
     */
    public function __invoke( $var1, $var2)
    {
        return Storage::disk('files')->get('/avatars/'.$var1.'/'.$var2);
    }
}