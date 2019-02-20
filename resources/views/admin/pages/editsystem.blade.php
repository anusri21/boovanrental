@if(Auth::user()->user_type =='admin')  

@extends('admin.default')
@section('content')
<div class="row">
   <div class="col-md-12">
      <form class="form-horizontal"id="add_form" action="{{url('admin/editsystemdetails')}}"  name="vform" method="post">
         {{csrf_field() }}
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><strong>Edit System Details</strong> </h3>
               <!-- <ul class="panel-controls">
                  <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                  </ul> -->
            </div>
            
            <div class="row">
                     <div class="flash-message">
                              @include('admin.pages.notification')
                        </div>
               <div class="col-md-6">
                  <div class="panel-body">
                  <input type="hidden" name="id" value="{{ $sysdetail->id }}" class="form-control" />

                  <input type="hidden" name="cId" value="{{ $sysdetail->client_id }}" class="form-control" />
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">System Vendor</label>
                        <div class="col-md-9 col-xs-12">
                           <select id="select" class="form-control"  name="txtSysVendor"  required="required">
                                 <option value="">Select</option>
                                 <option value="<?php echo $sysdetail->rental_vendor;?>" <?php echo ($sysdetail->rental_vendor) ? ' selected="selected"' : '';?>><?php echo $sysdetail->rental_vendor;?></option>
                                 @foreach($vendor as $val)
                                 <option value="{{$val->vendor_name}}">{{$val->vendor_name}}</option>
                                 @endforeach
                              </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">System Type</label>
                        <div class="col-md-9 col-xs-12">
                        <select class="form-control " name="txtSysType" id="duration_type" required="required">
                                 <option value="">Select</option>
                                 <option value="<?php echo $sysdetail->system_type;?>" <?php echo ($sysdetail->system_type) ? ' selected="selected"' : '';?>><?php echo $sysdetail->system_type;?></option>
                                 @foreach($type as $val)
                                 <option value="{{$val->system_type}}">{{$val->system_type}}</option>
                                 @endforeach
                              </select>                        </div>
                        <div id="errororganisation"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Short Description</label>
                        <div class="col-md-9 col-xs-12">                                            
                        <input type="text" name="txtShortDes" id="client_name" value="{{ $sysdetail->short_description }}"  class="form-control" required/>
                        </div>
                        <div id="erroraddress"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Qty</label>
                        <div class="col-md-9 col-xs-12">
                        <input type="text" name="txtQty" id="client_name" value="{{ $sysdetail->system_qty }}"  class="form-control" required/>
                        </div>
                        <div id="erroremail"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Unit Rent</label>
                        <div class="col-md-9 col-xs-12">
                        <input type="text" name="txtUnitRent" id="client_name"  value="{{ $sysdetail->unit_rent }}" class="form-control" required/>
                        </div>
                        <div id="errormobile"></div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Description</label>
                        <div class="col-md-9 col-xs-12">
                        <textarea class="form-control" name="txtDes" id="address" rows="3" required>{{ $sysdetail->description }}</textarea>
                        </div>
                        <div id="errorlandline"></div>
                     </div>
                     
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