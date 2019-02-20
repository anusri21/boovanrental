@if(Auth::user()->user_type =='admin')  

@extends('admin.default')
@section('content')
<div class="row">
   <div class="col-md-12">
      <form class="form-horizontal"id="add_form" action="{{url('admin/addclient')}}" onsubmit="return Validate()" name="vform" method="post">
         {{csrf_field() }}
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><strong>Add Client</strong> </h3>
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
                  <h4><b>Client Details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Client ID</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtClientId" value="{{$clientid}}" readonly="readonly"  class="form-control"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Client Name</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtClientName" id="client_name" class="form-control" required/>
                        </div>
                        <div id="errorclient_name"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Organisation</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtOrg" id="organisation" class="form-control" required/>
                        </div>
                        <div id="errororganisation"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Address</label>
                        <div class="col-md-9 col-xs-12">                                            
                           <textarea class="form-control" name="txtAddress" id="address" rows="3" required></textarea>
                        </div>
                        <div id="erroraddress"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Email</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="email" name="txtEmail" class="form-control" id="email" required/>
                        </div>
                        <div id="erroremail"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Mobile</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtMobile" class="form-control" id="mobile" required/>
                        </div>
                        <div id="errormobile"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Land Line</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtLandLine" class="form-control" id="landline" required/>
                        </div>
                        <div id="errorlandline"></div>
                     </div>
                     
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="panel-body">
                  <h4><b>Contact Person</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Name</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtContactPerson" class="form-control"  id="contact_name" required/>
                        </div>
                        <div id="errorcontact_name"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Email</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="email" name="txtcEmail" class="form-control" name="contact_email" required/>
                        </div>
                        <div id="errorcontact_email"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Phone</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtcMobile" class="form-control" id="contact_mob" required/>
                        </div>
                        <div id="errorcontact_mob"></div>
                     </div>
                     <h4><b>Deposit and Cheque details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Deposit Months</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtDepositmonths" class="form-control" id="dep_month" required/>
                        </div>
                        <div id="errordep_month"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Deposit Amount</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtDepositAmount" class="form-control" id="dep_amt" required/>
                        </div>
                        <div id="errordep_amt"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">No.of Cheque Leaf</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtnCheque" class="form-control" id="cheq" required/>
                        </div>
                        <div id="errorcheq"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Total Cheque Amount</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtcAmount" class="form-control" id="totcheq" required/>
                        </div>
                        <div id="errortotcheq"></div>
                     </div>
                     
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="panel-body">
                  <h4><b>System Details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Total No. of Systems</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="text" name="txtTotSys" class="form-control" id="totsys" required/>
                        </div>
                        <div id="errortotsys"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Duration Type</label>
                        <div class="col-md-9 col-xs-12">
                        <select  required="required" name="selDurationType" class="form-control">
                           <option value="">--Select Duration Type--</option>
                           <option value="month">Month</option>
                            <option value="year">Year</option>
                        </select>
                        </div>
                        <div id="errorduration_type"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Duration</label>
                        <div class="col-md-9 col-xs-12">
                        <select  required="required" name="selDuration" class="form-control">
                           <option value="">--Select Duration--</option>
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
                        <div id="errorduration"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Start Date</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="date" name="txtDeliveryDate" class="form-control" id="start_date" required/>
                        </div>
                        <div id="errorstart_date"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">End Date</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="date" name="txtReturnDate" class="form-control" id="end_date" required/>
                        </div>
                        <div id="errorend_date"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Invoice Date</label>
                        <div class="col-md-9 col-xs-12">
                        
                        <select  required="required" name="selInvoiceDate" class="form-control">
                           <option value="">--Select Duration Type--</option>
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
                        <div id="errorinvoice"></div>
                     </div>
                     <h4><b>Additional Details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Comments</label>
                        <div class="col-md-9 col-xs-12">                                            
                           <textarea class="form-control" name="txtComments" rows="3" id="comments" required></textarea>
                        </div>
                     </div>
                     <div id="errorcomments"></div>
                     
                  </div>
               </div>
            </div>
            <div class="panel-footer">
               <button class="btn btn-default">Clear Form</button>                                    
               <button type="submit" class="btn btn-primary pull-right addclient" datafrm="add_form">Submit</button>
            </div>
         </div>
      </form>
   </div>
</div>



@stop
@endif