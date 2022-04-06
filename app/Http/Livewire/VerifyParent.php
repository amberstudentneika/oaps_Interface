<?php

namespace App\Http\Livewire;

use Livewire\Component;

class VerifyParent extends Component
{

    public function approve($id){
        $uID=session()->get('uID');
        $curl = 'http://192.168.0.12:8081/api/verify/parent/'.$id.'/'.$uID;
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$curl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $results = curl_exec($ch);
    }
    public function deny($id){
        $uID=session()->get('uID');
        $curl = 'http://192.168.0.12:8081/api/verify/parent/deny/'.$id.'/'.$uID;
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$curl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $results = curl_exec($ch);
    }
    
    public function render()
    {
        $curl = 'http://192.168.0.12:8081/api/relationships';
        $ch=curl_init();

        curl_setopt($ch,CURLOPT_URL,$curl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $parents = json_decode($results,true);
        $parents = $parents['relationships'];

        return view('livewire.verify-parent',compact('parents'));
    }
}
