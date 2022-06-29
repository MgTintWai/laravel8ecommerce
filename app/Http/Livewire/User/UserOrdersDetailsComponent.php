<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserOrdersDetailsComponent extends Component
{
    public $order_id;

    public function mount($order_id){
        $this->$order_id = $order_id;
    }
    public function cancelOrder(){
        $order = Order::find($this->order_id);
        $order->status = "canceled";
        $order->canceled_date = DB::raw('CURRENT_DATE');
        $order->save();
        session()->flash('order_message','Ordered has been canceled successfully!');
    }
    public function render()
    {
        $orders = Order::where('user_id',Auth::user()->id)->where('id',$this->order_id)->first();
        return view('livewire.user.user-orders-details-component',['orders'=>$orders])->layout('layouts.base');
    }
}
