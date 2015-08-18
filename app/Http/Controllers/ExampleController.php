<?php namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Redirect, Input, Auth;

class ExampleController extends BaseController {

    public function getContact()
    {
        $contacts = Contact::orderBy('updated_at','desc')->get();
        $this->assign('contacts',$contacts);
        return $this->display('admin.example.contact');
    }

}