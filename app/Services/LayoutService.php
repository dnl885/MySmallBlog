<?php

namespace App\Services;

use App\Models\Post;

class LayoutService
{
    public function archive():array{
        $posts = Post::latest()->get();

        $archive = [];

        foreach($posts as $post){
            $date = $post->getRawOriginal('created_at');

            $year = date('Y',strtotime($date));
            $monthText = date('F',strtotime($date));
            $monthNum = date('m',strtotime($date));

            $key = $monthText.' '.$year;

            $value = [
                'y'=>$year,
                'm'=>$monthNum
            ];

            $archive[$key] = $value;
        }
        return $archive;
    }
}
