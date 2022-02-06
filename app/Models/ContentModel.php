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

    public function getListing(
        ?string $module     = null,
        ?string $status     = null,
        ?string $user       = null,
        ?int $category      = null,
        ?string $search     = null,
        ?array $dateFilter  = null,
        ?int $perPage       = 20
    )
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('contents.*');

        $module = is_null($module) ? config('system')->blog : $module;

        $builder = $builder->where('module', $module);
        $builder = $status == 'deleted' ? $builder->onlyDeleted() : $builder;
        $builder = $status == strtolower(STATUS_ACTIVE) ? $builder->where('contents.status', STATUS_ACTIVE) : $builder;
        $builder = $status == strtolower(STATUS_PASSIVE) ? $builder->where('contents.status', STATUS_PASSIVE) : $builder;
        $builder = $status == strtolower(STATUS_PENDING) ? $builder->where('contents.status', STATUS_PENDING) : $builder;

        $builder = !is_null($user) ? $builder->where('contents.user_id', $user) : $builder;

        if (!is_null($category)){
            $builder = $builder->where('content_categories.category_id', $category)->join('content_categories', 'content_categories.content_id = contents.id');
        }

        if(!is_null($search)){
            $builder = $builder->groupStart();
            $builder = $builder->like('contents.title', $search);
            $builder = $builder->orLike('contents.description', $search);
            $builder = $builder->orLike('contents.keywords', $search);
            $builder = $builder->groupEnd();
        }

        if (!is_null($dateFilter)){
            $builder = $builder->where('contents.created_at >', $dateFilter[0]);
            $builder = $builder->where('contents.created_at <', $dateFilter[1]);
        }

        $builder = $builder->orderBy('contents.created_at', 'DESC');

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

    public function getRecent($module, $limit, $category)
    {
        $builder = $this->prepareBuilder($module, $category);

        $builder = $builder->orderBy('contents.id', 'DESC');

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
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