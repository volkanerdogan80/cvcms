<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

    public $register = [
        'first_name' => [
            'rules' => 'required|string|min_length[3]',
            'errors' => [
                'required' => 'Validation.text.first_name_required',
                'string' => 'Validation.text.first_name_string',
                'min_length' => 'Validation.text.first_name_min_length',
            ]
        ],
        'sur_name' => [
            'rules' => 'required|string|min_length[3]',
            'errors' => [
                'required' => 'Validation.text.sur_name_required',
                'string' => 'Validation.text.sur_name_string',
                'min_length' => 'Validation.text.sur_name_min_length',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Validation.text.email_required',
                'valid_email' => 'Validation.text.email_valid_email',
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Validation.text.password_required',
                'min_length' => 'Validation.text.password_min_length',
            ]
        ],
        'password2' => [
            'rules' => 'required|min_length[3]|matches[password]',
            'errors' => [
                'required' => 'Validation.text.password2_required',
                'min_length' => 'Validation.text.password2_min_length',
                'matches' => 'Validation.text.password2_matches',
            ]
        ]
    ];

    public $forgot = [
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Validation.text.email_required',
                'valid_email' => 'Validation.text.email_valid_email',
            ]
        ]
    ];

    public $resetPassword = [
        'password' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Validation.text.password_required',
                'min_length' => 'Validation.text.password_min_length',
            ]
        ],
        'password2' => [
            'rules' => 'required|min_length[3]|matches[password]',
            'errors' => [
                'required' => 'Validation.text.password2_required',
                'min_length' => 'Validation.text.password2_min_length',
                'matches' => 'Validation.text.password2_matches',
            ]
        ]
    ];

    public $login = [
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Validation.text.email_required',
                'valid_email' => 'Validation.text.email_valid_email',
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'Validation.text.password_required',
                'min_length' => 'Validation.text.password_min_length',
            ]
        ]
    ];

    public $groups = [
        'title' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Validation.text.group_name_required',
            ]
        ]
    ];

    public $imageUpload = [
        'file' => [
            'rules' => 'uploaded[file]|mime_in[file,image/png,image/jpg,image/jpeg]|max_size[file,10240]',
            'errors' => [
                'uploaded' => 'Validation.text.image_upload_input_name',
                'mime_in'  => 'Validation.text.image_upload_mime_in',
                'max_size' => 'Validation.text.image_upload_max_size'
            ]
        ]
    ];

}
