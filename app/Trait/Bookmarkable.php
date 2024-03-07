<?php

namespace App\Trait;

trait Bookmarkable
{

    public function bookmark()
    {
        $bookmark = $this->bookmarks()->where(
            'user_id',
            '=',
            auth()->id()
        );

        if ($bookmark->exists())
        {
            $bookmark->delete();
        }
        else
        {
            $this->bookmarks()->create(['user_id' => auth()->id()]);
        }
    }
}
