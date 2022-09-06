<?php

class LoginResource
{

public function toArray($data){
    return ([
        'id'=>$data['id'],
        'first_name'=>$data['firstname'],
        'last_name'=>$data['lastname'],
        'email'=>$data['email'],
    ]);
}

}