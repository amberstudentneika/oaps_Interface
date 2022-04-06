<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ParentDashboard extends Component
{
    public $viewMode = false;

    public function switchBack(){
        $this->viewMode = false;
    }

    public function viewEV($id){
    $this->viewMode = true;
    $curl = 'http://192.168.0.12:8081/api/view/EV/'.$id;
        $ch=curl_init();

        curl_setopt($ch,CURLOPT_URL,$curl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        // dd($results);
        $this->EV = json_decode($results,true);
        $this->EV = $this->EV['evpd'];
        // dd($this->EV);
    }
    public function render()
    {
        $id=Session()->get('pID');
        $curl = 'http://192.168.0.12:8081/api/find/all/'.$id;
        $ch=curl_init();

        curl_setopt($ch,CURLOPT_URL,$curl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $students = json_decode($results,true);
        return view('livewire.parent-dashboard',compact('students'));
    }
}
