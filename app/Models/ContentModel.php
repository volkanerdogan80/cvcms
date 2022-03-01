<?php

namespace App\Models;

use App\Entities\ContentEntity;
use CodeIgniter\Database\BaseBuilder;
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
        'post_format',
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
        'slug'           => 'required|alpha_numeric_punct',
        'title'          => 'required|string',
        'description'    => 'permit_empty|string',
        'content'        => 'permit_empty|string',
        'keywords'       => 'permit_empty|string',
        'thumbnail'      => 'permit_empty|numeric',
        'gallery'        => 'permit_empty|string',
        'comment_status' => 'required|string',
        'field'          => 'permit_empty|string',
        'page_type'      => 'permit_empty|string',
        'post_format'    => 'permit_empty|string',
        'similar'        => 'permit_empty|string',
        'status'         => 'required|string',
    ];

    protected $beforeInsert = ['insertSlugControl'];
    protected $beforeUpdate = ['updateSlugControl'];

    protected function insertSlugControl($params)
    {
        $params['data']['slug'] = $this->uniqueSlug($params['data']['slug']);
        return $params;
    }

    protected function updateSlugControl($params)
    {
        if(!isset($params['data']['slug'])){
            return $params;
        }

        if($content = $this->getContent(['slug' => $params['data']['slug'], 'id' => $params['id'][0]], true)){
            $params['data']['slug'] = $content->getSlug();
            return $params;
        }

        if($content = $this->getContent(['title' => $params['data']['title'], 'id' => $params['id'][0]], true)){
            $params['data']['slug'] = $content->getSlug();
            return $params;
        }

        $params['data']['slug'] = $this->uniqueSlug($params['data']['slug']);
        return $params;

    }

    protected function uniqueSlug($slug)
    {
        if($this->getContentBySlug($slug, null, true)){
            $new_slug = increment_string($slug,'-');
            return $this->uniqueSlug($new_slug);
        }
        return $slug;
    }

    /**
     * Array olarak gönderilen değerleri where sorgusu ile 1 tane içerik döner
     * @param $params
     * @return array|object|null
     */
    public function getContent($params, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        if($withDeleted)
            $builder = $builder->withDeleted();
        return $builder->first();
    }

    /**
     * Array olarak gönderilen değerleri where sorgusu ile tüm içerikleri döner
     * @param $params
     * @return array|object|null
     */
    public function getContents($params)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        return $builder->findAll();
    }

    /**
     * Slug değeri ile içerik bilgilerini getirir
     * @param $content_slug
     * @param null $status
     * @return array|object|null
     */
    public function getContentBySlug($content_slug, $status = null, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        if (!is_null($status))
            $builder = $builder->where('status', $status);
        if($withDeleted)
            $builder = $builder->withDeleted();
        $builder = $builder->where('slug', $content_slug);
        return $builder->first();
    }

    /**
     * ID değeri ile içerik bilgilerini getirir
     * @param $content_id
     * @param null $status
     * @return array|object|null
     */
    public function getContentById($content_id, $status = null, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        if (!is_null($status))
            $builder = $builder->where('status', $status);
        if($withDeleted)
            $builder = $builder->withDeleted();

        $builder = $builder->where('id', $content_id);
        return $builder->first();
    }

    /**
     * ID veya ID'leri olan içerikleri getirir
     * @param $content_ids
     * @param null $per_page
     * @param null $status
     * @return array
     */
    public function getContentByIds($content_ids, $per_page = null, $status = null)
    {
        if (!is_array($content_ids))
            $content_ids = explode(',', $content_ids);

        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        if (!is_null($status))
            $builder = $builder->where('status', $status);

        $builder = $builder->whereIn('id', $content_ids);
        $builder = $builder->orderBy('id', 'DESC');

        if(is_null($per_page)){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    /**
     * Status durumuna göre içerikleri getirir
     * @param $status
     * @param null $per_page
     * @return array
     */
    public function getContentsByStatus($status, $per_page = null)
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

    /**
     * Post Type değeri ile eşleşen içerikleri getirir
     * @param $post_type
     * @param null $per_page
     * @param null $status
     * @return array
     */
    public function getContentByPostType($post_type, $per_page = null, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        if (!is_null($status))
            $builder = $builder->where('status', $status);

        $builder = $builder->where('post_type', $post_type);
        $builder = $builder->orderBy('id', 'DESC');

        if(is_null($per_page)){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    /**
     * Comment Status ile işleşen içerikleri getirir
     * @param $comment_status
     * @param null $per_page
     * @param null $status
     * @return array
     */
    public function getContentByCommentStatus($comment_status, $per_page = null, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        if (!is_null($status))
            $builder = $builder->where('status', $status);

        $builder = $builder->where('comment_status', $comment_status);
        $builder = $builder->orderBy('id', 'DESC');

        if(is_null($per_page)){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    /**
     * Sayfa Türü ile işleşen içerikleri getirir
     * @param $page_type
     * @param null $per_page
     * @param null $status
     * @return array
     */
    public function getContentByPageType($page_type, $per_page = null, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        if (!is_null($status))
            $builder = $builder->where('status', $status);

        $builder = $builder->where('page_type', $page_type);
        $builder = $builder->orderBy('id', 'DESC');

        if(is_null($per_page)){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    /**
     * User ID değeri ile eşleşen içerikleri getirir
     * @param $user_id
     * @param null $per_page
     * @param null $status
     * @return array
     */
    public function getContentsByUserId($user_id, $per_page = null, $status = null)
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

    /**
     * Bir kategoride yer alan içerikleri getirir
     * @param $category_id
     * @param null $per_page
     * @param null $status
     * @return array
     */
    public function getContentsByCategoryId($category_id, $per_page = null, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        $builder = $builder->whereIn('id', function (BaseBuilder $builder) use($category_id){
            return $builder->select('content_id')
                ->from('content_categories')
                ->where('category_id', $category_id)
                ->distinct();
        });

        if (!is_null($status))
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

    /**
     * Birden fazla kategoriye ait içerikleri getirir
     * @param $category_ids
     * @param null $per_page
     * @param null $status
     * @return array
     */
    public function getContentsByCategoryIds($category_ids, $per_page = null, $status = null)
    {
        if (!is_array($category_ids))
            $category_ids = explode(',', $category_ids);

        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        $builder = $builder->whereIn('id', function (BaseBuilder $builder) use($category_ids){
            return $builder->select('content_id')
                ->from('content_categories')
                ->whereIn('category_id', $category_ids)
                ->distinct();
        });

        if (!is_null($status))
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

    public function getListing(array $filter = [])
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('contents.*');
        $builder = $builder->where('module', $filter['module']);
        $builder = $filter['status'] == 'deleted' ? $builder->onlyDeleted() : $builder;
        $builder = $filter['status'] == strtolower(STATUS_ACTIVE) ? $builder->where('contents.status', STATUS_ACTIVE) : $builder;
        $builder = $filter['status'] == strtolower(STATUS_PASSIVE) ? $builder->where('contents.status', STATUS_PASSIVE) : $builder;
        $builder = $filter['status'] == strtolower(STATUS_PENDING) ? $builder->where('contents.status', STATUS_PENDING) : $builder;

        if(isset($filter['user']) && !is_null($filter['user'])){
            $builder->where('contents.user_id', $filter['user']);
        }

        if (isset($filter['category']) && !is_null($filter['category'])){
            $builder = $builder->where('content_categories.category_id', $filter['category']);
            $builder = $builder->join('content_categories', 'content_categories.content_id = contents.id');
        }

        if (isset($filter['search']) && !is_null($filter['search'])) {
            $builder = $builder->groupStart();
            $builder = $builder->like('contents.title', $filter['search']);
            $builder = $builder->orLike('contents.description', $filter['search']);
            $builder = $builder->orLike('contents.keywords', $filter['search']);
            $builder = $builder->groupEnd();
        }

        if (isset($filter['dateFilter']) && !is_null($filter['dateFilter'])){
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

        //TODO: Try catch ile yapılmış. Bir sorun olursa kaynaklara bakılacak.
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

    public function search($search, $perPage = 20)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('status', STATUS_ACTIVE);
        $builder = $builder->groupStart();
        $builder = $builder->like('contents.title', $search);
        $builder = $builder->orLike('contents.description', $search);
        $builder = $builder->orLike('contents.keywords', $search);
        $builder = $builder->groupEnd();

        return [
            'contents' => $builder->paginate($perPage),
            'pager' => $builder->pager
        ];
    }

    public function getNextContent($content_id)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('status', STATUS_ACTIVE);
        $builder = $builder->where('id >', $content_id);
        $builder = $builder->orderBy('id', 'ASC');
        return $builder->first();
    }

    public function getPrevContent($content_id)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('status', STATUS_ACTIVE);
        $builder = $builder->where('id <', $content_id);
        $builder = $builder->orderBy('id', 'DESC');
        return $builder->first();
    }

    public function prepareBuilder($module, $format, $category){

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

        if(!is_null($format)){
            $builder = $builder->where('contents.post_format', $format);
        }

        return $builder;
    }

    public function getRandom($module, $format, $limit, $category)
    {

        $builder = $this->prepareBuilder($module, $format, $category);

        $builder = $builder->orderBy('contents.id', 'RANDOM');

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }

    public function getRecent($module, $format, $limit, $offset, $category)
    {
        $builder = $this->prepareBuilder($module, $format, $category);

        $builder = $builder->orderBy('contents.id', 'DESC');

        return [
            'contents' => !is_null($offset) ? $builder->findAll($limit, $offset) : $builder->paginate($limit),
            'pager' => !is_null($offset) ? null : $builder->pager
        ];
    }

    public function getWeekTop($module, $format, $limit, $category)
    {

        $builder = $this->prepareBuilder($module, $format, $category);

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

    public function getMonthTop($module, $format, $limit, $category): array
    {
        $builder = $this->prepareBuilder($module, $format, $category);

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

    public function getMostRead($module, $format, $limit, $category)
    {

        $builder = $this->prepareBuilder($module, $format, $category);

        $builder = $builder->orderBy('contents.views', 'DESC');

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }

    public function getMostComment($module, $format, $limit, $category): array
    {
        $builder = $this->prepareBuilder($module, $format, $category);

        $builder = $builder->join('comments', 'contents.id = comments.content_id');
        $builder = $builder->selectCount('comments.content_id', 'comment_count');
        $builder = $builder->groupBy('comments.content_id');

        $builder = $builder->orderBy('comment_count', 'DESC');

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }

    public function getTopLiked($module, $format, $limit, $category)
    {
        $builder = $this->prepareBuilder($module, $format, $category);

        if(!is_null($format)){
            $builder = $builder->where('contents.post_format', $format);
        }

        $builder = $builder->join('content_likes', 'contents.id = content_likes.content_id');
        $builder = $builder->selectCount('content_likes.content_id', 'like_count');
        $builder = $builder->groupBy('content_likes.content_id');

        $builder = $builder->orderBy('like_count', 'DESC');

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }

    public function getTopFavorite($module, $format, $limit, $category)
    {
        $builder = $this->prepareBuilder($module, $format, $category);

        if(!is_null($format)){
            $builder = $builder->where('contents.post_format', $format);
        }

        $builder = $builder->join('content_favorites', 'contents.id = content_favorites.content_id');
        $builder = $builder->selectCount('content_favorites.content_id', 'favorite_count');
        $builder = $builder->groupBy('content_favorites.content_id');

        $builder = $builder->orderBy('favorite_count', 'DESC');

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }

    public function getTopVoted($module, $format, $limit, $category)
    {
        $builder = $this->prepareBuilder($module, $format, $category);

        $builder = $builder->join('content_rating', 'contents.id = content_rating.content_id');
        $builder = $builder->selectCount('content_rating.content_id', 'vote_count');
        $builder = $builder->groupBy('content_rating.content_id');

        $builder = $builder->orderBy('vote_count', 'DESC');

        return [
            'contents' => $builder->paginate($limit),
            'pager' => $builder->pager
        ];
    }

    public function getTopRating($module, $format, $limit, $category)
    {
        $builder = $this->prepareBuilder($module, $format, $category);

        if(!is_null($format)){
            $builder = $builder->where('contents.post_format', $format);
        }

        $builder = $builder->join('content_rating', 'contents.id = content_rating.content_id');
        $builder = $builder->selectAvg('content_rating.vote', 'vote_avg');
        $builder = $builder->groupBy('content_rating.content_id');

        $builder = $builder->orderBy('vote_avg', 'DESC');

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

    public function getUserContent($user, $limit, $pager, $module, $category, $format)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('contents.*');
        $builder = $builder->where('contents.status', STATUS_ACTIVE);
        $builder = $builder->where('contents.user_id', $user);

        if (!is_null($category)){
            $category = explode(',', $category);
            $builder = $builder->whereIn('content_categories.category_id', $category);
            $builder = $builder->join('content_categories', 'content_categories.content_id = contents.id');
            $builder = $builder->distinct();
        }

        if(!is_null($format)){
            $builder = $builder->where('contents.post_format', $format);
        }

        if(!is_null($module)){
            $builder = $builder->where('contents.module', $module);
        }

        if ($pager){
            return [
                'users' => $builder->paginate($limit),
                'pager' => $builder->pager
            ];
        }

        return $builder->findAll($limit);

    }

    public function getUserFavoriteContent($user, $limit, $pager, $module, $category, $format)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select(['contents.*']);

        $builder = $builder->whereIn('contents.id', function (BaseBuilder $builder) use($user){
            $builder = $builder->select('content_id');
            $builder = $builder->from('content_favorites');
            $builder = $builder->where('user_id', $user);
            return $builder;
        });

        if (!is_null($category)){
            $category = explode(',', $category);
            $builder = $builder->whereIn('content_categories.category_id', $category);
            $builder = $builder->join('content_categories', 'content_categories.content_id = contents.id');
            $builder = $builder->distinct();
        }

        if(!is_null($format)){
            $builder = $builder->where('contents.post_format', $format);
        }

        if(!is_null($module)){
            $builder = $builder->where('contents.module', $module);
        }

        if ($pager){
            return [
                'users' => $builder->paginate($limit),
                'pager' => $builder->pager
            ];
        }

        return $builder->findAll($limit);

    }
}