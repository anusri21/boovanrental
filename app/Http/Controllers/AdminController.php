<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Validator;
use Response;
use DB;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{
    public function __construct() 
    {
        $this->admin = new Admin();
    }

    

    public function addclient(Request $request)
    {
        $data=$request->all();
         //dd($data);
        //print_r($data);
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'client_id' => isset($data['txtClientId']) ? $data['txtClientId'] : '',
                'client_name' => isset($data['txtClientName']) ? $data['txtClientName'] : '',
                'organisation' => isset($data['txtOrg']) ? $data['txtOrg'] : '',
                'emailid' => isset($data['txtEmail']) ? $data['txtEmail'] : '',
                'mobileno' => isset($data['txtMobile']) ? $data['txtMobile'] : '',
                'landline' => isset($data['txtLandLine']) ? $data['txtLandLine'] : '',
                'address' => isset($data['txtAddress']) ? $data['txtAddress'] : '',
                'contact_person' => isset($data['txtContactPerson']) ? $data['txtContactPerson'] : '',
                'cemailid' => isset($data['txtcEmail']) ? $data['txtcEmail'] : '',
                'cmobileno' => isset($data['txtcMobile']) ? $data['txtcMobile'] : '',
                'profile_type' => isset($data['sprofile']) ? $data['sprofile'] : '',
                'start_date' => isset($data['txtDeliveryDate']) ? $data['txtDeliveryDate'] : '',
                'end_date' => isset($data['txtReturnDate']) ? $data['txtReturnDate'] : '',
                'invoice_date' => isset($data['selInvoiceDate']) ? $data['selInvoiceDate'] : '',
                'comments' => isset($data['txtComments']) ? $data['txtComments'] : '',
                'duration_type' => isset($data['selDurationType']) ? $data['selDurationType'] : '',
                'duration' => isset($data['selDuration']) ? $data['selDuration'] : '',
                'total_systems' => isset($data['txtTotSys']) ? $data['txtTotSys'] : '',
                'deposit_months' => isset($data['txtDepositmonths']) ? $data['txtDepositmonths'] : '',
                'deposit_amount' => isset($data['txtDepositAmount']) ? $data['txtDepositAmount'] : '',
                'num_cheque' => isset($data['txtnCheque']) ? $data['txtnCheque'] : '',
                'total_cheque_amount' => isset($data['txtcAmount']) ? $data['txtcAmount'] : '',
               
            ];

            $rules = array(
                'client_name' => 'required',
                'organisation' => 'required',
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $clientInput = array(
                    'id' => $input['id'],
                    'client_id' => $input['client_id'],
                    'client_name' => $input['client_name'],
                    'organisation' => $input['organisation'],
                    'emailid' => $input['emailid'],
                    'mobileno' => $input['mobileno'],
                    'landline' => $input['landline'],
                    'address' => $input['address'],
                    'contact_person' => $input['contact_person'],
                    'cemailid' => $input['cemailid'],
                    'cmobileno' => $input['cmobileno'],
                    'profile_type' =>1,
                    'start_date' => $input['start_date'],
                    'end_date' => $input['end_date'],
                    'invoice_date' => $input['invoice_date'],
                    'comments' => $input['comments'],
                    'duration_type' => $input['duration_type'],
                    'duration' => $input['duration'],
                    'total_systems' => $input['total_systems'],
                    'deposit_months' => $input['deposit_months'],
                    'deposit_amount' => $input['deposit_amount'],
                    'num_cheque' => $input['num_cheque'],
                    'total_cheque_amount' => $input['total_cheque_amount'],
                );
                //dd($clientInput);
                $client = $this->admin->addClient($clientInput);
               if ($client) {
                   
                    $data = Session::flash('message', 'Successfully Added!');
                    return Redirect::back()->with(['data', $data], ['message', $data]);

                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }

    public function addsystemdetails(Request $request,$id)
    {
        $data=$request->all();
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'client_id' => isset($data['cId']) ? $data['cId'] : '',
                'rental_vendor' => isset($data['txtSysVendor']) ? $data['txtSysVendor'] : '',
                'system_type' => isset($data['txtSysType']) ? $data['txtSysType'] : '',
                'short_description' => isset($data['txtShortDes']) ? $data['txtShortDes'] : '',
                'serial_no' => isset($data['txtSerial']) ? $data['txtSerial'] : '',
                'system_qty' => isset($data['txtQty']) ? $data['txtQty'] : '',
                'unit_rent' => isset($data['txtUnitRent']) ? $data['txtUnitRent'] : '',
                'description' => isset($data['txtDes']) ? $data['txtDes'] : '',
               
               
            ];

            $rules = array(
                'rental_vendor' => 'required',
                'system_type' => 'required',
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $systemInput = array(
                    'id' => $input['id'],
                    'client_id' => $id,
                    'rental_vendor' => $input['rental_vendor'],
                    'system_type' => $input['system_type'],
                    'short_description' => $input['short_description'],
                    'system_qty' => $input['system_qty'],
                    'unit_rent' => $input['unit_rent'],
                    'description' => $input['description'],
                   'last_update_date'=>date("Y-m-d H:i:s"),
                   'total_amount'=>$input['unit_rent']*$input['system_qty'],
                );
                //dd($clientInput);
                $system = $this->admin->addSystem($systemInput);
               if ($system) {
                   
                    $data = Session::flash('message', 'Successfully Added!');
                    return Redirect::back()->with(['data', $data], ['message', $data]);

                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }

    public function viewsystemdetl($id)
    {
        $system = DB::table('crs_system_details')->where('id',$id)->first();
        //dd($system);
        if($system){
            return Response::json([
                'status' => 1,
                'system' => $system,
                    ], 200);
        }else{
            return Response::json([
                'status' => 0,
                'message' => 'Not Selected'
                    ], 400);
        }

    }
    public function saveService(Request $request)
    {
        $data=$request->all();
         //dd($data);

        if ($data != null) {
            //dd($data);

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'client_name' => isset($data['client_name']) ? $data['client_name'] : '',
                'service_desc' => isset($data['service_desc']) ? $data['service_desc'] : '',
                'reported_date' => isset($data['reported_date']) ? $data['reported_date'] : '',
                'call_attend' => isset($data['call_attend']) ? $data['call_attend'] : '',
                'assigned_to' => isset($data['assigned_to']) ? $data['assigned_to'] : '',
                'service_type' => isset($data['service_type']) ? $data['service_type'] : '',
               
            ];
            $rules = array(
                'client_name' => 'required',
                'service_desc' => 'required',
                'reported_date' => 'required',
                'call_attend' => 'required',
                'assigned_to' => 'required'
               
            );
            //dd($input);
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                //dd($input);
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
                //dd($input);
                $serviceInput = array(
                    'id' => $input['id'],
                    'client_name' => $input['client_name'],
                    'service_desc' => $input['service_desc'],
                    'reported_date' => $input['reported_date'],
                    'call_attend' => $input['call_attend'],
                    'assigned_to' => $input['assigned_to'],
                    'service_type' => $input['service_type'],
                    'status'=>1
                );

                //dd($userInput);
                $service = $this->admin->addservice($serviceInput);

                // $count = count($data['client_name']);
                // $temp = array();
                // for($i=0; $i < $count; $i++) {
                //  $temp = array(
                //      'id' => isset($input['linesid'][$i]) ? $input['linesid'][$i] : false,
                //      'header_id' => $service,
                //      'client_id' => $input['client_name'][$i],
                //      );
                // $linesdata = $this->admin->saveClientlist($temp);                      
                // }

               if ($service) {
                        return redirect('admin/servicelist');
                        // $data = Session::flash('message', 'Successfully Added!');
                        // return Redirect::back()->with(['data', $data], ['message', $data]);
                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }

    public function getservice($id)
    {
        $service=DB::table('crs_service')
                ->select('crs_service.*','a1.firstname as callattn','a2.firstname as assignto','crs_client.client_name','crs_client.id as cid')
                ->join('crs_admin_users as a1','a1.id','=','crs_service.call_attend')
                ->join('crs_admin_users as a2','a2.id','=','crs_service.assigned_to')
                ->join('crs_client','crs_client.id','=','crs_service.client_name')
                ->where('crs_service.id',$id)
                ->first();
        //dd($service);
        if($service){
            return Response::json([
                'status' => 1,
                'service' => $service,
                    ], 200);
        }else{
            return Response::json([
                'status' => 0,
                'message' => 'Not Selected'
                    ], 400);
        }

    }

    public function editsystemdetails(Request $request)
    {
        $data=$request->all();
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'client_id' => isset($data['cId']) ? $data['cId'] : '',
                'rental_vendor' => isset($data['txtSysVendor']) ? $data['txtSysVendor'] : '',
                'system_type' => isset($data['txtSysType']) ? $data['txtSysType'] : '',
                'short_description' => isset($data['txtShortDes']) ? $data['txtShortDes'] : '',
                'serial_no' => isset($data['txtSerial']) ? $data['txtSerial'] : '',
                'system_qty' => isset($data['txtQty']) ? $data['txtQty'] : '',
                'unit_rent' => isset($data['txtUnitRent']) ? $data['txtUnitRent'] : '',
                'description' => isset($data['txtDes']) ? $data['txtDes'] : '',
               
               
            ];

            $rules = array(
                'rental_vendor' => 'required',
                'system_type' => 'required',
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $systemInput = array(
                    'id' => $input['id'],
                    'client_id' => $input['client_id'],
                    'rental_vendor' => $input['rental_vendor'],
                    'system_type' => $input['system_type'],
                    'short_description' => $input['short_description'],
                    'system_qty' => $input['system_qty'],
                    'unit_rent' => $input['unit_rent'],
                    'description' => $input['description'],
                   'last_update_date'=>date("Y-m-d H:i:s"),
                   'total_amount'=>$input['unit_rent']*$input['system_qty'],
                );
                //dd($clientInput);
                $system = $this->admin->addSystem($systemInput);
               if ($system) {
                   
                    $data = Session::flash('message', 'Successfully Updated!');
                    return Redirect::back()->with(['data', $data], ['message', $data]);

                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }

    public function adduser(Request $request)
    {
        $data=$request->all();
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'role' => isset($data['role']) ? $data['role'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'email' => isset($data['email']) ? $data['email'] : '',
                'username' => isset($data['username']) ? $data['username'] : '',
                'password' => isset($data['password']) ? $data['password'] : '',
             
               
               
            ];

            $rules = array(
                'role' => 'required',
                'name' => 'required',
                'email'=>'required'
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $userInput = array(
                    'id' => $input['id'],
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'username' => $input['username'],
                    'password' => Hash::make($input['password']),
                    'user_type' => $input['role'],
                    'status'=>1,
                );
                //dd($clientInput);
                $system = $this->admin->addUser($userInput);
               if ($system) {
                   
                    $data = Session::flash('message', 'Successfully Updated!');
                    return Redirect::back()->with(['data', $data], ['message', $data]);

                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }

    public function getuser($id)
    {
        $userrs = DB::table('users')->where('id',$id)->first();
        if($userrs){
            return Response::json([
                'status' => 1,
                'userrs' => $userrs,
                    ], 200);
        }else{
            return Response::json([
                'status' => 0,
                'message' => 'Not Selected'
                    ], 400);
        }

    }

    public function updateUser(Request $request)
    {
        $data=$request->all();
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'role' => isset($data['role']) ? $data['role'] : '',
                'name' => isset($data['name']) ? $data['name'] : '',
                'email' => isset($data['email']) ? $data['email'] : '',
                'username' => isset($data['username']) ? $data['username'] : '',
                //'password' => isset($data['password']) ? $data['password'] : '',
             
               
               
            ];

            $rules = array(
                'role' => 'required',
                'name' => 'required',
                'email'=>'required'
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $userInput = array(
                    'id' => $input['id'],
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'username' => $input['username'],
                    //'userpassword' => $input['password'],
                    'user_type' => $input['role'],
                    // 'trash_status'=>0,
                    // 'active_status'=>1,
                    // 'profile_type'=>1,
                );
                //dd($clientInput);
                $system = $this->admin->addUser($userInput);
               if ($system) {
                   
                    $data = Session::flash('message', 'Successfully Updated!');
                    return Redirect::back()->with(['data', $data], ['message', $data]);

                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }

    public function savecomments(Request $request)
    {
        $data=$request->all();
        //dd($data);
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'user_id' => isset($data['user_id']) ? $data['user_id'] : '',
                'comments' => isset($data['comments']) ? $data['comments'] : '',
                'service_id' => isset($data['service_id']) ? $data['service_id'] : '',
                'service_status' => isset($data['service_status']) ? $data['service_status'] : '',
            ];

            $rules = array(
                'comments' => 'required',
               
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $commentInput = array(
                    'id' => $input['id'],
                    'user_id' => $input['user_id'],
                    'service_id' => $input['service_id'],
                    'comments' => $input['comments'],
                    'service_status'=>$input['service_status'],
                   
                );
                //dd($clientInput);
                $comment = $this->admin->addComment($commentInput);

                $s_status=array(
                    'service_status'=>$input['service_status'],
                    'updated_at'=>Carbon::now()->toDateTimeString(),
                );
                $updatestatus=DB::table('crs_service')->where('id',$input['service_id'])->update($s_status);
               if ($comment) {
                   
                    $data = Session::flash('message', 'Successfully Added!');
                    return Redirect::back()->with(['data', $data], ['message', $data]);

                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }

    public function adduserlead(Request $request)
    {
        $data=$request->all();
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'client_name' => isset($data['client_name']) ? $data['client_name'] : '',
                'requirements' => isset($data['requirements']) ? $data['requirements'] : '',
                'contact_number' => isset($data['contact_number']) ? $data['contact_number'] : '',
                'contact_email' => isset($data['contact_email']) ? $data['contact_email'] : '',
               // 'password' => isset($data['password']) ? $data['password'] : '',
             
               
               
            ];

            $rules = array(
                'client_name' => 'required',
                'requirements' => 'required',
                'contact_number'=>'required',
                'contact_email'=>'required'
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $userInput = array(
                    'id' => $input['id'],
                    'client_name' => $input['client_name'],
                    'requirements' => $input['requirements'],
                    'contact_number' => $input['contact_number'],
                    'contact_email' => $input['contact_email'],
                    //'user_type' => $input['role'],
                   // 'status'=>1,
                );
                //dd($clientInput);
                $system = $this->admin->addUserLead($userInput);
               if ($system) {
                   
                    $data = Session::flash('message', 'Successfully Updated!');
                    return Redirect::back()->with(['data', $data], ['message', $data]);

                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }

    public function editlead($id)
    {
        $system = DB::table('crs_new_leads')->where('id',$id)->first();
        //dd($system);
        if($system){
            return Response::json([
                'status' => 1,
                'system' => $system,
                    ], 200);
        }else{
            return Response::json([
                'status' => 0,
                'message' => 'Not Selected'
                    ], 400);
        }

    }
    public function addamount(Request $request)
    {
        $data=$request->all();
        //dd($data);
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'expense_date' => isset($data['expense_date']) ? $data['expense_date'] : '',
                'invoice_vendor' => isset($data['invoice_vendor']) ? $data['invoice_vendor'] : '',
                'expense_type' => isset($data['expense_type']) ? $data['expense_type'] : '',
                'cash_type' => isset($data['cash_type']) ? $data['cash_type'] : '',
                'description' => isset($data['description']) ? $data['description'] : '',
                'payment_type' => isset($data['payment_type']) ? $data['payment_type'] : '',
                'entry_amount' => isset($data['entry_amount']) ? $data['entry_amount'] : '',
                'voucher_no' => isset($data['voucher_no']) ? $data['voucher_no'] : '',
                'voucher_person' => isset($data['voucher_person']) ? $data['voucher_person'] : '',
                'payment_remarks' => isset($data['payment_remarks']) ? $data['payment_remarks'] : '',
               // 'password' => isset($data['password']) ? $data['password'] : '',
             
               
               
            ];

            $rules = array(
                'expense_date' => 'required',
                'invoice_vendor' => 'required',
                'expense_type'=>'required',
                'cash_type'=>'required',
                'description' => 'required',
                'payment_type' => 'required',
                'entry_amount'=>'required',
                'voucher_no'=>'required',
                'voucher_person'=>'required',
                'payment_remarks'=>'required'
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $userInput = array(
                    'id' => $input['id'],
                    'expense_date' => $input['expense_date'],
                    'invoice_vendor' => $input['invoice_vendor'],
                    'expense_type' => $input['expense_type'],
                    'cash_type' => $input['cash_type'],
                    'description' => $input['description'],
                    'payment_type' => $input['payment_type'],
                    'entry_amount' => $input['entry_amount'],
                    'voucher_no' => $input['voucher_no'],
                    'voucher_person' => $input['voucher_person'],
                    'payment_remarks' => $input['payment_remarks'],
                    //'user_type' => $input['role'],
                   // 'status'=>1,
                );
                //dd($userInput);
                $system = $this->admin->addAmount($userInput);
               if ($system) {
                   
                    $data = Session::flash('message', 'Successfully Updated!');
                    return Redirect::back()->with(['data', $data], ['message', $data]);

                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }
    public function updateamount(Request $request)
    {
        $data=$request->all();
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'expense_date' => isset($data['expense_date']) ? $data['expense_date'] : '',
                'invoice_vendor' => isset($data['invoice_vendor']) ? $data['invoice_vendor'] : '',
                'expense_type' => isset($data['expense_type']) ? $data['expense_type'] : '',
                'cash_type' => isset($data['cash_type']) ? $data['cash_type'] : '',
                'description' => isset($data['description']) ? $data['description'] : '',
                'payment_type' => isset($data['payment_type']) ? $data['payment_type'] : '',
                'entry_amount' => isset($data['entry_amount']) ? $data['entry_amount'] : '',
                'voucher_no' => isset($data['voucher_no']) ? $data['voucher_no'] : '',
                'voucher_person' => isset($data['voucher_person']) ? $data['voucher_person'] : '',
                'payment_remarks' => isset($data['payment_remarks']) ? $data['payment_remarks'] : '',
               // 'password' => isset($data['password']) ? $data['password'] : '',
             
               
               
            ];

            $rules = array(
                'expense_date' => 'required',
                'invoice_vendor' => 'required',
                'expense_type'=>'required',
                'cash_type'=>'required',
                'description' => 'required',
                'payment_type' => 'required',
                'entry_amount'=>'required',
                'voucher_no'=>'required',
                'voucher_person'=>'required',
                'payment_remarks'=>'required'
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $userInput = array(
                    'id' => $input['id'],
                    'expense_date' => $input['expense_date'],
                    'invoice_vendor' => $input['invoice_vendor'],
                    'expense_type' => $input['expense_type'],
                    'cash_type' => $input['cash_type'],
                    'description' => $input['description'],
                    'payment_type' => $input['payment_type'],
                    'entry_amount' => $input['entry_amount'],
                    'voucher_no' => $input['voucher_no'],
                    'voucher_person' => $input['voucher_person'],
                    'payment_remarks' => $input['payment_remarks'],
                    //'user_type' => $input['role'],
                   // 'status'=>1,
                );
                //dd($clientInput);
                $system = $this->admin->addAmount($userInput);
               if ($system) {
                   
                    $data = Session::flash('message', 'Successfully Updated!');
                    return Redirect::back()->with(['data', $data], ['message', $data]);

                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }
    public function editamount($id)
    {
        $system = DB::table('crs_account_managment')->where('id',$id)->first();
        //dd($system);
        if($system){
            return Response::json([
                'status' => 1,
                'system' => $system,
                    ], 200);
        }else{
            return Response::json([
                'status' => 0,
                'message' => 'Not Selected'
                    ], 400);
        }

    }

    public function filterService(Request $request)
    {
        $data=$request->all();
        //dd($data['from_date']);
        $startDate=$data['from_date'];
        $endDate=$data['end_date'];
        $assign=$data['assign'];
        $filter = DB::table('crs_service')
                ->select('crs_service.*','a1.firstname as callattn','a2.name as assignto','crs_client.client_name','crs_client.id as cid')
                ->join('crs_admin_users as a1','a1.id','=','crs_service.call_attend')
                ->join('users as a2','a2.id','=','crs_service.assigned_to')
                ->join('crs_client','crs_client.id','=','crs_service.client_name')
                ->where('crs_service.status',1)
                ->orderby('crs_service.id','DESC')
                ->where('a2.id',$assign)
                ->whereBetween('reported_date', [$startDate, $endDate])
                ->get();
                
        if($filter){
            return Response::json([
                'status' => 1,
                'filter' => $filter,
                    ], 200);
        }else{
            return Response::json([
                'status' => 0,
                'message' => 'Not Selected'
                    ], 400);
        }
    }


    public function addcomments(Request $request)
    {
        $data=$request->all();
        //dd($data);
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'user_id' => isset($data['user_id']) ? $data['user_id'] : '',
                'comments' => isset($data['comments']) ? $data['comments'] : '',
                'leads_id' => isset($data['leads_id']) ? $data['leads_id'] : '',
                'leads_status' => isset($data['leads_status']) ? $data['leads_status'] : '',
            ];

            $rules = array(
                'comments' => 'required',
               
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $commentInput = array(
                    'id' => $input['id'],
                    'user_id' => $input['user_id'],
                    'leads_id' => $input['leads_id'],
                    'comments' => $input['comments'],
                    'leads_status'=>$input['leads_status'],
                   
                );
                //dd($clientInput);
                $comment = $this->admin->addComments($commentInput);

                $s_status=array(
                    'leads_status'=>$input['leads_status'],
                    //'updated_at'=>Carbon::now()->toDateTimeString(),
                );
                $updatestatus=DB::table('crs_new_leads')->where('id',$input['leads_id'])->update($s_status);
               if ($comment) {
                   
                    $data = Session::flash('message', 'Successfully Added!');
                    return Redirect::back()->with(['data', $data], ['message', $data]);

                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
       
    }
    public function addServiceType(Request $request){
        $data = $request->all();
        //dd($data);
        if ($data != null) {

            $input = [
                'id' => isset($data['id']) ? $data['id'] : false,
                'service_type' => isset($data['service_type']) ? $data['service_type'] : '',
                
    
            ];

            $rules = array(
                'service_type' => 'required',
                
               
            );
            $checkValid = Validator::make($input, $rules);
            if ($checkValid->fails()) {
                $data = Session::flash('error', 'Please Provide All Datas!');
                return Redirect::back()
                ->withInput()
                ->withErrors($data);
            } else { 
               
                $userInput = array(
                    'id' => $input['id'],
                    'service_type' => $input['service_type'],
                    
                );
                //dd($userInput);
                $system = $this->admin->addServicetype($userInput);
               if ($system) {
                   
                    $data = Session::flash('message', 'Successfully Updated!');
                    return Redirect::back()->with(['data', $data], ['message', $data]);

                } else {
                    $data = Session::flash('warning', 'Something Error Occured!');
                    return Redirect::back()->with(['data', $data], ['warning', $data]);
                }
            }
        } else {
            return Response::json([
                        'status' => 0,
                        'message' => "No data"
            ]);
        }
    }
    public function editservicetype($id)
    {
        $system = DB::table('crs_service_type')->where('id',$id)->first();
        //dd($system);
        if($system){
            return Response::json([
                'status' => 1,
                'system' => $system,
                    ], 200);
        }else{
            return Response::json([
                'status' => 0,
                'message' => 'Not Selected'
                    ], 400);
        }
    }
}
