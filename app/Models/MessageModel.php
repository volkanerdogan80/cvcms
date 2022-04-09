<?php


namespace App\Models;

use App\Entities\MessageEntity;
use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = "messages";
    protected $primaryKey = "id";

    protected $returnType = MessageEntity::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'message_id',
        'name',
        'email',
        'phone',
        'web',
        'subject',
        'message',
        'status',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'message_id' => 'permit_empty|numeric',
        'name'       => 'required|string',
        'email'      => 'required|valid_email',
        'phone'      => 'permit_empty|string',
        'web'        => 'permit_empty|valid_url',
        'subject'    => 'required|string',
        'message'    => 'required|string|min_length[20]'
    ];

    public function getMessage($params, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        $builder = $builder->where('message_id', null);
        $builder = $withDeleted ?  $builder->withDeleted() : $builder;

        return $builder->first();
    }

    public function getMessages($params, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        $builder = $withDeleted ?  $builder->withDeleted() : $builder;
        $builder = $builder->where('message_id', null);
        $builder = $builder->orderBy('created_at', 'DESC');

        return $builder->findAll();
    }

    public function getMessagesByStatus($status = STATUS_UNREAD, $per_page = false, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        $builder = $builder->where('message_id', null);
        $builder = $builder->orderBy('created_at', 'DESC');

        if(!$per_page){
            return $builder->findAll();
        }

        return [
            'messages' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    public function getMessageById($id, $status = STATUS_UNREAD, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('id', $id);
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ?  $builder->withDeleted() : $builder;
        $builder = $builder->where('message_id', null);
        $builder = $builder->orderBy('created_at', 'DESC');

        return $builder->first();
    }

    public function getMessagesByMessageId($message_id, $status = STATUS_UNREAD, $per_page = false, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('message_id', $message_id);
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ?  $builder->withDeleted() : $builder;
        $builder = $builder->orderBy('created_at', 'DESC');

        if(!$per_page){
            return $builder->findAll();
        }

        return [
            'messages' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    public function getMessagesByDeleted($per_page = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->orderBy('created_at', 'DESC');
        $builder = $builder->where('message_id', null);
        $builder = $builder->onlyDeleted();

        if(!$per_page){
            return $builder->findAll();
        }

        return [
            'messages' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }
}