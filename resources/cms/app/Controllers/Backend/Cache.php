<?php


namespace App\Controllers\Backend;

use \App\Controllers\BaseController;

class Cache extends BaseController
{

    public function clean()
    {
        cache()->clean();
        return redirect()->back()->with('success', lang('Success.text.cache_clean'));
    }

}