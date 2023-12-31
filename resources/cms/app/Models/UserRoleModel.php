<?php

namespace App\Models;

use App\Entities\GroupEntity;
use CodeIgniter\Model;

class UserRoleModel extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'id';

    protected $returnType = GroupEntity::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'slug',
        'title',
        'permissions',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'slug' => 'required|is_unique[groups.slug,id,{id}]',
        'title' => 'required',
        'permissions' => 'required'
    ];

    protected $validationMessages = [
        'slug' => [
            'required' => 'Validation.text.slug_required',
            'is_unique' => 'Validation.text.slug_unique',
        ],
        'title' => [
            'required' => 'Validation.text.title_required',
        ],
        'permissions' => [
            'required' =>  'Validation.text.permissions_required',
        ]
    ];

    public function getListing(
        ?string $type = null,
        ?string $search = null,
        ?int $perPage = null)
    {
        $builder = !is_null($search) ? $this->like('title', $search) : $this;
        $builder = $type == 'delete' ? $builder->onlyDeleted() : $builder;

        if(is_null($perPage)){
            return [
                'groups' => $builder->findAll(),
            ];
        }

        $builder = $builder->orderBy('created_at', 'DESC');

        return [
            'groups' => $builder->paginate($perPage),
            'pager' => $builder->pager,
        ];
    }

}