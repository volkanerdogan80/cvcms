<?php


namespace App\Traits;


trait CacheTrait
{
    public function cacheClear()
    {
        cache()->clean();
    }
}
