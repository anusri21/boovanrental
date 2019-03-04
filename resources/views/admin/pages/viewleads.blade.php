@extends('admin.default')
@section('content')
<style>
   input:focus {
   }
</style>
<div class="row">
   <div class="col-md-12">
      <form class="form-horizontal" action="{{url('admin/adduserlead')}}" method="post">
         {{csrf_field() }}
         <div class="panel panel-default">
            <div class="panel-heading">
               <h3 class="panel-title"><a href="{{url('admin/userleadslist')}}" class="btn btn-success"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a><strong>Lead Details</strong> </h3>
               <!-- <ul class="panel-controls">
               </ul> -->
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="panel-body">
                  
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>ClientName:</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$leads->client_name}}</label>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>ContactNumber:</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$leads->contact_number}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Email:</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$leads->contact_email}}</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="panel-body">
                 
                  <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b> Requirements:</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-12 col-xs-12 control-label">{{$leads->requirements}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>Address:</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$leads->client_address}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>EnquiryDate:</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$leads->enquiry_date}}</label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><b>LeadStatus:</b></label>
                        <div class="col-md-9 col-xs-12">
                           <label class="col-md-6 col-xs-12 control-label">{{$leads->leads_status}}</label>
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
@foreach($lead as $val)
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
                           <label class="col-md-8 col-xs-12 control-label">{{$val->leads_status}}</label>
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
         <form class="form-horizontal" action="{{url('admin/addcomments')}}" method="post">
         {{csrf_field() }}
               <div class="col-md-4">
                  <!-- <div class="flash-message">
                        @include('admin.pages.notification')
                  </div> -->
                  <div class="panel-body">
                  <input type="hidden" name="user_id"  value="{{ Auth::user()->id }}"  class="form-control"/>
                  <input type="hidden" name="leads_id"  value="{{Request::segment(3)}}"  class="form-control"/>
                  <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Status</label>
                        <div class="col-md-9 col-xs-12">
                        <select  required="required" name="leads_status" class="form-control">
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
               <a href="{{url('admin/userleadslist')}}" class="btn btn-success"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>                                   
               <!-- <button type="submit" class="btn btn-primary pull-right">Submit</button> -->
            </div>
</div>
<!-- END DEFAULT DATATABLE -->
<script>
   $(document).on('click','.delete',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      var url = "{{ url('admin/deletelead') }}"+"/"+id;
      //alert(url);
      window.location.href = url;
    });
</script>
@stop