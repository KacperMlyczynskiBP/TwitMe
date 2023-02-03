<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Discount extends Component
{
    public $dishId;

    public function mount($dishId){
       $this->dishId=$dishId;
    }

    public function discount($dishId){
        echo '<div>' . '<input type="text" name="text">' . '</div>';
    }


    public function render()
    {
        return view('livewire.discount');
    }
}
