<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Message;
use App\Attachment;

class MailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function compose(Request $request)
    {
        $data = array();

        $data['page_title'] = "Compose";
        // $data['page_description'] = "Lorem ipsum dolor sit amet";
        
        // dd(Session::get('passport_token'));

        return view('admin.mail-compose')->with($data);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $from = "Cyberlabs.dev@gmail.com";

        try{

            DB::beginTransaction();

            $modelMessage = new Message;
            $modelMessage->to = strtolower($input['to']);
            $modelMessage->from = strtolower($from);
            $modelMessage->subject = $input['subject'];
            $modelMessage->content = $input['content'];
            $modelMessage->save();
            
            // $modelAttachment = new Attachment;
            // $modelAttachment->user_id = $modelUser->id;
            // $modelAttachment->phone = $input['phone'];
            // $modelAttachment->address = $input['address'];
            // $modelAttachment->save();

            DB::commit();

            $request->session()->flash('alert-success', _('Message has been sent'));

        } catch (\Exception $e) {

            DB::rollback();
        
            $request->session()->flash('alert-warning', _('Send Failed'));
        
        }

		return redirect()->intended(route('mail-outbox'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function inbox(Request $request)
    {
        $data = array();

        $data['page_title'] = "Inbox";
        // $data['page_description'] = "Lorem ipsum dolor sit amet";

        $userEmail = "Cyberlabs.dev@gmail.com";
        
        $model = Message::Where('to',  $userEmail)->OrderBy('created_at', 'asc');
        
        if ($request->has('q')){
            $model = $model->Where('subject', 'LIKE', '%'.$request->q.'%');
        }

        $data['list_data'] = $model->paginate(5);

        return view('admin.mail-inbox')->with($data);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function outbox(Request $request)
    {
        $data = array();

        $data['page_title'] = "Sent Items";
        // $data['page_description'] = "Lorem ipsum dolor sit amet";
        $userEmail = "Cyberlabs.dev@gmail.com";
        
        $model = Message::Where('from',  $userEmail)->OrderBy('created_at', 'asc');
        
        if ($request->has('q')){
            $model = $model->Where('subject', 'LIKE', '%'.$request->q.'%');
        }

        $data['list_data'] = $model->paginate(5);

        return view('admin.mail-outbox')->with($data);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function detailInbox(Request $request, $id)
    {
        $data = array();

        $data['page_title'] = "Inbox Detail";
        // $data['page_description'] = "Lorem ipsum dolor sit amet";
        $model = Message::find($id);

        $data['value'] = $model;

        return view('admin.mail-read-inbox')->with($data);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function detailOutbox(Request $request, $id)
    {
        $data = array();

        $data['page_title'] = "Outbox Detail";
        // $data['page_description'] = "Lorem ipsum dolor sit amet";
        $model = Message::find($id);

        $data['value'] = $model;

        return view('admin.mail-read-outbox')->with($data);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function star($type, $id)
    {
        
        // $data['page_description'] = "Lorem ipsum dolor sit amet";
        $model = Message::find($id);

        if($model->is_star == 0){
            $model->is_star = 1;
        }else{
            $model->is_star = 0;
        }

        $model->save();
        
        if($type == "outbox"){
            return redirect()->intended(route('mail-outbox'));
        }else{
            return redirect()->intended(route('mail-inbox'));
        }

    }
}
