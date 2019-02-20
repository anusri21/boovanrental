@if(Auth::user()->user_type =='admin')  

@extends('admin.default')
@section('content')
<div class="col-md-12">
<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
   <div class="panel-heading">
      <?php
         $totalpay =array();
         foreach($clientrs as $val)
         {
            $tot=$val->total_amount;
             $totalpay[]=$tot;
         }
             $totpayment=array_sum($totalpay);
         
         ?>
      <h3 class="panel-title">Client Name:{{$cname}}</h3>
      <ul class="panel-controls">
         <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><b>ADD</b><i class="fa fa-plus-circle"></i></button>
         <li>
            <h5>Total Payment: <?php echo $totpayment; ?></h5>
         </li>
         <!-- <li><a href="#" class="btn btn-success"><span class="fa fa-plus-square"></span></a></li>
            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li> -->
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
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $i=0;
                  ?>
               @foreach ($clientrs as $val)
               <tr>
                  <td>{{++$i}}</td>
                  <td>{{ $val->system_type}}</td>
                  <td>{{ $val->rental_vendor}}</td>
                  <td>{{$val->system_qty}}</td>
                  <td>{{ $val->unit_rent}}</td>
                  <td>{{ $val->total_amount}}</td>
                  <td>{{ $val->last_update_date}}</td>
                  <td><a href="#"  data-id="{{$val->id}}" data-toggle="modal"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small sysview" > <i class="fa fa-eye"></i> </a></td>
                  <td><a href="#"  data-id="{{$val->id}}" class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small sysedit" data-toggle="modal" > <i class="fa fa-edit"></i> </a></td>
                  <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i>  </button></td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
   <div class="panel-footer">
      <a href="{{url('admin/clientlist')}}" class="btn btn-success"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>                                                               
      <!-- <button type="submit" class="btn btn-primary pull-right">Update</button> -->
   </div>
</div>
<!-- END DEFAULT DATATABLE -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <form class="form-horizontal"id="add_form" action="{{url('admin/addsystemdetails/'.Request::segment(3))}}"  name="vform" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Add System Details</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="panel-body">
                        <input type="hidden" name="cId" val="{{ Request::segment(3) }}" class="form-control" />
                        <div class="form-group">
                           <label class="col-md-5 col-xs-12 control-label">System Vendor</label>
                           <div class="col-md-12 col-xs-12">
                              <!-- <select class="form-control " name="selDurationType" id="duration_type" required="required">
                                 <option value="select">Select</option>
                                 @foreach($vendor as $val)
                                 <option value="{{$val->id}}">{{$val->vendor_name}}</option>
                                 @endforeach
                                 </select> -->
                              <select id="select" class="form-control"  name="txtSysVendor"  required="required">
                                 <option value="">Select</option>
                                 @foreach($vendor as $val)
                                 <option value="{{$val->vendor_name}}">{{$val->vendor_name}}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div id="errorclient_name"></div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-5 col-xs-12 control-label">System Type</label>
                           <div class="col-md-12 col-xs-12">
                              <select class="form-control " name="txtSysType" id="duration_type" required="required">
                                 <option value="">Select</option>
                                 @foreach($type as $val)
                                 <option value="{{$val->system_type}}">{{$val->system_type}}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div id="errorclient_name"></div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-6 col-xs-12 control-label">Short Description</label>
                           <div class="col-md-12 col-xs-12">
                              <input type="text" name="txtShortDes" id="client_name" class="form-control" required/>
                           </div>
                           <div id="errorclient_name"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="panel-body">
                        <div class="form-group">
                           <label class="col-md-4 col-xs-12 control-label">Serial No</label>
                           <div class="col-md-12 col-xs-12">
                              <input type="text" name="txtSerial" id="client_name" class="form-control" required/>
                           </div>
                           <div id="errorclient_name"></div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 col-xs-12 control-label">Qty</label>
                           <div class="col-md-12 col-xs-12">
                              <input type="text" name="txtQty" id="client_name" class="form-control" required/>
                           </div>
                           <div id="errorclient_name"></div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-12 control-label">Unit Rent</label>
                           <div class="col-md-12 col-xs-12">
                              <input type="text" name="txtUnitRent" id="client_name" class="form-control" required/>
                           </div>
                           <div id="errorclient_name"></div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-md-2 col-xs-12 control-label">Description</label>
                     <div class="col-md-12 col-xs-12">                                            
                        <textarea class="form-control" name="txtDes" id="address" rows="3" required></textarea>
                     </div>
                     <div id="erroraddress"></div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success addclient" datafrm="add_form">Submit</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- Sys Modal -->
