<?php
namespace App\Interfaces;

interface ContentInterface
{

    public function listing($status = null);
    public function create();
}