  

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
               <h3 class="panel-title"><a href="{{url('admin/servicelist')}}" class="btn btn-success"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a><strong>Service Details</strong> </h3>
               <!-- <ul class="panel-controls">
               </ul> -->
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="panel-body">
                  
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Client Name</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$service->client_name}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Reported Date</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$service->reported_date}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Description</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$service->service_desc}}</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="panel-body">
                 
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Call Attend</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$service->callattn}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Assign To</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$service->assignto}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Status</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$service->service_status}}</label>
                        </div>
                     </div>
                     
                    
                  </div>
               </div>
               
            </div>
            
         </div>
      </form>
   </div>
</div>

<div class="row">
@foreach($cmnts as $val)
   <div class="col-md-6">
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><strong>Service Comments</strong> </h3>
              
              
              <?php
                  $date= $val->created_at;
                  $splits =  explode(" ",$date);
                  $get_date = $splits[0];
                  //echo $get_date;die;
              
              ?>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="panel-body">
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Date</b></label>
                        <div class="col-md-12 col-xs-12">
                           <label class="col-md-12 col-xs-12 control-label"><?php echo $get_date;?></label>
                        </div>
                     </div>
      
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Comments</b></label>
                        <div class="col-md-12 col-xs-12">
                           <label class="col-md-12 col-xs-12 control-label">{{$val->comments}}</label>
                        </div>
                     </div>                         
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="panel-body">
                  <div class="form-group">
                        <label class="col-md-6 col-xs-12 control-label"><b>Service Status</b></label>
                        <div class="col-md-12 col-xs-12">
                           <label class="col-md-8 col-xs-12 control-label">{{$val->service_status}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Technician</b></label>
                        <div class="col-md-12 col-xs-12">
                           <label class="col-md-12 col-xs-12 control-label">{{$val->name}}</label>
                        </div>
                     </div>
                     
                    
                  </div>
               </div>
            </div>
            
         </div>
   </div>
   @endforeach
   
</div>


<div class="col-md-12">
<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
   <div class="panel-heading">

   
      <h3 class="panel-title"><strong>Add Comments</strong> </h3>
      <ul class="panel-controls">
                                    
        
      </ul>                                 
   </div>
   <div class="panel-body">
      <div class="table-responsive">
      <div class="row">
         <form class="form-horizontal" action="{{url('admin/savecomments')}}" method="post">
         {{csrf_field() }}
               <div class="col-md-4">
                  <!-- <div class="flash-message">
                        @include('admin.pages.notification')
                  </div> -->
                  <div class="panel-body">
                  <input type="hidden" name="user_id"  value="{{ Auth::user()->id }}"  class="form-control"/>
                  <input type="hidden" name="service_id"  value="{{Request::segment(3)}}"  class="form-control"/>
                  <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Status</label>
                        <div class="col-md-9 col-xs-12">
                        <select  required="required" name="service_status" class="form-control">
                           <option value="">--Select Status--</option>
                           <option value="open">Open</option>
                            <option value="inprogress">Inprogress</option>
                            <option value="completed">Completed</option>
                            <option value="hold">Hold</option>
                        </select>
                        
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Comments</label>
                        <div class="col-md-9 col-xs-12">
                        <textarea class="form-control" name="comments" rows="3"></textarea>
                        
                        </div>
                     </div>
                     
                     <br> 
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"></label>
                        <div class="col-md-9 col-xs-12">                                            
                        <button type="submit" class="btn btn-primary ">Save</button>
                        </div>
                     </div>
                     
                     
                  </div>
               </div>
            </form>
            </div>
            
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
