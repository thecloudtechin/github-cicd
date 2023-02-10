<?php
namespace App;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyEmail extends Mailable {

    use Queueable,
        SerializesModels;
        
   protected $logo = "";
        protected $order_no =" ";
        protected $payment_type =" ";
        protected $hotel_add =" ";
        protected $hotel_name =" ";
        protected $user_add =" ";
        protected $user_name =" ";
        protected $user_email =" ";
        protected $sub_total =" ";
        protected $items = [];
        protected $delivery_charge =" ";
        protected $discount =" ";
        protected $user_mob =" ";
        protected $delivery_type =" ";
        protected $extra = [];
        
        
        
        public function __construct($order_no,$payment_type,$delivery_type,$hotel_add,$user_add,$sub_total,
        $items,$hotel_name,$delivery_charge,$discount,$user_email,$user_name,$user_mob,$logo,$extra)
        {
            $this->order_no =  $order_no;
            $this->payment_type =  $payment_type;
            $this->delivery_type = $delivery_type;
            $this->hotel_add =  $hotel_add;
            $this->user_add =  $user_add;
            $this->sub_total =  $sub_total;
            $this->items = $items;
            $this->hotel_name = $hotel_name;
            $this->delivery_charge = $delivery_charge;
            $this->discount = $discount;
            $this->user_mob = $user_mob;
            $this->user_name = $user_name;
            $this->user_email = $user_email;
            $this->logo = $logo;
             $this->extra = $extra;
        }


    //build the message.
    public function build() {

        // $length = count($this->items);
        // for ($i = 0; $i < $length; $i++) {
        //   print_r($this->items[$i]) ;
        // }

        return $this->view('my-email', ['order_no' => $this->order_no,'sub_total' => $this->sub_total
        ,'hotel_add' => $this->hotel_add,'hotel_name' => $this->hotel_name,'payment_type' => $this->payment_type,'delivery_type'=>$this->delivery_type,'user_add' => $this->user_add,
        'delivery_charges' => $this->delivery_charge,'discount' => $this->discount,'user_name' => $this->user_name,'user_email' => $this->user_email
        ,'user_mob' => $this->user_mob,'items' => $this->items,'logo'=> $this->logo,'extra'=> $this->extra]);
    }




}
