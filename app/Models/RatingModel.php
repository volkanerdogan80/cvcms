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
        'remote_addr' => 'required|valid_ip',
        'vote' => 'required|numeric|less_than_equal_to[10]',
    ];

    public function getRatingAvgByContentId($content_id)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->where('content_id', $content_id);
        $builder = $builder->selectAvg('vote');
        return $builder->first()->vote;
    }

    public function getRatingControlByRemoteAddr($content_id, $remote_addr)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->where('content_id', $content_id);
        $builder = $builder->where('remote_addr', $remote_addr);
        return $builder->first();
    }

    public function getRatingCountByContentID($content_id): array
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->where('content_id', $content_id);
        $builder = $builder->select('vote');
        $builder = $builder->selectCount('vote', 'count');
        $builder = $builder->groupBy('vote');
        return $builder->findAll();
    }
}