<?php


namespace App\Models;

use App\Entities\UserEntity;
use \CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $returnType = UserEntity::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'group_id',
        'first_name',
        'sur_name',
        'email',
        'password',
        'verify_key',
        'verify_code',
        'bio',
        'status',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'group_id'      => 'required|numeric',
        'first_name'    => 'required|string|min_length[3]',
        'sur_name'      => 'required|string|min_length[3]',
        'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password'      => 'required',
        'verify_key'    => 'required|alpha',
        'verify_code'   => 'numeric|min_length[6]',
        'status'        => 'required'
    ];


    public function getUser($params, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        return $builder->first();
    }

    public function getUserById($group_id, $status = null, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('id', $group_id);
        $builder = !is_null($status) ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;

        return $builder->first();
    }

    public function getUsersByGroupId($group_id, $per_page = null, $status = null, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('group_id', $group_id);
        $builder = !is_null($status) ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        $builder = $builder->orderBy('id', 'DESC');

        if(is_null($per_page)){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    public function getUserByVerifyKey($verify_key, $status = null, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('verify_key', $verify_key);
        $builder = !is_null($status) ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;

        return $builder->first();
    }

    public function getUsersByStatus($status, $per_page = null, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('status', $status);
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        $builder = $builder->orderBy('id', 'DESC');

        if(is_null($per_page)){
            return $builder->findAll();
        }

        return [
            'contents' => $builder->paginate($per_page),
            'pager' => $builder->pager
        ];
    }

    public function getGroupUsers($group, $pager, $limit)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('users.*');
        $builder = $builder->where('group_id', $group);

        if ($pager){
            return [
                'users' => $builder->paginate($limit),
                'pager' => $builder->pager
            ];
        }

        return $builder->findAll($limit);
    }


    public function getListing(
        ?string $status = null,
        ?string $search = null,
        ?int $group = null,
        ?array $dateFilter = null,
        ?int $perPage = 20)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('users.*');

        $builder = $status == 'deleted' ? $builder->onlyDeleted() : $builder;
        $builder = $status == strtolower(STATUS_ACTIVE) ? $builder->where('status', STATUS_ACTIVE) : $builder;
        $builder = $status == strtolower(STATUS_PENDING) ? $builder->where('status', STATUS_PENDING) : $builder;
        $builder = $status == strtolower(STATUS_PASSIVE) ? $builder->where('status', STATUS_PASSIVE) : $builder;

        $builder = !is_null($group) ? $builder->where('group_id', $group) : $builder;

        if(!is_null($search)){
            $builder = $builder->groupStart();
            $builder = $builder->like('first_name', $search);
            $builder = $builder->orLike('sur_name', $search);
            $builder = $builder->orLike('email', $search);
            $builder = $builder->groupEnd();
        }

        if (!is_null($dateFilter)){
            $builder = $builder->where('created_at >', $dateFilter[0]);
            $builder = $builder->where('created_at <', $dateFilter[1]);
        }

        $builder = $builder->orderBy('created_at', 'DESC');

        return [
            'users' => $builder->paginate($perPage),
            'pager' => $builder->pager
        ];
    }
}