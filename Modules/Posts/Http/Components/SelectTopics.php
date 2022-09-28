<?php
namespace Modules\Posts\Http\Components;

class SelectTopics{
    private $data;
    private $htmlSelect = '';
    public function __construct($data)
    {
        $this->data=$data;
    }
    public function topicsSelect(){
        foreach ($this->data as $value){
            $this->htmlSelect .= "<option value='" .$value['id'] ."'>". $value['name'] ."</option>";
        }
        return $this->htmlSelect;
    }
    public function topicsSelectUpdate($selectId){        
        foreach ($this->data as $value){
            if($selectId==$value->id){              
                $this->htmlSelect .= "<option selected value='" .$value['id'] ."'>". $value['name'] ."</option>";
            }else{
                $this->htmlSelect .= "<option value='" .$value['id'] ."'>". $value['name'] ."</option>";
            }
        }
        return $this->htmlSelect;
    }
}