<?php

trait Commentable {
    
    public function getComments() {
        return $this->commentaires
                    ->where('status','=',true)
                    ->get();
    }


    public function addComment($data) {
        
    }

}