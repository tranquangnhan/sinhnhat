<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CURDController;

class PostController extends CURDController
{
    /**
     * The attributes prefix for each model.
     */
    protected string $prefix = 'Post';
    protected string $files = 'admin.Post.';
}