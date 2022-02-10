<?php


namespace App\Models;

use CodeIgniter\Model;

class NewsletterModel extends Model
{
    protected $table      = 'newsletters';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name',
        'email',
        'token',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = false;

    protected $validationRules = [
        'name' => 'permit_empty|string',
        'email' => 'required|valid_email|is_unique[newsletters.email]',
        'token' => 'required|alpha',
    ];

    public function getListing(?string $search = null, ?array $dateFilter = null, ?int $perPage = 20)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('newsletters.*');

        if(!is_null($search)){
            $builder = $builder->groupStart();
            $builder = $builder->like('name', $search);
            $builder = $builder->orLike('email', $search);
            $builder = $builder->groupEnd();
        }

        if (!is_null($dateFilter)){
            $builder = $builder->where('created_at >', $dateFilter[0]);
            $builder = $builder->where('created_at <', $dateFilter[1]);
        }

        $builder = $builder->orderBy('created_at', 'DESC');

        return [
            'subscribers' => $builder->paginate($perPage),
            'pager' => $builder->pager
        ];
    }
}