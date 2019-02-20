@if(Auth::user()->user_type =='admin')  

@extends('admin.default')
@section('content')
<div class="row">
   <div class="col-md-12">
      <form class="form-horizontal" action="{{url('admin/addclient')}}" method="post">
         {{csrf_field() }}
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><strong>Edit Client</strong> </h3>
               <!-- <ul class="panel-controls">
                  <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                  </ul> -->
            </div>
            <div class="flash-message">
                  @include('admin.pages.notification')
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="panel-body">
                  <input type="hidden" name="id" value="{{$clientrs->id}}"   class="form-control"/>

                  <h4><b>Client Details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Client ID</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtClientId" value="{{$clientrs->client_id}}"  readonly class="form-control"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Client Name</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtClientName" value="{{$clientrs->client_name}}" class="form-control"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Organisation</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtOrg" value="{{$clientrs->organisation}}" class="form-control"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Address</label>
                        <div class="col-md-9 col-xs-12">                                            
                           <textarea class="form-control" name="txtAddress" rows="3">{{$clientrs->address}}</textarea>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Email</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtEmail" class="form-control" value="{{$clientrs->emailid}}"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Mobile</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtMobile" class="form-control" value="{{$clientrs->mobileno}}"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Land Line</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtLandLine" class="form-control" value="{{$clientrs->landline}}"/>
                        </div>
                     </div>
                     
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="panel-body">
                  <h4><b>Contact Person</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Name</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtContactPerson" class="form-control" value="{{$clientrs->contact_person}}"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Email</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtcEmail" class="form-control" value="{{$clientrs->cemailid}}"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Phone</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtcMobile" class="form-control" value="{{$clientrs->cmobileno}}"/>
                        </div>
                     </div>
                     <h4><b>Deposit and Cheque details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Deposit Months</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtDepositmonths" class="form-control" value="{{$clientrs->deposit_months}}"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Deposit Amount</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtDepositAmount" class="form-control" value="{{$clientrs->deposit_amount}}"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">No.of Cheque Leaf</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtnCheque" class="form-control" value="{{$clientrs->num_cheque}}"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Total Cheque Amount</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtcAmount" class="form-control" value="{{$clientrs->total_cheque_amount}}"/>
                        </div>
                     </div>
                     
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="panel-body">
                  <h4><b>System Details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Total No. of Systems</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtTotSys" class="form-control" value="{{$clientrs->total_systems}}"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Duration Type</label>
                        <div class="col-md-9 col-xs-12">
                        <select class="form-control select" name="selDurationType">
                            <option value="select">Select</option>
                            <option value="<?php echo $clientrs->duration_type;?>" <?php echo ($clientrs->duration_type) ? ' selected="selected"' : '';?>><?php echo $clientrs->duration_type;?></option>
                            <option value="month">Month</option>
                            <option value="year">Year</option>
                        </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Duration</label>
                        <div class="col-md-9 col-xs-12">
                        <select class="form-control select" name="selDuration">
                            <option value="select">Select</option>
                            <option value="<?php echo $clientrs->duration;?>" <?php echo ($clientrs->duration) ? ' selected="selected"' : '';?>><?php echo $clientrs->duration;?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Start Date</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtDeliveryDate" class="form-control" value="{{$clientrs->start_date}}"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">End Date</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtReturnDate" class="form-control" value="{{$clientrs->end_date}}"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Invoice Date</label>
                        <div class="col-md-9 col-xs-12">
                        <select class="form-control select" name="selInvoiceDate">
                            <option value="select">Select</option>
                            <option value="<?php echo $clientrs->invoice_date;?>" <?php echo ($clientrs->invoice_date) ? ' selected="selected"' : '';?>><?php echo $clientrs->invoice_date;?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                       </div>
                     </div>
                     <h4><b>Additional Details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Comments</label>
                        <div class="col-md-9 col-xs-12">                                            
                           <textarea class="form-control" name="txtComments" rows="3">{{$clientrs->comments}}</textarea>
                        </div>
                     </div>
                     
                     
                  </div>
               </div>
            </div>
            <div class="panel-footer">
               <a href="{{url('admin/clientlist')}}" class="btn btn-success"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>                                                               
               <button type="submit" class="btn btn-primary pull-right">Update</button>
            </div>
         </div>
      </form>
   </div>
</div>
@stop

@endif