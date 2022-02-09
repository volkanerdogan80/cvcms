<?php


namespace App\Models;

use CodeIgniter\Model;

class RatingModel extends Model
{
    protected $table      = 'content_rating';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'content_id',
        'remote_addr',
        'vote',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = false;

    protected $validationRules = [
        'content_id' => 'required|numeric',
        'remote_addr' => 'required|valid_ip|is_unique[content_rating.remote_addr]',
        'vote' => 'required|numeric|less_than_equal_to[10]',
    ];
}