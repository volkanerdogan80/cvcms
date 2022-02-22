<?php


namespace App\Models;

use App\Entities\LanguageEntity;
use \CodeIgniter\Model;

class LanguageModel extends Model
{
    protected $table = 'languages';
    protected $primaryKey = 'id';

    protected $returnType = LanguageEntity::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'code',
        'flag',
        'title',
        'status',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'code'  => 'required|min_length[2]|is_unique[languages.code]',
        'flag'  => 'required|min_length[2]',
        'title' => 'required'
    ];

    public function getLanguage($params)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        return $builder->first();
    }

    public function getLanguageById($lang_id, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('id', $lang_id);
        if (!is_null($status))
            $builder = $builder->where('status', $status);

        return $builder->first();
    }

    public function getLanguageByCode($lang_code, $status = null)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('code', $lang_code);
        if (!is_null($status))
            $builder = $builder->where('status', $status);

        return $builder->first();
    }

    public function getLanguagesByStatus($status, $per_page = null)
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

    public function getListing(
        ?string $status = null,
        ?string $search = null,
        ?array $dateFilter = null,
        ?int $perPage = 20)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        $builder = $status == 'deleted' ? $builder->onlyDeleted() : $builder;
        $builder = $status == strtolower(STATUS_ACTIVE) ? $builder->where('status', STATUS_ACTIVE) : $builder;
        $builder = $status == strtolower(STATUS_PASSIVE) ? $builder->where('status', STATUS_PASSIVE) : $builder;

        if(!is_null($search)){
            $builder = $builder->like('title', $search);
        }

        if (!is_null($dateFilter)){
            $builder = $builder->where('created_at >', $dateFilter[0]);
            $builder = $builder->where('created_at <', $dateFilter[1]);
        }

        $builder = $builder->orderBy('created_at', 'DESC');

        return [
            'languages' => $builder->paginate($perPage),
            'pager' => $builder->pager
        ];
    }

}