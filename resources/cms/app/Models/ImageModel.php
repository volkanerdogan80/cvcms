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
        'name' => 'required',
        'url' => 'required',
        'slug' => 'required',
        'type' => 'required',
        'size' => 'required',
    ];

    protected $validationMessages = [
        'name' => ['required' => 'Validation.text.image_name_required'],
        'slug' => ['required' => 'Validation.text.image_slug_required'],
        'url' => ['required' => 'Validation.text.image_URL_required'],
        'type' => ['required' => 'Validation.text.image_type_required'],
        'size' => ['required' => 'Validation.text.image_size_required'],
    ];

    public function getListing(
        ?string $search = null,
        ?array $dateFilter = null,
        ?int $perPage = 20)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');

        if(!is_null($search)){
            $builder = $builder->like('name', $search);
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