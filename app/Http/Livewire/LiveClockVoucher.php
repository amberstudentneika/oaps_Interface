<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveClockVoucher extends Component
{
    public $searchMode=false,$viewResult,$vnID,$vn,$voucherNumber;
    public $status,$ru;
    
    protected $rules=[
        'voucherNumber' => 'required',
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function show(){
        $this->searchMode=false;  
        $this->viewResult=false;  
    }
    public function clear(){
        $this->voucherNumber = '';
    }

    public function onSubmit(){
        $this->validate();

        $url = 'http://192.168.0.12:8081/api/search/voucher/number/'.$this->voucherNumber;

        $CH = curl_init();

        curl_setopt($CH,CURLOPT_URL,$url);
        curl_setopt($CH,CURLOPT_RETURNTRANSFER,true);

        $data = curl_exec($CH);
        $data = json_decode($data,true);
        $record=$data['message']['0'];
        if($data['status']!='404'){
            $this->vnID=$record['id'];
            $this->ru = $record['RemainingUsage'];
            $this->vn = $record['e_voucher_payment_details']['voucherNumber'];
            $this->status = $record['status'];
            if($record['status']!='Active'){
                $this->voucherNumber='';
                session()->flash('error','E-Voucher Expired');
            }
            $this->searchMode = true;
        $this->viewResult = true;
        }else{
                session()->flash('message','Not Found! Please try again.');
        }
    }

    public function onClock(){
        $csID = session()->get('cID');
        $url = 'http://192.168.0.12:8081/api/clock/'.$csID.'/'.$this->vnID;
        
        $ch =curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $this->voucherNumber='';
        $this->searchMode = false;
        $this->viewResult = false;
        session()->flash('success','Usage Clocked!');
        
    }

    public function render()
    {

        return view('livewire.live-clock-voucher');
    }
}
