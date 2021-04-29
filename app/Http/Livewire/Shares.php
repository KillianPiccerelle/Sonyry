<?php

namespace App\Http\Livewire;

use App\Group;
use App\HttpRequest;
use App\Page;
use App\ShareDirectory;
use App\ShareGroup;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Shares extends Component
{

    use AuthorizesRequests;

    protected $listeners = ['refreshParent'=>'$refresh'];

    //Actual directory content
    public $content;

    //Group object
    public $groupId;

    //Actual directory id
    public $idDirectory;

    //Actual directory
    public $current;

    //Name of a directory, to create directory
    public $directoryName = "";

    //Collection of directory object
    public $links;

    public $pages;

    public $pagesShared = [];


    //-------------------------------------------------------------------------------------------------------------
    //Get method

    /**
     * Get the all shares and directories of the current directory
     */
    private function getContent(){
        $this->content = [];

        $http = HttpRequest::makeRequest('/shares/'. $this->groupId);

        if ($http->object()->directories != null){
            $directories = $http->object()->directories;
        }
        else{
            $directories = [];
        }

        if ($http->object()->shares != null){
            $shares = $http->object()->shares;
        }
        else{
            $shares = [];
        }

        if (count($directories) > 0){
            foreach ($directories as $directory) {
                if ($directory->shareDirectory_id == $this->idDirectory){
                    $directory->type = 'directory';
                    $this->content []= $directory;
                }
            }
        }

        if (count($shares) > 0){
            foreach ($shares as $share){
                if ($share->shareDirectory_id == $this->idDirectory){
                    $share->type = 'page';
                    $this->content []= $share;
                }
            }
        }

    }

    /**
     * Get the previous directory of the current directory to make links
     */
    private function getLinks(){

        if ($this->idDirectory == 0){
            $this->links = [];
        }
        else{
            $this->links = HttpRequest::makeRequest('/shares/links/'.$this->current['id'])->object();
        }
    }

    /**
     * Get the object of current directory
     */
    public function getCurrentDirectory(){

        $test = HttpRequest::makeRequest('/shares/directory/' . $this->idDirectory)->json();
        if ($test != null){
            $this->current = $test;
        }
        else{
            $this->current = 0;
            $this->idDirectory = 0;
        }
    }

    private function checkPages(){
        $http = HttpRequest::makeRequest('/shares/pages/'. $this->groupId);

        if($http->object() !== null){
            $this->pages = $http->object();
        }
        else{
            $this->pages = [];
        }
    }


    //-------------------------------------------------------------------------------------------------------------
    //Actions

    public function switchDirectory($id){
        $this->idDirectory = $id;
    }


    public function store(){

        if ($this->directoryName != ""){

            $params = [
                'name' => $this->directoryName,
                'group_id' => $this->groupId,
                'directory_id' => $this->idDirectory,
            ];

            HttpRequest::makeRequest('/shares' , 'post' , $params);

        }
        $this->directoryName = "";

    }

    public function deleteDirectory($id){

        $http = HttpRequest::makeRequest('/shares/'. $id . '/directory/' . $this->groupId , 'delete');

        dd($http);

        session()->flash('livewire', 'Dossier supprimé !');

    }

    public function sharePages(){
        if (count($this->pagesShared)>0){

            $params = [
                'shares' => $this->pagesShared,
                'group_id' => $this->groupId,
                'directory_id' => $this->idDirectory
            ];

            HttpRequest::makeRequest('/shares/pages' , 'post' , $params);
        }
        $this->pagesShared = [];
    }

    public function resetShares(){
        $this->pagesShared = [];
    }

    public function deleteShare($id){
        HttpRequest::makeRequest('/shares/'. $id , 'delete');
    }

    //-------------------------------------------------------------------------------------------------------------
    //Livewire method

    public function mount($id)
    {
        $this->groupId = $id;
        $this->idDirectory = 0;
    }


    public function render(){
        $this->getCurrentDirectory();
        $this->getContent();
        $this->getLinks();
        $this->checkPages();
        return view('livewire.shares');
    }

}
