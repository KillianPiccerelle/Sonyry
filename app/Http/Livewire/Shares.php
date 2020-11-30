<?php

namespace App\Http\Livewire;

use App\Group;
use App\Page;
use App\ShareDirectory;
use App\ShareGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Shares extends Component
{

    protected $listeners = ['refreshParent'=>'$refresh'];

    //Actual directory content
    public $content;

    //Group object
    public $group;

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

        $directories = ShareDirectory::where('group_id',$this->group->id)->get();
        $shares = ShareGroup::where('group_id',$this->group->id)->get();

        foreach ($directories as $directory) {
            if ($directory->shareDirectory_id == $this->idDirectory){
                $directory->type = 'directory';
                $this->content []= $directory;
            }
        }
        foreach ($shares as $share){
            if ($share->shareDirectory_id == $this->idDirectory){
                $share->type = 'page';
                $this->content []= $share;
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
            $this->links = [];
            while ($this->current->shareDirectory_id != 0){
                $this->links []= $this->current;
                $this->current = ShareDirectory::find($this->current->shareDirectory_id);
            }
            $this->links []= $this->current;
            $this->links = array_reverse($this->links);
        }
    }

    /**
     * Get the object of current directory
     */
    public function getCurrentDirectory(){

        $test = ShareDirectory::find($this->idDirectory);
        if ($test != null){
            $this->current = $test;
        }
        else{
            $this->current = 0;
            $this->idDirectory = 0;
        }
    }

    private function checkPages(){
        $this->pages = [];
        $pages = Page::where('user_id',Auth::user()->id)->get();

        foreach ($pages as $page) {
            $test = ShareGroup::where('page_id',$page->id)->where('group_id',$this->group->id)->get();
            if (count($test) > 0){
                $page->isShared = true;
            }
            else{
                $page->isShared = false;
            }

            $this->pages []= $page;
        }
    }


    //-------------------------------------------------------------------------------------------------------------
    //Actions

    public function switchDirectory($id){
        $this->idDirectory = $id;
    }


    public function store(){
        if ($this->directoryName != ""){


            $newDirectory = new ShareDirectory;
            $newDirectory->name = $this->directoryName;
            $newDirectory->group_id = $this->group->id;
            $newDirectory->shareDirectory_id = $this->idDirectory;

            $newDirectory->save();
        }
        $this->directoryName = "";

    }

    public function deleteDirectory($id){
        $oldDirectory = ShareDirectory::find($id);
        $oldDirectory->delete();

        $allDirectories = ShareDirectory::where('group_id',$this->group->id)->get();

        foreach ($allDirectories as $one){
            if ($one->shareDirectory_id != 0){
                $test = ShareDirectory::find($one->shareDirectory_id);
                if ($test == null){
                    $one->delete();
                }
            }
        }

        $allShares = ShareGroup::where('group_id',$this->group->id)->get();

        foreach ($allShares as $one) {
            if ($one->shareDirectory_id != 0) {
                $test = ShareDirectory::find($one->shareDirectory_id);
                if ($test == null) {
                    $one->delete();
                }
            }
        }

        session()->flash('livewire', 'Dossier supprimé !');

    }

    public function sharePages(){
        if (count($this->pagesShared)>0){
            foreach ($this->pagesShared as $share){
                $shareGroup = new ShareGroup();

                $shareGroup->user_id = Auth::user()->id;
                $shareGroup->page_id = $share;
                $shareGroup->group_id = $this->group->id;
                $shareGroup->shareDirectory_id = $this->idDirectory;

                $shareGroup->save();
            }

        }
        $this->pagesShared = [];
    }

    public function resetShares(){
        $this->pagesShared = [];
    }

    public function deleteShare($id){
        $shareGroup = ShareGroup::find($id);

        $shareGroup->delete();
    }

    //-------------------------------------------------------------------------------------------------------------
    //Livewire method

    public function mount($id)
    {
        $this->group = Group::find($id);
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
