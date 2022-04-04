<?php


namespace App\Models;

use App\Entities\ComponentEntity;
use CodeIgniter\Model;

class ComponentModel extends Model
{
    protected $table = 'components';
    protected $primaryKey = 'id';
    protected $returnType = ComponentEntity::class;

    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'folder',
        'name',
        'author',
        'web',
        'email',
        'status',
        'settings'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'folder'    => 'required|string|is_unique[components.folder,id,{id}]',
        'name'      => 'required|string',
        'author'    => 'permit_empty|string',
        'web'       => 'permit_empty|valid_url',
        'email'     => 'permit_empty|valid_email',
        'status'    => 'required',
        'settings'  => 'permit_empty'
    ];

    public function getComponent($params, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        return $builder->first();
    }

    public function getComponentById($component_id, $status = STATUS_ACTIVE, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('id', $component_id);
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;

        return $builder->first();
    }

    public function getComponentByFolder($component_folder, $status = STATUS_ACTIVE, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('folder', $component_folder);
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;

        return $builder->first();
    }

    public function getComponentsByStatus($status = STATUS_ACTIVE, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('status', $status);
        $builder = $withDeleted ?  $builder->withDeleted() : $builder;

        return $builder->findAll();
    }
}