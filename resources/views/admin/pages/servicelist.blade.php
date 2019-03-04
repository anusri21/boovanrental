@extends('admin.default')
@section('content')
<style>
[type="date"] {
  background:#fff url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
}
[type="date"]::-webkit-inner-spin-button {
  display: none;
}
[type="date"]::-webkit-calendar-picker-indicator {
  opacity: 0;
}


label {
  display: block;
}
input,select {
  border: 1px solid #c4c4c4;
  border-radius: 5px;
  background-color: #fff;
  padding: 3px 5px;
  box-shadow: inset 0 3px 6px rgba(0,0,0,0.1);
  width: 150px;
}
</style>
<div class="col-md-12">
<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">Service List</h3>
      <ul class="panel-controls">
            <form action="#" method="post" id="filterform">
            {{csrf_field() }}
               From: <input type="date" name="from_date" value="{{ @$_GET['sdate']}}" id="from_date" >
               To: <input type="date" name="end_date" value="{{ @$_GET['ldate']}}"  id="end_date" />
               Assign:<select name="assign" id="assign" >
                        <option value="select">Select</option>                        
                        @foreach ( $assrole as $val)
                        <option value="{{$val->id}}" <?php echo (@$_GET['assign'] == $val->id ) ? ' selected="selected"' : '';?>>{{$val->name}}</option>
                        @endforeach
                     </select>
               
               <button type="button"  class="btn btn-info filter" style="margin-right:90px;margin-left:40px">Search</button>
               <a href="{{url('admin/servicelist')}}" class="btn btn-primary filter" style="margin-right:90px;">Reset</a>
          
            <a href="{{url('admin/addService')}}"><button type="button" class="btn btn-box-tool" ><b>ADD</b><i class="fa fa-plus-circle"></i></button></a>
      </ul>
      </form>
   </div>
   <div class="panel-body">
      <div id="onload">
      <div class="table-responsive">
         <table class="table datatable">
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>Client Name</th>
                  <th>Service Type</th>
                  <th>Reported Date</th>
                  <th>Call Attend</th>
                  <th>Assign To</th>
                  <th>Service Status</th>
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
                  <td>{{ $val->service_type}}</td>
                  <td>{{ $val->reported_date}}</td>
                  <td>{{ $val->callattn}}</td>
                  <td>{{ $val->assignto}}</td>
                
                  <td>{{ $val->service_status}}</td>
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
                        @foreach ( $assrole as $val)
                        <option value="{{$val->id}}">{{$val->name}}</option>
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
$( document ).ready(function() {
  alert('inside');
   $('#filterres').hide();
   $('#onload').show();
});
</script>

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

<script>
         $(function() {
            $( "#datepicker-13" ).datepicker();
            $( "#datepicker-13" ).datepicker("show");
         });
      </script>


<!-- <script>
   $(document).on('click','.filter',function(){
    
    var formData= $('#filterform').serializeArray();
    //console.log($formdata);
      var url = "{{url('admin/filterService')}}";
              $.ajax({
                 type: 'POST',
                 url: url,
                 data: formData,
                 success:function(data){
                  console.log(data);
                  var len=data.filter.length;
                //alert(len);
                  $('#onload').hide();
                  $('filterres').show();
                var s= "";
                       for(i=0; i<len; i++){
   
                         //url = "{{ asset('public/pdf') }}"+"/"+data.pdf[i].pdf_path;
                         viewurl ="{{ url('admin/viewservice') }}"+"/"+data.filter[i].id;
                         console.log()
                           s+='<tr><th >'+ (parseInt(i)+1) +'</th><td>'+data.filter[i].client_name+'</td><td>'+data.filter[i].service_desc+'</td><td>'+data.filter[i].reported_date+'</td><td>'+data.filter[i].call_attend+'</td><td>'+data.filter[i].assignto+'</td>\
                           <td><a href='+viewurl+'  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" ><i class="fa fa-eye"></i></a></td><td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id='+data.filter[i].id+' ><i class="fa fa fa-trash-o"></i></button></td></tr>';
                       }
                       document.getElementById("frec").innerHTML=s;
                       //datatable();
              }
             });
    });
</script> -->

<script>
   $(document).on('click','.filter',function(){
      sdate = $('#from_date').val();
      ldate = $('#end_date').val();
      assign = $('#assign option:selected').val(); 
      var url = "{{ url('admin/servicelist') }}"+"/?sdate="+sdate+'&ldate='+ldate+'&assign='+assign;
      console.log(url);
      window.location.href = url;
    
    });
</script>

@stop