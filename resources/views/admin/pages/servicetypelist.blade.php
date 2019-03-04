
@extends('admin.default')
@section('content')

<div class="col-md-12">
<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">ServiceType List</h3>
      <ul class="panel-controls">
         <a href="#"><button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModal"><b>ADD</b><i class="fa fa-plus-circle"></i></button></a>
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
                  <th>ServiceType</>
                  <th>Edit</th>
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
                  <td>{{ $val->service_type}}</td>
                  

                  <!-- <td><a href="{{ url('admin/clientview/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <span>View</span></a></td> -->
                  <!-- <td><a href="{{ url('admin/viewclient/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-eye"></i> </a></td> -->

                  <td><a href="#" data-id="{{$val->id}}" data-toggle="modal" class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small editservice" > <i class="fa fa-edit"></i> </a></td>
                  <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i>  </button></td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <form class="form-horizontal"id="add_form" action="{{url('admin/addservicetype')}}"  name="vform" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Add ServicetypeDetails</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel-body">
                       
                       
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Servicetype</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="service_type"  class="form-control" placeholder="" required/>

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
<div id="editModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <form class="form-horizontal"id="add_form" action="{{url('admin/addservicetype')}}"  name="vform" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Edit ServicetypeDetails</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel-body">
                     <input type="hidden" name="id"  id="id" class="form-control" placeholder="" required/>

                       
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">ServiceType</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="service_type"  id="st" class="form-control" placeholder="" required/>

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
<script>
   $(document).on('click','.editservice',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      //alert(id);
      var url = "{{url('admin/editservicetype')}}"+"/"+id;
              $.ajax({
                 type: 'GET',
                 url: url,
                 success:function(data){
                  console.log(data);
                  $('#id').val(data.system.id);
                  $('#st').val(data.system.service_type);
                  
                 
   
                  $('#editModal').modal('show');
                 }
             });
    });
</script>
<script>
   $(document).on('click','.delete',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      var url = "{{ url('admin/deleteservicetype') }}"+"/"+id;
      //alert(id);
      window.location.href = url;
    });
</script>

@stop