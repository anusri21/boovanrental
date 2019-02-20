@if(Auth::user()->user_type =='admin')  

@extends('admin.default')
@section('content')
<style>
   input:focus {
   }
</style>
<div class="row">
   <div class="col-md-12">
      <form class="form-horizontal" action="{{url('admin/addclient')}}" method="post">
         {{csrf_field() }}
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><a href="{{url('admin/clientlist')}}" class="btn btn-success"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>                                   <strong>View Client</strong> </h3>
               <!-- <ul class="panel-controls">
                  <a href="#" class="btn btn-primary delete" data-id="{{ $clientrs->id }}"><i class="fa fa fa-trash-o"></i> </a>
               </ul> -->
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="panel-body">
                     <h4><b>Client Details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Client ID</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->client_id}}</label>
                           <!-- <input type="text" name="txtClientId" value="{{$clientrs->client_id}}"  class="form-control"  style="border:none"/> -->
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Client Name</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->client_name}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Organisation</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->organisation}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Address</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-8 col-xs-12 control-label">{{$clientrs->address}}</label> 
                           <!-- <textarea class="form-control" name="txtAddress" rows="3" readonly style="border:none">{{$clientrs->address}}</textarea> -->
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Email</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->emailid}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Mobile</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->mobileno}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Land Line</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->landline}}</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="panel-body">
                     <h4><b>Contact Person</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Name</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->contact_person}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Email</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->cemailid}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Phone</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->cmobileno}}</label>
                        </div>
                     </div>
                     <h4><b>Deposit and Cheque details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Deposit Months</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->deposit_months}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Deposit Amount</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->deposit_amount}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>No.of Cheque Leaf</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->num_cheque}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Total Cheque Amount</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->total_cheque_amount}}</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="panel-body">
                     <h4><b>System Details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Total No. of Systems</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->total_systems}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Duration Type</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->duration_type}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Duration</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->duration}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Start Date</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-8 col-xs-12 control-label">{{$clientrs->start_date}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>End Date</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-8 col-xs-12 control-label">{{$clientrs->end_date}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Invoice Date</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-3 col-xs-12 control-label">{{$clientrs->invoice_date}}</label>
                        </div>
                     </div>
                     <h4><b>Additional Details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Comments</b></label>
                        <div class="col-md-9 col-xs-12">  
                           <label class="col-md-8 col-xs-12 control-label">{{$clientrs->comments}}</label>                                          
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
         </div>
      </form>
   </div>
</div>
<div class="col-md-12">
<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
   <div class="panel-heading">

   <?php
         $totalpay =array();
         foreach($systm as $val)
         {
            $tot=$val->total_amount;
            $totalpay[]=$tot;
         }
            $totpayment=array_sum($totalpay);
         
   ?>


      <h3 class="panel-title"><strong>System Details</strong> </h3>
      <ul class="panel-controls">
                                    
         <h5>Total Payment: <?php echo $totpayment; ?></h5>
      </ul>                                 
   </div>
   <div class="panel-body">
      <div class="table-responsive">
         <table class="table datatable">
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>System Type</th>
                  <th>Sys Vendor</th>
                  <th>Qty</th>
                  <th>Unit Rent</th>
                  <th>Sub Total</th>
                  <th>Last Update</th>
                  <!-- <th>View/Edit</th>
                  <th>Delete</th> -->
               </tr>
            </thead>
            <tbody>
               <?php
                  $i=0;
                  ?>
               @foreach ($systm as $val)
               <tr>
                  <td>{{++$i}}</td>
                  <td>{{ $val->system_type}}</td>
                  <td>{{ $val->rental_vendor}}</td>
                  <td>{{$val->system_qty}}</td>
                  <td>{{ $val->unit_rent}}</td>
                  <td>{{ $val->total_amount}}</td>
                  <td>{{ $val->last_update_date}}</td>
                  <!-- <td><a href="{{ url('admin/edituser/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> </a></td>
                  <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i>  </button></td> -->
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
   <div class="panel-footer">
               <a href="{{url('admin/clientlist')}}" class="btn btn-success"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>                                   
               <!-- <button type="submit" class="btn btn-primary pull-right">Submit</button> -->
            </div>
</div>
<!-- END DEFAULT DATATABLE -->
<script>
   $(document).on('click','.delete',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      var url = "{{ url('admin/deleteclient') }}"+"/"+id;
      //alert(url);
      window.location.href = url;
    });
</script>
@stop
@endif