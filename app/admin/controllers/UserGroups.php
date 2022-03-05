<?php

namespace Admin\Controllers;

use Admin\Facades\AdminMenu;
use Admin\Models\UserGroup;

class UserGroups extends \Admin\Classes\AdminController
{
    public $implement = [
        \Admin\Actions\ListController::class,
        \Admin\Actions\FormController::class,
    ];

    public $listConfig = [
        'list' => [
            'model' => \Admin\Models\UserGroup::class,
            'title' => 'lang:admin::lang.user_groups.text_title',
            'emptyMessage' => 'lang:admin::lang.user_groups.text_empty',
            'defaultSort' => ['user_group_id', 'DESC'],
            'configFile' => 'usergroup',
        ],
    ];

    public $formConfig = [
        'name' => 'lang:admin::lang.user_groups.text_form_name',
        'model' => \Admin\Models\UserGroup::class,
        'request' => \Admin\Requests\UserGroup::class,
        'create' => [
            'title' => 'lang:admin::lang.form.create_title',
            'redirect' => 'user_groups/edit/{user_group_id}',
            'redirectClose' => 'user_groups',
            'redirectNew' => 'user_groups/create',
        ],
        'edit' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'user_groups/edit/{user_group_id}',
            'redirectClose' => 'user_groups',
            'redirectNew' => 'user_groups/create',
        ],
        'preview' => [
            'title' => 'lang:admin::lang.form.preview_title',
            'redirect' => 'user_groups',
        ],
        'delete' => [
            'redirect' => 'user_groups',
        ],
        'configFile' => 'usergroup',
    ];

    protected $requiredPermissions = 'Admin.StaffGroups';

    public function __construct()
    {
        parent::__construct();

        AdminMenu::setContext('users', 'system');
    }

    public function formAfterSave()
    {
        UserGroup::syncAutoAssignStatus();
    }
}
