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
        'group_id' => 'required|numeric',
        'first_name' => 'required|string|min_length[3]',
        'sur_name' => 'required|string|min_length[3]',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'required',
        'verify_key' => 'required|alpha',
        'verify_code' => 'numeric|min_length[6]',
        'status' => 'required'
    ];

    protected $validationMessages = [
        'group_id' => [
            'required' =>  'Validation.text.group_id_required',
            'numeric' => 'Validation.text.group_id_numeric',
        ],
        'first_name'    => [
            'required'  => 'Validation.text.first_name_required',
            'string'    => 'Validation.text.first_name_string',
            'min_length'    =>  'Validation.text.first_name_min_length',
        ],
        'sur_name'      => [
            'required'  =>  'Validation.text.sur_name_required',
            'string'    =>  'Validation.text.sur_name_string',
            'min_length'    =>  'Validation.text.sur_name_min_length',
        ],
        'email' => [
            'required' => 'Validation.text.email_required',
            'valid_email'   =>  'Validation.text.email_valid_email',
            'is_unique' =>  'Validation.text.email_valid_is_unique',
        ],
        'password'  =>  [
            'required'  =>  'Validation.text.password_required',
        ],
        'verify_key' =>  [
            'required'  =>  'Validation.text.verify_key_required',
            'alpha' =>  'Validation.text.verify_key_alpha',
        ],
        'verify_code' => [
            'numeric'   =>  'Validation.text.verify_code_numeric',
            'min_length'    =>  'Validation.text.verify_code_min_length',
        ],
        'status'    =>  [
            'required'  =>  'Validation.text.status_required',
        ]
    ];

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