<?php

namespace App\Models;

use App\Entities\ContentEntity;
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class ContentModel extends Model
{
    protected $table      = 'contents';
    protected $primaryKey = 'id';

    protected $returnType = ContentEntity::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'module',
        'user_id',
        'slug',
        'title',
        'description',
        'content',
        'keywords',
        'thumbnail',
        'gallery',
        'views',
        'comment_status',
        'field',
        'page_type',
        'similar',
        'status',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'module'         => 'required|alpha_numeric',
        'user_id'        => 'required|numeric',
        'slug'           => 'required|alpha_numeric_punct|is_unique[contents.slug,id,{id}]',
        'title'          => 'required|string',
        'description'    => 'permit_empty|string',
        'content'        => 'permit_empty|string',
        'keywords'       => 'permit_empty|string',
        'thumbnail'      => 'permit_empty|numeric',
        'gallery'        => 'permit_empty|string',
        'comment_status' => 'required|string',
        'field'          => 'permit_empty|string',
        'page_type'      => 'permit_empty|string',
        'similar'        => 'permit_empty|string',
        'status'         => 'required|string',
    ];

    public function getListing(array $filter = [])
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('contents.*');
        $builder = $builder->where('module', $filter['module']);
        $builder = $filter['status'] == 'deleted' ? $builder->onlyDeleted() : $builder;
        $builder = $filter['status'] == strtolower(STATUS_ACTIVE) ? $builder->where('contents.status', STATUS_ACTIVE) : $builder;
        $builder = $filter['status'] == strtolower(STATUS_PASSIVE) ? $builder->where('contents.status', STATUS_PASSIVE) : $builder;
        $builder = $filter['status'] == strtolower(STATUS_PENDING) ? $builder->where('contents.status', STATUS_PENDING) : $builder;

        if(isset($filter['user']) && !is_null($filter['user']))
        {
            $builder->where('contents.user_id', $filter['user']);
        }

        if (isset($filter['category']) && !is_null($filter['category']))
        {
            $builder = $builder->where('content_categories.category_id', $filter['category']);
            $builder = $builder->join('content_categories', 'content_categories.content_id = contents.id');
        }

        if (isset($filter['search']) && !is_null($filter['search']))
        {
            $builder = $builder->groupStart();
            $builder = $builder->like('contents.title', $filter['search']);
            $builder = $builder->orLike('contents.description', $filter['search']);
            $builder = $builder->orLike('contents.keywords', $filter['search']);
            $builder = $builder->groupEnd();
        }

        if (isset($filter['dateFilter']) && !is_null($filter['dateFilter']))
        {
            $parseDate = explode(' - ', $filter['dateFilter']);
            $parseDate = count($parseDate) > 1 ? $parseDate : null;

            if(!is_null($parseDate)){
                $builder = $builder->where('contents.created_at >', $parseDate[0]);
                $builder = $builder->where('contents.created_at <', $parseDate[1]);
            }
        }

        $builder = $builder->orderBy('contents.created_at', 'DESC');

        $perPage = isset($filter['perPage']) && !is_null($filter['perPage']) ? $filter['perPage'] : 20;
        return [
            'contents' => $builder->paginate($perPage),
            'pager' => $builder->pager
        ];

    }

    public function category($type = null, $content_id = null, $categories = null)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('content_categories');
        if ($type == 'update' || $type == 'delete'){
            if(is_array($content_id)){
                foreach ($content_id as $item){
                    $builder->where('content_id', $item)->delete();
                }
            }else{
                $builder->where('content_id', $content_id)->delete();
            }
        }

        if($type == 'insert' || $type == 'update'){
            foreach ($categories as $category){
                $builder->insert([
                    'content_id'  => $content_id,
                    'category_id' => $category
                ]);
            }
        }

        if ($type == 'get'){
            return $builder->where('content_id', $content_id)->get()->getResult();
        }
    }

    public function share($type = null, $content_id = null, $social = 'twitter', $status = 1)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('content_share');

        if ($type == 'get'){
            return $builder->where('content_id', $content_id)
                ->where('status', 1)
                ->groupBy('social')
                ->get()
                ->getResult();
        }

        if ($type == 'shared'){
            return $builder->where('social', $social)
                ->where('content_id', $content_id)
                ->where('status', 1)
                ->get()->getFirstRow();
        }

        if ($type == 'publish'){
            $builder->insert([
                'content_id' => $content_id,
                'social' => ucfirst($social),
                'status' => $status
            ]);
        }

        if($type == 'delete'){
            if(is_array($content_id)){
                foreach ($content_id as $item){
                    $builder->where('content_id', $item)->delete();
                }
            }else{
                $builder->where('content_id', $content_id)->delete();
            }

        }
    }

    public function counter($social, $content_id){
        $db = \Config\Database::connect();
        $builder = $db->table('content_share');
        if($social == 'all'){
            return count($builder->where('content_id', $content_id)->get()->getResult());
        }
        return count($builder->where('social', $social)->where('content_id', $content_id)->get()->getResult());

    }

    public function prepareBuilder($module, $category){

        $builder = $this->setTable($this->table);
        $builder = $builder->select('contents.*');
        $builder = $builder->where('contents.status', STATUS_ACTIVE);

        if (!is_null($module)){
            $builder = $builder->where('contents.module', $module);
        }

        if (!is_null($category)){
            $category = explode(',', $category);
            $builder = $builder->whereIn('content_categories.category_id', $category);
            $builder = $builder->join('content_categories', 'content_categories.content_id = contents.id');
            $builder = $builder->distinct();
        }

        return $builder;
    }

    public function getRandom($module, $limit, $category)
    {

        $builder = $this->prepareBuilder($module, $category);


        $builder = $builder->orderBy('contents.id', 'RANDOM');

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }

    public function getRecent($module, $limit, $offset, $category)
    {
        $builder = $this->prepareBuilder($module, $category);

        $builder = $builder->orderBy('contents.id', 'DESC');

            return [
                'contents' => !is_null($offset) ? $builder->findAll($limit, $offset) : $builder->paginate($limit),
                'pager' => !is_null($offset) ? null : $builder->pager
            ];
    }

    public function getWeekTop($module, $limit, $category)
    {

        $builder = $this->prepareBuilder($module, $category);

        $builder = $builder->orderBy('contents.views', 'DESC');

        $start = new Time('-1 week');
        $end = new Time('now');

        $builder = $builder->where('contents.created_at >', $start);
        $builder = $builder->where('contents.created_at <', $end);

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }

    public function getMonthTop($module, $limit, $category): array
    {
        $builder = $this->prepareBuilder($module, $category);

        $builder = $builder->orderBy('contents.views', 'DESC');

        $start = new Time('-1 month');
        $end = new Time('now');

        $builder = $builder->where('contents.created_at >', $start);
        $builder = $builder->where('contents.created_at <', $end);

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }

    public function getMostRead($module, $limit, $category)
    {

        $builder = $this->prepareBuilder($module, $category);

        $builder = $builder->orderBy('contents.views', 'DESC');

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }

    public function getMostComment($module, $limit, $category): array
    {
        $builder = $this->prepareBuilder($module, $category);

        $builder = $builder->join('comments', 'contents.id = comments.content_id');
        $builder = $builder->selectCount('comments.content_id', 'comment_count');
        $builder = $builder->groupBy('comments.content_id');

        $builder = $builder->orderBy('comment_count', 'DESC');

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }

    public function getCategoryContent($category, $limit = 10): array
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('contents.*');

        $builder = $builder->where('contents.status', STATUS_ACTIVE);

        if (!is_null($category)){
            $category = explode(',', $category);
            $builder = $builder->whereIn('content_categories.category_id', $category);
            $builder = $builder->join('content_categories', 'content_categories.content_id = contents.id');
        }

        $builder = $builder->orderBy('contents.id', 'DESC');

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }
}