<div id="sysModal" class="modal fade" role="dialog">
<div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">System Details</h4>
      </div>
      <div class="modal-body">
      <div class="row">
               <div class="col-md-12">
                  <div class="panel-body">
                     <div class="form-group">
                        <label class="col-md-6 col-xs-12 control-label"><b>System Vendor</b></label>
                        <div class="col-md-6 col-xs-12">
                           <label class="col-md-5 col-xs-12 control-label" id="sysvendor"></label>
                        </div>
                     </div>
                     <br>
                     <div class="form-group">
                        <label class="col-md-6 col-xs-12 control-label"><b>System Type</b></label>
                        <div class="col-md-6 col-xs-12">
                           <label class="col-md-5 col-xs-12 control-label" id="systype"></label>
                        </div>
                     </div>
                     <br>
                     <div class="form-group">
                        <label class="col-md-6 col-xs-12 control-label"><b>Qty</b></label>
                        <div class="col-md-6 col-xs-12">
                           <label class="col-md-5 col-xs-12 control-label" id="qty"></label>
                        </div>
                     </div>
                     <br>
                     <div class="form-group">
                        <label class="col-md-6 col-xs-12 control-label"><b>Unit Rent</b></label>
                        <div class="col-md-6 col-xs-12">
                           <label class="col-md-5 col-xs-12 control-label" id="unitrent"></label>
                        </div>
                     </div>
                     <br>
                     <div class="form-group">
                        <label class="col-md-6 col-xs-12 control-label"><b>Total Amount</b></label>
                        <div class="col-md-6 col-xs-12">
                           <label class="col-md-5 col-xs-12 control-label" id="total"></label>
                        </div>
                     </div>
                     <br>
                     <div class="form-group">
                        <label class="col-md-6 col-xs-12 control-label"><b>Short Description</b></label>
                        <div class="col-md-6 col-xs-12">
                           <label class="col-md-5 col-xs-12 control-label" id="sdesc"></label>
                        </div>
                     </div>
                     <br>
                     <div class="form-group">
                        <label class="col-md-6 col-xs-12 control-label"><b>Description</b></label>
                        <div class="col-md-6 col-xs-12">
                           <label class="col-md-5 col-xs-12 control-label" id="desc"></label>
                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<!-- Edit System Detail Modal -->
<div id="GSCCModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script>
   $(document).on('click','.sysview',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      //alert(id);
      var url = "{{url('admin/viewsystemdetl')}}"+"/"+id;
              $.ajax({
                 type: 'GET',
                 url: url,
                 success:function(data){
                  console.log(data);
                  
                  $('#sysvendor').html(data.system.rental_vendor);
                  $('#systype').html(data.system.system_type);
                  $('#sdesc').html(data.system.short_description);
                  $('#qty').html(data.system.system_qty);
                  $('#total').html(data.system.total_amount);
                  $('#desc').html(data.system.description);
                  $('#unitrent').html(data.system.unit_rent);
   
                  $('#sysModal').modal('show');
                 }
             });
    });
</script>


<script>
   $(document).on('click','.delete',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      var url = "{{ url('admin/deletesystem') }}"+"/"+id;
      //alert(id);
      window.location.href = url;
    });
</script>


<script>
   $(document).on('click','.sysedit',function(){
     
      var $this = $(this);
      var id = $this.attr('data-id');
      var url = "{{ url('admin/getsysedit') }}"+"/"+id;
      //alert(id);
      window.location.href = url;
      
    });
</script>
@stop

@endif