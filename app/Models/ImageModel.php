<?php


namespace App\Models;

use App\Entities\ImageEntity;
use \CodeIgniter\Model;

class ImageModel extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';

    protected $returnType = ImageEntity::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'group',
        'group_name',
        'name',
        'url',
        'slug',
        'type',
        'size',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'group' => 'required',
        'group_name' => 'required',
        'name' => 'required',
        'url'  => 'required',
        'slug' => 'required',
        'type' => 'required',
        'size' => 'required',
    ];


    public function getImageGroupByDistinct(): array
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select(['group', 'group_name']);
        $builder = $builder->distinct();
        return $builder->findAll();
    }

    public function getImage($params)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        return $builder->first();
    }

    public function getImages($params = null): array
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        if(!is_null($params)){
            $builder = $builder->where($params);
        }
        return $builder->findAll();
    }

    public function getImageById($image_id)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('id', $image_id);

        return $builder->first();
    }


    public function getListing(
        ?string $search = null,
        ?array $dateFilter = null,
        ?string $group = null,
        ?int $perPage = 20)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        if(!is_null($search)){
            $builder = $builder->like('name', $search);
        }

        if(!is_null($group)){
            $builder = $builder->where('group', $group);
        }

        if (!is_null($dateFilter)){
            $builder = $builder->where('created_at >', $dateFilter[0]);
            $builder = $builder->where('created_at <', $dateFilter[1]);
        }

        $builder = $builder->orderBy('created_at', 'DESC');

        return [
            'images' => $builder->paginate($perPage),
            'pager' => $builder->pager
        ];
    }

}