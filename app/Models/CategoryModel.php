<?php


namespace App\Models;

use App\Entities\CategoryEntity;
use CodeIgniter\Database\BaseBuilder;
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

    public function getCategory($params)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        return $builder->first();
    }

    public function getCategoryBySlug($category_slug, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        if (!is_null($status))
            $builder = $builder->where('status', $status);
        $builder = $builder->where('slug', $category_slug);
        return $builder->first();
    }

    public function getCategoryById($category_id, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        if (!is_null($status))
            $builder = $builder->where('status', $status);
        $builder = $builder->where('id', $category_id);
        return $builder->first();
    }

    public function getCategoriesByStatus($status, $per_page = null)
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

    public function getCategoriesByUserId($user_id, $per_page = null, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        if (!is_null($status))
            $builder = $builder->where('status', $status);

        $builder = $builder->where('user_id', $user_id);
        $builder = $builder->orderBy('id', 'DESC');

        if(is_null($per_page)){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    public function getCategoriesByContentId($content_id, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        $builder = $builder->whereIn('id', function (BaseBuilder $builder) use($content_id){
            return $builder->select('category_id')
                ->from('content_categories')
                ->where('content_id', $content_id);
        });

        if (!is_null($status))
            $builder = $builder->where('status', $status);

        return $builder->findAll();
    }

    public function getCategoryByContentId($content_id, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        $builder = $builder->whereIn('id', function (BaseBuilder $builder) use($content_id){
            return $builder->select('category_id')
                ->from('content_categories')
                ->where('content_id', $content_id);
        });

        if (!is_null($status))
            $builder = $builder->where('status', $status);

        return $builder->first();
    }

    public function getCategoriesByParentId($parent_id, $per_page = null, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        if (!is_null($status))
            $builder = $builder->where('status', $status);

        $builder = $builder->where('parent_id', $parent_id);
        $builder = $builder->orderBy('id', 'DESC');

        if(is_null($per_page)){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    public function getCategoryByParentId($parent_id, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        if (!is_null($status))
            $builder = $builder->where('status', $status);

        $builder = $builder->where('parent_id', $parent_id);
        $builder = $builder->orderBy('id', 'DESC');

        return $builder->first();
    }




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