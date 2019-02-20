@extends('admin.default')
@section('content')
<?php
//    $totalpay =array();
//    foreach($systmrs as $val)
//    {
//     Print_r($val->total_amount);die;
//        $tot=$val->total_amount;
//        $totalpay[]=$tot;
//    }
//        $totpayment=array_sum($totalpay);
//    Print_r($totpayment);die;
   ?>
<div class="col-md-12">
<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">Service List</h3>
      <div style="padding:10px">
      From: <input type="text" id="txtFromDate" />
      To: <input type="text" id="txtToDate" />
      </div>
      <ul class="panel-controls">
         <a href="{{url('admin/addService')}}"><button type="button" class="btn btn-box-tool" ><b>ADD</b><i class="fa fa-plus-circle"></i></button></a>
         <!-- <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li> -->
      </ul>
   </div>
   <div class="panel-body">
      <div class="table-responsive">
         <table class="table datatable">
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>Client Name</th>
                  <th>Service Description</th>
                  <th>Reported Date</th>
                  <th>Call Attend</th>
                  <th>Assign To</th>
                  <th>View</th>
                  <th>Delete</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $i=0;
                  ?>
               @foreach ($service as $val)
               <tr>
                  <td>{{++$i}}</td>
                  <td>{{ $val->client_name}}</td>
                  <td>{{ $val->service_desc}}</td>
                  <td>{{ $val->reported_date}}</td>
                  <td>{{ $val->callattn}}</td>
                  <td>{{ $val->assignto}}</td>
                  <!-- <td><a href="{{ url('admin/clientview/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <span>View</span></a></td> -->
                  <td><a href="{{ url('admin/viewservice/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-eye"></i> </a></td>
                  <!-- <td><a href="#" data-id="{{$val->id}}" data-toggle="modal" class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small editservice" > <i class="fa fa-edit"></i> </a></td> -->
                  <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i>  </button></td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>



<!-- Edit System Detail Modal -->
<div id="myModal1" class="modal fade" role="dialog">
   <div class="modal-dialog">
   <form class="form-horizontal" action="{{url('admin/saveService')}}" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Edit Service Details</h4>
            </div>
            <div class="modal-body">
          
               <div class="row">
               <div class="col-md-12">
                  <div class="panel-body">
                  <input type="hidden" name="id"  id ="id" class="form-control"/>

                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">ClientName</label>
                        <div class="col-md-9 col-xs-12">
                        
                        <select class="form-control " name="client_name" id="cname" data-live-search="true" >
                        <option value="select">Select</option>
                        @foreach ( $name as $val)
                        <option value="{{$val->id}}">{{$val->client_name}}</option>
                        @endforeach
                        </select>
                        <!-- <input type="text" name="client_name" id="clientname" style='display:none;'/> -->
                        </div>
                     </div>
                     
                     
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">ServiceDesc</label>
                        <div class="col-md-9 col-xs-12">                                            
                           <textarea class="form-control" name="service_desc" id="desc" rows="3"></textarea>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">ReportedDate</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="date" name="reported_date"  id ="repoDate" placeholder="Select Reported Date" class="form-control"/>
                              <p id="demo" ></p>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">CallAttend</label>
                        <div class="col-md-9 col-xs-12">
                           <select class="form-control " name="call_attend" id="clatn">
                           <option value="select">Select</option>
                           @foreach ( $user as $val)
                           <option value="{{$val->id}}">{{$val->firstname}}</option>
                           @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">AssignedTo</label>
                        <div class="col-md-9 col-xs-12">
                           <select class="form-control " name="assigned_to" id="assn">
                           <option value="select">Select</option>
                           @foreach ( $user as $val)
                           <option value="{{$val->id}}">{{$val->firstname}}</option>
                           @endforeach
                           </select>
                        </div>
                     </div>
                     
                  </div>
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




<!-- END DEFAULT DATATABLE -->
<script>
   $(document).on('click','.delete',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      var url = "{{ url('admin/deleteservice') }}"+"/"+id;
      //alert(url);
      window.location.href = url;
    });
</script>

<script>
   $(document).on('click','.editservice',function(){
      //alert('clivk');
      //$('#myModal1').modal('show');
      var $this = $(this);
      var id = $this.attr('data-id');
     // alert(id);
      var url = "{{url('admin/getservice')}}"+"/"+id;
              $.ajax({
                 type: 'GET',
                 url: url,
                 success:function(data){
                  console.log(data);
                  // alert(data.service.assigned_to);
                  // alert(data.service.call_attend);
                  $("#id").val(data.service.id);
                  $('#cname').val(data.service.cid).attr("selected", "selected");
                  $('#desc').html(data.service.service_desc);
                  $('#clatn').val(data.service.call_attend);
                  $('#repoDate').val(data.service.reported_date);
                  $('#assn').val(data.service.assigned_to);
                  // $('#desc1').html(data.system.description);
                  // $('#unitrent1').html(data.system.unit_rent);
   
                  $('#myModal1').modal('show');
                 }
             });
    });
</script>

@stop