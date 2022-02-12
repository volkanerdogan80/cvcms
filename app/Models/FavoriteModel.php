<?php


namespace App\Models;

use CodeIgniter\Model;

class FavoriteModel extends Model
{
    protected $table      = 'content_favorites';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'content_id',
        'user_id',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = false;

    protected $validationRules = [
        'content_id' => 'required|numeric',
        'user_id' => 'required|numeric'
    ];

    public function getUserFavoriteControl($content_id)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->where('user_id',session('userData.id'));
        $builder = $builder->where('content_id', $content_id);
        return $builder->first();
    }

    public function getFavoriteCount($content_id)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->where('content_id', $content_id);
        return $builder->countAllResults();
    }
}