<?php


namespace App\Models;

use App\Entities\ThemeEntity;
use CodeIgniter\Model;

class ThemeModel extends Model
{
    protected $table = 'themes';
    protected $primaryKey = 'id';
    protected $returnType = ThemeEntity::class;

    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'folder',
        'name',
        'author',
        'web',
        'email',
        'status',
        'settings'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'folder'    => 'required|string|is_unique[themes.folder,id,{id}]',
        'name'      => 'required|string',
        'author'    => 'permit_empty|string',
        'web'       => 'permit_empty|valid_url',
        'email'     => 'permit_empty|valid_email',
        'status'    => 'required',
        'settings'  => 'permit_empty'
    ];

    public function getTheme($params, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where($params);
        $builder = $withDeleted ? $builder->withDeleted() : $builder;
        return $builder->first();
    }

    public function getThemeById($theme_id, $status = STATUS_ACTIVE, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('id', $theme_id);
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;

        return $builder->first();
    }

    public function getThemeByFolder($theme_folder, $status = STATUS_ACTIVE, $withDeleted = false)
    {
        $builder = $this->setTable($this->table);
        $builder = $builder->select('*');
        $builder = $builder->where('folder', $theme_folder);
        $builder = $status ? $builder->where('status', $status) : $builder;
        $builder = $withDeleted ? $builder->withDeleted() : $builder;

        return $builder->first();
    }

}