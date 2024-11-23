<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RoleMenu extends Component
{
    public $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function render()
    {
        return view('components.role-menu');
    }
}
