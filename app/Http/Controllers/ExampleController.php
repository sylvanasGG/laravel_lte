<?php namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Redirect, Input, Auth;
use App\Cores\Core_Modret;
use Illuminate\Support\Facades\Validator;
class ExampleController extends BaseController {

    public function getContact()
    {
        $contacts = Contact::orderBy('updated_at','desc')->get();
        $this->assign('contacts',$contacts);
        return $this->display('admin.example.contact');
    }

    public function postInsertContact()
    {
        //������֤����
        $rules = array(
            'contact_time' => 'required',
            'contact_phone'    => 'required',
            'content'   => 'required',
        );
        //��ʼ��֤
        $validator = Validator::make(Input::all(), $rules);
        if($validator->passes())
        {
            $contactRecord = new Contact();
            $contactRecord->contact_time = Input::get('contact_time');
            $contactRecord->contact_type = Input::get('contact_type');
            $contactRecord->contact_man = Input::get('contact_man');
            $contactRecord->contact_phone = Input::get('contact_phone');
            $contactRecord->content = Input::get('content');
            $contactRecord->contact_on = Input::get('contact_on');
            $contactRecord->user_id = $this->_user->uid;
            $contactRecord->username = $this->_user->username;
            //$result = $contactRecord::firstOrCreate(Input::only('order_id', 'verify_id', 'contact_time', 'telephone', 'contact_type', 'contact_man', 'contact_phone', 'content','contact_on','user_id','username'));
            if ($contactRecord->save())
            {
                //������ϵ���������һ����ϵʱ��
//                $order = Order::where('verify_id', '=', $contactRecord->verify_id)->first();
//                $order->contact_number = $order->contact_number + 1;
//                $order->contact_lasted_at = $contactRecord->contact_time;
//                $order->save();
                    $data = [
                        'ret'=>0,
                        'data'=>$contactRecord->toArray()
                    ];
                exit(json_encode($data));
                $this->exitJson(Core_Modret::RET_SUCC,'','',$contactRecord->toArray());
            } else
            {
                $this->exitJson(Core_Modret::RET_SAVE_FAILED,"����ʧ��");
            }
        } else
        {
            $this->exitJson(Core_Modret::RET_MISS_ARG,"ȱ�ٱ�Ҫ�ֶ�");
        }
    }

}