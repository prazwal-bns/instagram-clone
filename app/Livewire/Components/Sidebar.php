<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public $shrink=false;
    public $drawer=false;

    public $results;
    public $query;

    public function render()
    {
        return view('livewire.components.sidebar');
    }

    public function updatedQuery($query)
    {
        $query = trim($query);

        if ($query === '') {
            $this->results = null;
            return;
        }

        $this->results = User::where(function($q) use ($query) {
                $q->where('username', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%');
            })
            ->where(function($q) use ($query) {
                if (strlen($query) > 2) {
                    $q->whereRaw('LENGTH(username) > 2')
                    ->orWhereRaw('LENGTH(name) > 2');
                }
            })
            ->get();
    }
}
