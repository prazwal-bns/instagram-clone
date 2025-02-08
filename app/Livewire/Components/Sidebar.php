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

    public function updatedQuery($query){
        if($query=''){
            return $this->results = null;
        }
        $this->results = User::where('username','like','%'.$query.'%')
            ->orWhere('name','like','%'.$query.'%')
            ->get();
    }
}
