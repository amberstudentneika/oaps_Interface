<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Hash;
class LiveRegister extends Component
{
    use WithFileUploads;
    public $status=false;
    public $firstname, $lastname, $gender, $address,$identificationCard;
    public $email,$trn,$password,$password_confirmation,$approvedBy;

    protected $rules = [
        'firstname'=>'required | min:2',
        'lastname'=>'required | min:2',
        'gender'=>'required',
        'address'=>'required',
        'email'=>'required',
        'trn'=>'required',
        'identificationCard'=>'required',
        'password'=>' min:8 | required',
        'password_confirmation'=>'same:password'
    ];

    public function updated($propertyName){
        return $this->validateOnly($propertyName);
    }

    
    public function onSubmit(){
        $data=$this->validate();
        $this->status=false;

        $ch=curl_init();
        $url = 'http://192.168.0.12:8081/api/add/parent';
        
        $identificationCard=$this->firstname." ".$this->lastname." ".$this->identificationCard->getClientOriginalName();
        $trn=$this->firstname." ".$this->lastname." ".$this->trn->getClientOriginalName();
        $this->identificationCard->storePubliclyAs('storage',$identificationCard,'parentUploads');
        $this->trn->storePubliclyAs('storage',$trn,'parentUploads');
        $data=array(
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
            'gender'=>$this->gender,
            'address'=>$this->address,
            'trn'=>$trn,
            'identificationCard'=>$identificationCard,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
        );
        http_build_query($data);
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $result = $results['status'];
        if($result=="201"){
            $this->status=true;
            return redirect()->route('login');
        }
        curl_close($ch);
    }
    public function render()
    {
        return view('livewire.live-register');
    }
}
