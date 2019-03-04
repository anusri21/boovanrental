 

@extends('admin.default')
@section('content')
<div class="row">
   <div class="col-md-12">
      <form class="form-horizontal" action="{{url('admin/saveService')}}" method="post">
         {{csrf_field() }}
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><strong>Add Service</strong> </h3>
               <!-- <ul class="panel-controls">
                  <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                  </ul> -->
            </div>
            <div class="row">
               <div class="col-md-4">
                  <div class="panel-body">
                  <h4><b>Service Details</b></h4>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">ClientName</label>
                        <div class="col-md-9 col-xs-12">
                        
                        <select class="form-control selectpicker" name="client_name"  data-live-search="true" >
                        <option value="select">Select</option>
                        @foreach ( $name as $val)
                        <option value="{{$val->id}}">{{$val->client_name}}</option>
                        @endforeach
                        </select>
                        <!-- <input type="text" name="client_name" id="clientname" style='display:none;'/> -->
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">ServiceType</label>
                        <div class="col-md-9 col-xs-12">                                            
                              <select class="form-control select" name="service_type">
                              <option value="select">Select</option>
                              @foreach ( $type as $val)
                              <option value="{{$val->id}}">{{$val->service_type}}</option>
                              @endforeach
                              </select>                       
                         </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">ServiceDesc</label>
                        <div class="col-md-9 col-xs-12">                                            
                           <textarea class="form-control" name="service_desc" rows="3"></textarea>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">ReportedDate</label>
                        <div class="col-md-9 col-xs-12">
                              <input type="date" name="reported_date"  id ="myDate"  class="form-control"/>
                              <p id="demo" ></p>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">CallAttend</label>
                        <div class="col-md-9 col-xs-12">
                        <select class="form-control select" name="call_attend">
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
                        <select class="form-control select" name="assigned_to">
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
            <div class="panel-footer">
               <button class="btn btn-default">Clear Form</button>                                    
               <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
         </div>
      </form>
   </div>
</div>
<script>
$('select').selectpicker();
</script>

<script>
function myFunction() {
  var x = document.getElementById("myDate").value;
  document.getElementById("demo").innerHTML = x;
}
</script>
<!-- <script type="text/javascript">
function CheckName(val){
 var element=document.getElementById('clientname');
 if(val=='pick a name'||val=='others')
   element.style.display='block';
 else  
   element.style.display='none';
}

</script>  -->

@stop
