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
        'remote_addr' => 'required|valid_ip'
    ];

    public function getUserLikeControl($content_id, $remote_addr)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->where('content_id', $content_id);
        $builder = $builder->where('remote_addr', $remote_addr);
        return $builder->first();
    }

    public function getContentLikeControl($content_id)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->where('content_id', $content_id);
        return $builder->countAllResults();
    }

    public function getContentLikeCount($content_id)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->where('content_id', $content_id);
        $builder = $builder->selectCount('content_id', 'like');
        return $builder->first()->like;
    }
}