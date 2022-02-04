<?php


namespace App\Models;

use App\Entities\CategoryEntity;
use \CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $returnType = CategoryEntity::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'module',
        'user_id',
        'parent_id',
        'slug',
        'title',
        'description',
        'keywords',
        'image',
        'status',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'module'    => 'required|alpha_numeric',
        'user_id'   => 'required|numeric',
        'parent_id' => 'permit_empty|numeric',
        'slug'      => 'required|alpha_numeric_punct|is_unique[categories.slug,id,{id}]',
        'title'     => 'required',
        'image'     => 'permit_empty|numeric',
        'status'    => 'permit_empty|alpha',
    ];

    public function getListing(
        ?string $status = null,
        ?string $user = null,
        ?string $module = null,
        ?string $search = null,
        ?array $dateFilter = null,
        ?int $perPage = 20
    )
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('categories.*');

        $builder = $status == 'deleted' ? $builder->onlyDeleted() : $builder;
        $builder = $status == strtolower(STATUS_ACTIVE) ? $builder->where('status', STATUS_ACTIVE) : $builder;
        $builder = $status == strtolower(STATUS_PASSIVE) ? $builder->where('status', STATUS_PASSIVE) : $builder;

        $builder = !is_null($user) ? $builder->where('user_id', $user) : $builder;
        $builder = !is_null($module) ? $builder->where('module', $module) : $builder;

        if(!is_null($search)){
            $builder = $builder->groupStart();
            $builder = $builder->like('title', $search);
            $builder = $builder->orLike('description', $search);
            $builder = $builder->orLike('keywords', $search);
            $builder = $builder->groupEnd();
        }

        if (!is_null($dateFilter)){
            $builder = $builder->where('created_at >', $dateFilter[0]);
            $builder = $builder->where('created_at <', $dateFilter[1]);
        }

        $builder = $builder->orderBy('created_at', 'ASC');

        return [
            'categories' => $builder->paginate($perPage),
            'pager' => $builder->pager
        ];

    }

}