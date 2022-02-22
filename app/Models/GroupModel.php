<?php

namespace App\Models;

use App\Entities\GroupEntity;
use CodeIgniter\Model;

class GroupModel extends Model
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
        'slug'        => 'required|is_unique[groups.slug,id,{id}]',
        'title'       => 'required',
        'permissions' => 'required'
    ];


    public function getGroup($params)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        return $builder->first();
    }

    public function getGroupById($group_id, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('id', $group_id);
        if (!is_null($status))
            $builder = $builder->where('status', $status);

        return $builder->first();
    }

    public function getGroupBySlug($group_slug, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('slug', $group_slug);
        if (!is_null($status))
            $builder = $builder->where('status', $status);

        return $builder->first();
    }

    public function getGroupsByStatus($status, $per_page = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('status', $status);
        $builder = $builder->orderBy('id', 'DESC');

        if(is_null($per_page)){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

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