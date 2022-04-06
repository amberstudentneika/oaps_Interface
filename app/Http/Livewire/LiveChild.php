<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
class LiveChild extends Component
{
    use WithFileUploads;
    public $childIDN, $stdID, $viewResult;
    public $fname, $lname, $relation, $gender, $class, $studentIDN, $birthCert,$formCondition;
    public $searchMode=false;
    protected $rules=[
        'childIDN' => 'required',
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
public function show(){
    $this->searchMode=false;  
    $this->viewResult=false;  
}
    public function onSubmit(){
        $this->validate();
        $url = 'http://192.168.0.12:8081/api/search/child';
        $ch=curl_init();
        $data=array(
            'childIDN'=>$this->childIDN,
        );
        http_build_query($data);
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        // dd($results);
        curl_close($ch);
        
        if($results['status']=='200'){
            $pID = Session()->get('pID');
            $childID = $results['message'][0]['id'];
            $purl = 'http://192.168.0.12:8081/api/relationship/'.$pID.'/'.$childID;

            $pCH = curl_init();

            curl_setopt($pCH,CURLOPT_URL,$purl);
            curl_setopt($pCH,CURLOPT_RETURNTRANSFER,true);

            $data = curl_exec($pCH);
            $this->formCondition = $data;;
            $results=array_slice($results,1);
            // dd($results);
            $this->fname=$results['message'][0]['firstname'];
            $this->stdID=$results['message'][0]['id'];
            $this->studentIDN=$results['message'][0]['identificationNumber'];
            $this->lname=$results['message'][0]['lastname'];
            $this->gender=$results['message'][0]['gender'];
            $this->class=$results['message'][0]['class'];
            $this->grade=$results['message'][0]['grade'];
            $this->childIDN = '';
            $this->viewResult=true;
            $this->searchMode=true;
            }elseif($results['status']=='404'){
                session()->flash('message','Identification number entered cannot be found.');
            }
    }

    public function addChild(){

        if($this->relation=="" || $this->birthCert==''){
            session()->flash('error','Please fill fields marked with astericks');
        }else{
        $birthCert=$this->fname." ".$this->lname." ".$this->birthCert->getClientOriginalName();
        $this->birthCert->storePubliclyAs('storage',$birthCert,'parentUploads');
       
        $parentID=session()->get('pID');
        $data=array(
            'childID'=>$this->stdID,
            'parentID'=>$parentID,
            'relation'=>$this->relation,
            'childBirthCert'=>$birthCert,
        );
     
        // dd($data);
        $ch=curl_init();
        $url = 'http://192.168.0.12:8081/api/create/child';
        
        http_build_query($data);
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $this->show();
        }
    }

    public function render()
    {
        return view('livewire.live-child');
    }
}
