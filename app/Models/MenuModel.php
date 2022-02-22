<?php


namespace App\Models;

use App\Entities\MenuEntity;
use \CodeIgniter\Model;

class MenuModel extends Model
{

    protected $table = 'menus';
    protected $primaryKey = 'id';

    protected $returnType = MenuEntity::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'skey',
        'svalue',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'skey' => 'required|is_unique[menus.skey,id,{id}]',
    ];

    public function getMenu($params)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        return $builder->first();
    }

    public function getMenuByKey($key, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('skey', $key);
        if (!is_null($status))
            $builder = $builder->where('status', $status);
        return $builder->first();
    }

    public function getMenuById($id, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('id', $id);
        if (!is_null($status))
            $builder = $builder->where('status', $status);
        return $builder->first();
    }
}