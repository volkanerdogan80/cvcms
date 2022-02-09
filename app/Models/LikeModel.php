<?php


namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table      = 'content_likes';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'content_id',
        'remote_addr',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = false;

    protected $validationRules = [
        'content_id' => 'required|numeric',
        'remote_addr' => 'required|valid_ip|is_unique[content_likes.remote_addr]'
    ];
}