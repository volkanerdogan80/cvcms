<?php


namespace App\Models;

use CodeIgniter\Model;

class NewsletterModel extends Model
{
    protected $table      = 'newsletters';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name',
        'email',
        'token',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = false;

    protected $validationRules = [
        'name' => 'permit_empty|string',
        'email' => 'required|valid_email|is_unique[newsletters.email]',
        'token' => 'required|alpha',
    ];
}