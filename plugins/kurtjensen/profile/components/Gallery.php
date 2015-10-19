<?php namespace KurtJensen\Profile\Components;

use Request;
use Redirect;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\User\Models\User as user;
use ShahiemSeymor\Roles\Models\UserGroup;
use System\Models\File as Avatar;


use KurtJensen\Profile\Models\Settings;

class Gallery extends ComponentBase
{
    public $people = [];
    public $avatars = [];
    public $userGroups = [];
    public $sort = '';
    
    public $perPage = 12;
    public $currentPage = 1;
    public $lastPage = 1;
    public $paginationUrl = '';
    public $firstItem = 0;
    public $lastItem = 0;
    public $total = 0;
        
    


    public function componentDetails()
    {
        return [
            'name'        => 'Gallery Component',
            'description' => 'Show a picture gallery of registered user avatars.'
        ];
    }

    public function defineProperties()
    {
        return [
            'PicsPerPage' => [
                'title'             => 'Pictures Per Page',
                'description'       => 'The number of pictures shown before pagination.',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Must be an integer',
                'default'           => '20',
            ],
            ];
    }

    public function init()
    {
        $this->getPrimaryUsergroups();
    }

    public function onRun()
    {
        $this->addCss('assets/css/gallery.css');
        
        $this->page['sort'] = $this->sort = input('sort');        
        $this->loadUserInfo();
        $this->page['people'] = $this->people;  
    }
    
    public function loadUserInfo()
    {
        $peopleWithAvatars = [];
                
         $avatars = Avatar::where( 'attachment_type','RainLab\User\Models\User')->
                           where( 'field', 'avatar')->get();
                           
        foreach($avatars as $avatr )
        {
            $this->avatars[ $avatr->attachment_id ] = [
                    't600' => $avatr->getThumb(600,600),
                    't200' => $avatr->getThumb(200,200),
                    'filename' => $avatr->filename     ,
                    ];
            $peopleWithAvatars[] = $avatr->attachment_id;
        }
        // Set Pagination parameters
        $this->perPage = $this->property('PicsPerPage',12);
        $this->currentPage = input('page',1);   
        
        $sort3 = null;
        /*
         * Sorting
         */
        switch ($this->sort)
        {
            case 'last': 
                $sort1 = 'surname';
                $sort2 = 'name';
            break;
            case 'given': 
                $sort1 = 'name';
                $sort2 = 'surname';
            break;
            default :
                $sort1 = 'primary_usergroup';
                $sort2 = 'surname';
                $sort3 = 'name';
        }

        $people = user::wherein('id',$peopleWithAvatars)->
                            orderBy($sort1)->
                            orderBy($sort2);
                            
        if ($sort3) $people->orderBy($sort3);
        
        $this->people = $people->paginate($this->perPage, $this->currentPage);
        
        /*
         * Pagination
         */
        if ($this->people) {
            $queryArr = [];
            $queryArr['sort'] = $this->sort;
            $queryArr['page'] = '';
            $paginationUrl = Request::url() . '?' . http_build_query($queryArr);

            if ($this->currentPage > ($this->lastPage = $this->people->lastPage()) && $this->currentPage > 1)
                return Redirect::to($paginationUrl . $this->lastPage);


            $this->firstItem = $this->people->firstItem();
            $this->lastItem = $this->people->lastItem();
            $this->total = $this->people->total();

            $this->paginationUrl = $paginationUrl;
        }
        
        return $this->people;  
    }
    

    public function getPrimaryUsergroups()
    {
        $this->userGroups = UserGroup::lists('name','id');
            
        $this->page['userGroups'] = $this->userGroups;
    }
}
