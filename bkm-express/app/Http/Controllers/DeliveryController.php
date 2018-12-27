<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delivery;
use App\Unit;
use App\Branch;
use DB;
use Auth;

class DeliveryController extends Controller
{
    private $title = "Delivery Transaction";

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();

        $data['page_title'] = $this->title;

        // $data['page_description'] = "Lorem ipsum dolor sit amet";

        $model = Delivery::OrderBy('created_at', 'asc');
        
        if ($request->has('q')){
            $model = $model->Where('code', 'LIKE', '%'.$request->q.'%')
            ->OrWhere('bill_to', 'LIKE', '%'.$request->q.'%')
            ->OrWhere('ship_to', 'LIKE', '%'.$request->q.'%')
            ->OrWhere('ship_address', 'LIKE', '%'.$request->q.'%');
        }

        $data['list_data'] = $model->paginate(5);

        return view('admin.delivery-index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();

        $data['page_title'] = $this->title;

        $model = Branch::OrderBy('City', 'asc');
       
        $data['list_branch'] = $model->get();

        return view('admin.delivery-form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        try{

            DB::beginTransaction();

            $modelDelivery = new Delivery;
            $modelDelivery->code = rand();
            $modelDelivery->branch_id = $input['branch'];
            $modelDelivery->bill_to = $input['bill_to'];
            $modelDelivery->ship_to = $input['ship_to'];
            $modelDelivery->ship_address = $input['ship_address'];
            $modelDelivery->save();

            $dataUnit = array();

            foreach($input['qty'] as $key => $value){
                $dataUnit[] = array(
                    'delivery_id'=>$modelDelivery->id,
                    'qty'=>$input['qty'][$key],
                    'description'=>$input['description'][$key],
                    'price'=>$input['price'][$key]);
            }
            
            Unit::insert($dataUnit);

            DB::commit();

            $request->session()->flash('alert-success', _('Add Delivery Success'));

        } catch (\Exception $e) {

            DB::rollback();

            $request->session()->flash('alert-warning', _('Add Delivery Failed'));
        
        }

		return redirect()->intended(route('delivery-index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();

        $data['page_title'] = $this->title;

        $model = Delivery::where('code',$id)->first();

        $data['value'] = $model;
        
        return view('admin.delivery-detail')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();

        $data['page_title'] = $this->title;

        $model = Delivery::findOrFail($id);

        $data['value'] = $model;

        return view('admin.delivery-due-form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        try{

            DB::beginTransaction();

            $modelDelivery = Delivery::find($id);
            $modelDelivery->due_date = date('Y-m-d', strtotime($input['due_date']));
            $modelDelivery->save();

            DB::commit();

            $request->session()->flash('alert-success', _('Update Due Date Success'));

        } catch (\Exception $e) {

            DB::rollback();
        
        }

		return redirect()->intended(route('delivery-index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = Delivery::find($id);
        if($model && (Auth::user()->id != $id)){
            $model->delete();
            $request->session()->flash('alert-success', _('Delete Delivery Success'));
        }else{
            $request->session()->flash('alert-danger', _('Delete Delivery Failed'));
        }
		return redirect()->intended(route('delivery-index'));
    }
}
