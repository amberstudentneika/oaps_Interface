<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveChangePassword extends Component
{
    public $passwordChange = false;
    public $password, $passwordConfirm;

    public function changePassword(){
        $passLen=strlen($this->password);
        if($this->password!=$this->passwordConfirm){
            session()->flash('pNoMatch','Password match.');
        }if($passLen < 8){
            session()->flash('pNoLen','Password cannot be less than 8 characters.');
        }else{

            $id = session()->get('cID');

            $ch = curl_init();
            
            $url = 'http://192.168.0.12:8081/api/change/password/'.$id;

            $data=array(
                'newPassword'=>$this->password,
            );
            http_build_query($data);
            
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    
            $results = curl_exec($ch);

            Session()->put('staffPStatus','active');
            
            return redirect()->route('staffChangePassword');
            $this->passwordChange=false;
        }
        
    }
    public function render()
    {
        return view('livewire.live-change-password');
    }
}
