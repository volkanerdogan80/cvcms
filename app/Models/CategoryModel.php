<?php


namespace App\Models;

use App\Entities\CategoryEntity;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Model;

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

    /**
     * Gönderilen parametre değerlerini where sorgu ile geriye bir tane kategori döner
     * @param $params
     * @param $withDeleted
     * @return array|object|null
     */
    public function getCategory($params, $withDeleted)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        $builder = $builder->where($params);
        return $builder->first();
    }

    /**
     * Slug değeri ile işleşen bir tane kategori getirir
     * @param $category_slug
     * @param string $status
     * @param bool $withDeleted
     * @return array|object|null
     */
    public function getCategoryBySlug($category_slug, string $status = STATUS_ACTIVE, bool $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        $builder = $builder->where('slug', $category_slug);
        return $builder->first();
    }

    /**
     * ID değeri ile eşleşen bir tane kategori getirir
     * @param $category_id
     * @param string $status
     * @param bool $withDeleted
     * @return array|object|null
     */
    public function getCategoryById($category_id, string $status = STATUS_ACTIVE, bool $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        $builder = $builder->where('id', $category_id);
        return $builder->first();
    }

    /**
     * Status durumu ile eşleşen kategorileri getirir
     * @param $status
     * @param bool|null $per_page
     * @param bool $withDeleted
     * @return array
     */
    public function getCategoriesByStatus($status, ?bool $per_page = false, bool $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('status', $status);
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        $builder = $builder->orderBy('id', 'DESC');

        if(!$per_page){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    /**
     * User ID değeri ile eşleşen kategorileri getirir
     * @param $user_id
     * @param bool|null $per_page
     * @param string $status
     * @param bool $withDeleted
     * @return array
     */
    public function getCategoriesByUserId($user_id, ?bool $per_page = false, string $status = STATUS_ACTIVE, bool $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        $builder = $builder->where('user_id', $user_id);
        $builder = $builder->orderBy('id', 'DESC');

        if(!$per_page){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    /**
     * Bir içeriğin bağlı olduğu kategorileri getirir
     * @param $content_id
     * @param string $status
     * @param bool $withDeleted
     * @return array
     */
    public function getCategoriesByContentId($content_id, string $status = STATUS_ACTIVE, bool $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        $builder = $builder->whereIn('id', function (BaseBuilder $builder) use($content_id){
            return $builder->select('category_id')
                ->from('content_categories')
                ->where('content_id', $content_id);
        });

        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;

        return $builder->findAll();
    }

    /**
     * Bir içeriğin bağlı olduğu bir tane kategoriyi getirir
     * @param $content_id
     * @param string $status
     * @param bool $withDeleted
     * @return array|object|null
     */
    public function getCategoryByContentId($content_id, string $status = STATUS_ACTIVE, bool $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        $builder = $builder->whereIn('id', function (BaseBuilder $builder) use($content_id){
            return $builder->select('category_id')
                ->from('content_categories')
                ->where('content_id', $content_id);
        });

        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;

        return $builder->first();
    }

    /**
     * Parent ID değeri ile eşleşen kategorileri getirir
     * @param $parent_id
     * @param bool|null $per_page
     * @param string $status
     * @param bool $withDeleted
     * @return array
     */
    public function getCategoriesByParentId($parent_id, ?bool $per_page = false, string $status = STATUS_ACTIVE, bool $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;

        $builder = $builder->where('parent_id', $parent_id);
        $builder = $builder->orderBy('id', 'DESC');

        if(!$per_page){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    /**
     * Parent ID değeri ile eşleşen bir tane kategori getirir
     * @param $parent_id
     * @param string $status
     * @param bool $withDeleted
     * @return array|object|null
     */
    public function getCategoryByParentId($parent_id, string $status = STATUS_ACTIVE, bool $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        $builder = $builder->where('parent_id', $parent_id);
        $builder = $builder->orderBy('id', 'DESC');

        return $builder->first();
    }

    public function getListing(
        ?string $status = null,
        ?string $user = null,
        ?string $module = null,
        ?string $search = null,
        ?array  $dateFilter = null,
        ?int    $perPage = 20
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