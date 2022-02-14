<?php


namespace App\Models;

use CodeIgniter\Model;

class FirebaseModel extends Model
{

    protected $table      = 'firebase_token';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'token'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = false;

    protected $validationRules = [
        'token' => 'required',
    ];


    public function getTokens($offset = 0, $limit = 1000): array
    {
        $offset = $limit * $offset;
        return $this->setTable($this->table)->findAll(1000, $offset);
    }

    public function getTokenCount($limit = 1000): int
    {
        $count = $this->setTable($this->table)->countAllResults();
        return intval(($count/$limit));
    }

}
