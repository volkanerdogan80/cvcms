<?php
namespace App\Interfaces;

interface ContentInterface
{

    public function listing($status = null);

    public function create();

    public function edit($id);

    public function status();

    public function delete();

    public function undoDelete();

    public function purgeDelete();
}
