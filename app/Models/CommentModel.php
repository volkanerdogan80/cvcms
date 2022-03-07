<?php

namespace App\Models;
use App\Entities\CommentEntity;
use \CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = "comments";
    protected $primaryKey = "id";

    protected $returnType = CommentEntity::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'content_id',
        'comment_id',
        'name',
        'email',
        'comment',
        'status',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'content_id' => 'required|numeric',
        'comment_id' => 'permit_empty|numeric',
        'name'       => 'required|string',
        'email'      => 'required|valid_email',
        'comment'    => 'required|string',
        'status'     => 'required|string'
    ];

    public function getComment($params, $withDeleted = false){
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        $builder = $withDeleted ? $builder = $builder->withDeleted() : $builder;

        return $builder->first();
    }

    public function getComments($params, $withDeleted = false){
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        $builder = $withDeleted ? $builder = $builder->withDeleted() : $builder;
        $builder = $builder->orderBy('id', 'DESC');

        return $builder->findAll();
    }

    public function getCommentsByStatus($status = STATUS_ACTIVE, $withDeleted = false){
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('status', $status);
        $builder = $withDeleted ? $builder = $builder->withDeleted() : $builder;
        $builder = $builder->orderBy('id', 'DESC');

        return $builder->findAll();
    }

    public function getCommentsByContentId($content_id, $status = STATUS_ACTIVE, $withDeleted = false){
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('content_id', $content_id);
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder = $builder->withDeleted() : $builder;
        $builder = $builder->orderBy('id', 'DESC');

        return $builder->findAll();
    }

    public function getCommentsByCommentId($comment_id, $status = STATUS_ACTIVE, $withDeleted = false){
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('comment_id', $comment_id);
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder = $builder->withDeleted() : $builder;
        $builder = $builder->orderBy('id', 'DESC');

        return $builder->findAll();
    }

    public function getCommentsCountByContentId($content_id, $status = STATUS_ACTIVE, $withDeleted = false){
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('content_id', $content_id);
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder = $builder->withDeleted() : $builder;
        $builder = $builder->orderBy('id', 'DESC');

        return $builder->countAllResults();
    }

    public function getListing(
        ?string $status,
        ?int $content,
        ?array $content_list,
        ?string $search     = null,
        ?array $dateFilter  = null,
        ?int $perPage       = 20
    )
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('comments.*');
        if (is_null($status) || $status == strtolower(STATUS_ACTIVE)){
            $builder = $builder->where('comment_id', null);
        }

        $builder = $status == 'deleted' ? $builder->onlyDeleted() : $builder;
        $builder = $status == strtolower(STATUS_ACTIVE) ? $builder->where('comments.status', STATUS_ACTIVE) : $builder;
        $builder = $status == strtolower(STATUS_PENDING) ? $builder->where('comments.status', STATUS_PENDING) : $builder;
        $builder = count($content_list) > 0 ? $builder->whereIn('comments.content_id', $content_list) : $builder;
        $builder = !is_null($content) ? $builder->where('comments.content_id', $content) : $builder;

        if(!is_null($search)){
            $builder = $builder->groupStart();
            $builder = $builder->like('comments.name', $search);
            $builder = $builder->orLike('comments.email', $search);
            $builder = $builder->orLike('comments.comment', $search);
            $builder = $builder->groupEnd();
        }

        if (!is_null($dateFilter)){
            $builder = $builder->where('comments.created_at >', $dateFilter[0]);
            $builder = $builder->where('comments.created_at <', $dateFilter[1]);
        }

        $builder = $builder->orderBy('comments.created_at', 'DESC');

        return [
            'comments' => $builder->paginate($perPage),
            'pager' => $builder->pager
        ];
    }

}