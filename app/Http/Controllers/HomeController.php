<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DB;
use Redirect;
use Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->user_type =='admin'){
        $totincome = DB::table("crs_system_details")
                    ->select(DB::raw("SUM(total_amount) as totrent"))
                    ->where('trash_status',0)
                    ->where('rental_status','yes')
                    ->first();
        $clientcount =DB::table('crs_client')->where('trash_status',0)->where('active','yes')->count();
        $leadscount=DB::table('crs_new_leads')->where('status', 1)->count();
        //dd($totincome);
        return view('admin.pages.dashboard')->with('clientcount',$clientcount)->with('leadscount',$leadscount)->with('totincome',$totincome);
        }else{
            return redirect('admin/servicelist');
        }
    }
    public function login()
    {
        return view('auth.login');
    }

    public function clientlist()
    {
        if(Auth::user()->user_type =='admin'){
        $clientrs = DB::table('crs_client')->where('trash_status',0)->where('active','yes')->get();

        $amount = array();
        foreach($clientrs as $val)
        {
            $cid=$val->id;
            $data = DB::table("crs_system_details")
                    ->select(DB::raw("SUM(total_amount) as totrent"),'client_id')
                    ->where('trash_status',0)
                    ->groupBy(DB::raw("client_id"))
                    ->where('client_id',$cid)
                    ->first();
            //dd($data->totrent);
                    if($data){
                            $amount[$cid]=$data->totrent;
                    }else{
                        $amount[$cid]=0;
                    }
                    //dd($amount);
        }
        $totincome = DB::table("crs_system_details")
                    ->select(DB::raw("SUM(total_amount) as totrent"))
                    ->where('trash_status',0)
                    ->where('rental_status','yes')
                    ->first();
        //($totincome);
        return view('admin.pages.clientlist')->with('clientrs',$clientrs)->with('amount',$amount)->with('totincome',$totincome);
        }
    }
    public function clientview($id)
    {
        if(Auth::user()->user_type =='admin'){
        $s_vendor=DB::table('crs_system_vendor')->get();
        $s_type  =DB::table('crs_system_type')->get();



        $clientrs = DB::table('crs_system_details')
                  ->select('crs_system_details.*','crs_client.id as cid','crs_client.client_name')
                  ->join('crs_client','crs_client.id','=','crs_system_details.client_id')
                  ->where('crs_system_details.trash_status',0)
                  ->where('crs_system_details.client_id',$id)
                  ->get();

        $name='';
        if($clientrs){
            foreach($clientrs as $val)
            {
                $name=$val->client_name;
                
            }
        }else{
            $name=0;
        }
        //dd($name);
        return view('admin.pages.clientview')->with('clientrs',$clientrs)->with('cname',$name)
                                            ->with('vendor',$s_vendor)->with('type',$s_type);
    }
}

    public function addclient()
    {
        if(Auth::user()->user_type =='admin'){
        $clientlists=DB::table('crs_client')->where('profile_type',1)->orderBy('id', 'DESC')->take(1)->first();
        // $strId = explode(",",$clientlists->id);
         $strId=$clientlists->id;
         $strTxt = "CRS";
         $strNext = ($strId + 1);
         $strCid = $strTxt.sprintf("%04d", $strNext);
         //dd($strCid);


        return view('admin.pages.addclient')->with('clientid',$strCid);
        }
    }
    public function viewclient($id)
    {
        if(Auth::user()->user_type =='admin'){
        $client=DB::table('crs_client')->where('id',$id)->first();
        $clientrs = DB::table('crs_system_details')
                  ->select('crs_system_details.*','crs_client.id','crs_client.client_name')
                  ->join('crs_client','crs_client.id','=','crs_system_details.client_id')
                  ->where('crs_system_details.trash_status',0)
                  ->where('crs_system_details.client_id',$id)
                  ->get();
        return view('admin.pages.viewclient')->with('clientrs',$client)->with('systm',$clientrs);
        }
    }
    public function editclient($id)
    {
        if(Auth::user()->user_type =='admin'){
        $client=DB::table('crs_client')->where('id',$id)->first();
        //dd($client);
        return view('admin.pages.editclient')->with('clientrs',$client);
        }
    }
    public function deleteclient($id)
    {
        
        if(Auth::user()->user_type =='admin'){
        $client = array(
           
            'active'=>'no',
            //'updated_at' => date("Y-m-d H:i:s")
        );
        $updateclient=DB::table('crs_client')->where('id', $id)->update($client);

        if($updateclient){
            
            return redirect('admin/clientlist');
        }
        else{
            return redirect('admin/clientlist');
        }
    }
    }
    public function addService()
    {
        $service = DB::table('crs_service')->get();
        $user = DB::table('crs_admin_users')->get();
        $name = DB::table('crs_client')->get();
        $type  = DB::table('crs_service_type')->get();
        $assrole=DB::table('users')->where('user_type','technician')->where('status',1)->get();
        return view('admin.pages.addservices')->with('role',$service)->with('user',$user)->with('name',$name)->with('assrole',$assrole)->with('type',$type);
    }
    public function servicelist()
    {
        $startDate = @$_GET['sdate'];
        $endDate = @$_GET['ldate'];
        $assign = @$_GET['assign'];
        
        $currentMonth = date('m');
        //dd($currentMonth);
        $user = DB::table('crs_admin_users')->get();
        $name = DB::table('crs_client')->get();
        $assrole=DB::table('users')->where('user_type','technician')->where('status',1)->get();
        
        if($startDate&&$endDate&&$assign)
        {
            $service = DB::table('crs_service')
                ->select('crs_service.*','a1.firstname as callattn','a2.name as assignto','crs_client.client_name','crs_client.id as cid','crs_service_type.service_type')
                ->join('crs_admin_users as a1','a1.id','=','crs_service.call_attend')
                ->join('users as a2','a2.id','=','crs_service.assigned_to')
                ->join('crs_client','crs_client.id','=','crs_service.client_name')
                ->leftJoin('crs_service_type','crs_service_type.id','=','crs_service.service_type')
                ->where('crs_service.status',1)
                ->orderby('crs_service.id','DESC')
                ->where('a2.id',$assign)
                ->whereBetween('reported_date', [$startDate, $endDate])
                ->get();

        }
        else{

        $service=DB::table('crs_service')
                ->select('crs_service.*','a1.firstname as callattn','a2.name as assignto','crs_client.client_name','crs_client.id as cid','crs_service_type.service_type')
                ->join('crs_admin_users as a1','a1.id','=','crs_service.call_attend')
                ->join('users as a2','a2.id','=','crs_service.assigned_to')
                ->join('crs_client','crs_client.id','=','crs_service.client_name')
                ->leftJoin('crs_service_type','crs_service_type.id','=','crs_service.service_type')
                ->where('crs_service.status',1)
                ->where('crs_service.service_status','open')
                ->whereRaw('MONTH(crs_service.reported_date) = ?',[$currentMonth])
                ->orderby('crs_service.id','DESC')
                ->get();
        }
       //dd($service);
        return view('admin.pages.servicelist')->with('service',$service)->with('user',$user)->with('name',$name)->with('assrole',$assrole);
    }

    public function deleteservice($id)
    {
        
        //dd($id);
        $client = array(
           
            'status'=>'0',
            'updated_at' => date("Y-m-d H:i:s")
        );
        $updateclient=DB::table('crs_service')->where('id', $id)->update($client);

        if($updateclient){
            
            return redirect('admin/servicelist');
        }
        else{
            return redirect('admin/servicelist');
        }
    
    }

    public function deletesystem($id)
    {
        
        if(Auth::user()->user_type =='admin'){
        $client = array(
           
            'trash_status'=>'1',
            //'updated_at' => date("Y-m-d H:i:s")
        );
        $updateclient=DB::table('crs_system_details')->where('id', $id)->update($client);

        if($updateclient){
            
            return Redirect::back();
        }
        else{
            return redirect('admin/clientview');
        }
    }
    }
    public function getsysedit($id)
    {
        if(Auth::user()->user_type =='admin'){
        $s_vendor=DB::table('crs_system_vendor')->get();
        $s_type  =DB::table('crs_system_type')->get();

        $sysdetail=DB::table('crs_system_details')->where('id',$id)->first();
        //dd($sysdetail);
        if($sysdetail){
            
            return view('admin.pages.editsystem')->with('sysdetail',$sysdetail) ->with('vendor',$s_vendor)->with('type',$s_type);
        }
        else{
            return redirect('admin/clientview');
        }
    }
    }

    public function userlist()
    {
        if(Auth::user()->user_type =='admin'){
        $userrs = DB::table('users')
                ->where('status',1)
                ->where(function($q) {
                    $q->where('user_type', 'technician')
                      ->orWhere('user_type', 'manager')
                      ->orWhere('user_type', 'client');
                })
                // ->where('user_type','manager')
                // ->orwhere('user_type','technician')
                // ->orwhere('user_type','client')
               
                ->get();
       // dd($userrs);
        return view('admin.pages.userlist')->with('userrs',$userrs);
        }
    }

    public function deleteuser($id)
    {
        
        if(Auth::user()->user_type =='admin'){
        $client = array(
           
            'status'=>'0',
            'updated_at' => date("Y-m-d H:i:s")
        );
        //dd($client);
        $updateclient=DB::table('users')->where('id', $id)->update($client);

        if($updateclient){
            
            return Redirect::back();
        }
        else{
            return redirect('admin/clientview');
        }
        }
    }
    
    public function viewservice($id)
    {
        if(Auth::user()->user_type =='admin')
        {
        $service=DB::table('crs_service')
                ->select('crs_service.*','a1.firstname as callattn','a2.name as assignto','crs_client.client_name','crs_client.id as cid')
                ->join('crs_admin_users as a1','a1.id','=','crs_service.call_attend')
                ->join('users as a2','a2.id','=','crs_service.assigned_to')
                ->join('crs_client','crs_client.id','=','crs_service.client_name')
                //->join('crs_service_comments','crs_service_comments.service_id','=','crs_service.id')
                ->where('crs_service.id',$id)
                ->first();
        $cmnts=DB::table('crs_service_comments')
                    ->select('crs_service_comments.*','users.name')
                    ->join('users','users.id','=','crs_service_comments.user_id')
                    ->where('service_id',$id)
                    ->get();
        }else{
            //$uid = Auth::user()->id;
            $service=DB::table('crs_service')
                ->select('crs_service.*','a1.firstname as callattn','a2.name as assignto','crs_client.client_name','crs_client.id as cid')
                ->join('crs_admin_users as a1','a1.id','=','crs_service.call_attend')
                ->join('users as a2','a2.id','=','crs_service.assigned_to')
                ->join('crs_client','crs_client.id','=','crs_service.client_name')
                //->join('crs_service_comments','crs_service_comments.service_id','=','crs_service.id')
                ->where('crs_service.id',$id)
                ->first();
            $cmnts=DB::table('crs_service_comments')->where('service_id',$id)->get();
        }
        //$cmnts=DB::table('crs_service_comments')->where('service_id',$id)->get();
      //dd($cmnts);
        return view('admin.pages.viewservice')->with('service',$service)->with('cmnts',$cmnts);

    }

    public function userleadlist()
    {
        if(Auth::user()->user_type =='admin'){
         $leads = DB::table('crs_new_leads')->where('status', 1)->orderby('id', 'DESC')->get();
    //             ->where('user_type','manager')->orwhere('user_type','technician')
    //             ->orwhere('user_type','client')
    //             ->whereStatus(1)
    //             ->get();
        //dd($userrs);
        return view('admin.pages.userleadslist')->with('leads',$leads);
        //->with('userrs',$userrs);
        }
    }
    public function deletelead($id)
    {
        
        if(Auth::user()->user_type =='admin'){
        $client = array(
           
            'status'=>'0',
            //'updated_at' => date("Y-m-d H:i:s")
        );
        //dd($client);
        $updatelead=DB::table('crs_new_leads')->where('id', $id)->update($client);

        if($updatelead){
            
            return Redirect::back();
        }
        else{
            return redirect('admin/userleadslist');
        }
        }
    }
    public function amountlist()
    {
        $s_vendor=DB::table('crs_system_vendor')->get();
        $amount = DB::table('crs_account_managment')->where('status',1)->where('rec_active_status',1)->orderby('id','DESC')->get();
        $totincome = DB::table("crs_account_managment")
                    ->select(DB::raw("SUM(entry_amount) as income"))
                    ->where('cash_type','credit')
                    ->where('status',1)
                    ->where('rec_active_status',1)
                    ->first();
        $totexpense = DB::table("crs_account_managment")
                    ->select(DB::raw("SUM(entry_amount) as expense"))
                    ->where('cash_type','debit')
                    ->where('status',1)
                    ->where('rec_active_status',1)
                    ->first();
        $balance = $totincome->income-$totexpense->expense;
       //dd($balance);
       
        return view('admin.pages.amountlist')->with('amount',$amount)->with('vendor',$s_vendor)->with('totincome',$totincome)
                    ->with('totexpense',$totexpense)->with('balance',$balance);
    }
    public function deleteamount($id)
    {
        
        if(Auth::user()->user_type =='admin'){
        $client = array(
           
            'status'=>'0',
            //'updated_at' => date("Y-m-d H:i:s")
        );
        //dd($client);
        $updateamount=DB::table('crs_account_managment')->where('id', $id)->update($client);

        if($updateamount){
            
            return Redirect::back();
        }
        else{
            return redirect('admin/amountlist');
        }
        }
    }

    public function viewleads($id)
    {
        

        $leads = DB::table('crs_new_leads')
                    //->select('crs_new_leads.*')//,'a1.firstname as callattn','a2.firstname as assignto','crs_client.client_name','crs_client.id as cid')
                     //->join('crs_new_leads.id','=','crs_new_leads_comments.id')
                    // ->join('crs_admin_users as a2','a2.id','=','crs_service.assigned_to')
                    // ->join('crs_client','crs_client.id','=','crs_service.client_name')
                    ->where('id',$id)
                    ->first();
            //dd($leads);
            $lead =DB::table('crs_new_leads_comments')
            ->select('crs_new_leads_comments.*','users.name')
             ->join('users','users.id','=','crs_new_leads_comments.user_id')
             ->where('crs_new_leads_comments.leads_id',$id)
            ->get();
            //dd($leads);
        return view('admin.pages.viewleads')->with('leads',$leads)->with('lead',$lead);
    }

    public function serviceTypelist()
    {
        $service = DB::table('crs_service_type')->where('status',1)->get();
        return view('admin.pages.servicetypelist')->with('service',$service);
    }
    public function deleteservicetype($id)
    {
        
        if(Auth::user()->user_type =='admin'){
        $service = array(
           
            'status'=>'0',
            //'updated_at' => date("Y-m-d H:i:s")
        );
       // dd($service);
        $updateservicetype = DB::table('crs_service_type')->where('id', $id)->update($service);

        if($updateservicetype){
            
            return Redirect::back();
        }
        else{
            return redirect('admin/servicetypelist');
        }
        }
    }
}
