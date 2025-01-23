<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideosController extends Controller
{
    public function testedBy($tester)
    {
        return "The tester is $tester";
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);
        $embedUrl = str_replace('watch?v=', 'embed/', $video->url);

        return view('video.show', compact('video', 'embedUrl'));
    }
}
