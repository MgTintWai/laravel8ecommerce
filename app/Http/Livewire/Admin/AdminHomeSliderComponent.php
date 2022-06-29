<?php

namespace App\Http\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithPagination;
class AdminHomeSliderComponent extends Component
{
    use WithPagination;

    public function deleteSlider($id){
        $product = HomeSlider::find($id);
        $product->delete();
        session()->flash('message','Product has been deleted successfully!');
    }
    public function render()
    {
        $sliders = HomeSlider::paginate(5);
        return view('livewire.admin.admin-home-slider-component',['sliders'=>$sliders])->layout('layouts.base');
    }
}
