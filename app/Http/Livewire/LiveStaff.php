<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Hash;

class LiveStaff extends Component
{
    public $viewMode=false, $addMode=true;
    public $fname, $lname, $gender, $email, $status, $password, $Sid;
    public $hiddenDetail=false,$dropdownFilter,$canteenCount;

    public function clearField(){
        $this->fname = '';
        $this->lname = '';
        $this->gender = '';
    }
    protected $rules=[
        'fname'=> 'required', 
        'lname'=> 'required', 
        'gender'=> 'required',
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    
    public function addStaff(){ 
        $this->viewMode=true;
        $this->addMode=true;
    }
    public function staffEmailGenerator(){ 
        $this->validate();
        $num=rand(1,200);
        $ext="@oapscanteen.edu";
        $staffEG=$this->fname.$this->lname.$num.$ext;
        $staffPG=$this->fname.$this->lname.$num;
        $staffPG=Hash::make($staffPG);
        
        $url = 'http://192.168.0.12:8081/api/staff/create';
        $ch=curl_init();
        
        $data=array(
        'firstname'=> $this->fname, 
        'lastname'=> $this->lname, 
        'gender'=> $this->gender,
        'email'=> $staffEG,
        'password'=> $staffPG,
        // 'status'=> "active"
        );
        // dd($data);
        http_build_query($data);
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        // dd($results);
        $this->clearField();
        $this->show();
    }

    public function show(){
        $this->viewMode=false;
        $this->addMode=false;
    }
    function showEdit($id){
        $this->addMode=false;
        $this->viewMode=true;
        $this->editMode = true;

        $url = 'http://192.168.0.12:8081/api/staff/edit/'.$id;
        $ch=curl_init();

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $result = curl_exec($ch);
        $result=json_decode($result,true);
        // dd($result);
        $this->Sid=$result['cs']['id'];
        $this->fname=$result['cs']['firstname'];
        $this->lname=$result['cs']['lastname'];
        $this->gender=$result['cs']['gender'];
        $this->status=$result['cs']['status'];
    }

    public function editStaff(){
        // dd($this->Sid);
        $this->validate();
        $url = 'http://192.168.0.12:8081/api/staff/update/'.$this->Sid;
        $ch=curl_init();

        $data=array(
        'firstname'=> $this->fname, 
        'lastname'=> $this->lname, 
        'gender'=> $this->gender,
        'status'=> $this->status
        );
        // dd($data);
        http_build_query($data);
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        // dd($results);
        $results = json_decode($results,true);

        $this->addMode=false;
        $this->viewMode=false;
        $this->clearField();
    }
    public function render()
    {
        $url = 'http://192.168.0.12:8081/api/staff/show';
        $ch=curl_init();

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $this->canteenCount = array_slice($results,2,1);
        // dd($results);
        return view('livewire.live-staff',compact('results'));
    }
}
