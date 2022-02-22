<?php


namespace App\Models;

use App\Entities\SettingEntity;
use \CodeIgniter\Model;

class SettingModel extends Model
{

    protected $table = 'settings';
    protected $primaryKey = 'id';

    protected $returnType = SettingEntity::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'skey',
        'svalue',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'skey'   => 'required',
        'svalue' => 'required',
    ];

    public function getSetting($params)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        return $builder->first();
    }

    public function getSettingByKey($key)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('skey', $key);
        return $builder->first();
    }
}