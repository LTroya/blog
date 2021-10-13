<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "Bootstrap";

    public function updatingSearch(){
        $this->resetPage();
    }

    /* variable para el buscador */
    public $search;

    public function render()
    {

        $users = User::where('name', 'LIKE', '%' . $this->search . '%')
        ->orWhere('email', 'LIKE', '%' . $this->search . '%')
        ->paginate(5);
        return view('livewire.admin.users-index', compact('users'));
    }
}
