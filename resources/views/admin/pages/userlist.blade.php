@if(Auth::user()->user_type =='admin')  

@extends('admin.default')
@section('content')

<div class="col-md-12">
<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">User List</h3>
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>User Name</th>
                  <th>User Type</th>
                  <th>Edit</th>
                  <th>Delete</th>
               </tr>
            </thead>
            <tbody>
            <?php
                  $i=0;
                  ?>
               @foreach ($userrs as $val)
               <tr>
                  <td>{{++$i}}</td>
                  <td>{{ $val->name}}</td>
                  <td>{{ $val->email}}</td>
                  <td>{{$val->username}}</td>
                  <td>{{$val->user_type}}</td>
                  <!-- <td><a href="{{ url('admin/clientview/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <span>View</span></a></td> -->
                  <!-- <td><a href="{{ url('admin/viewclient/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-eye"></i> </a></td> -->
                  <td><a href="#" data-id="{{$val->id}}" data-toggle="modal" class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small edituser" > <i class="fa fa-edit"></i> </a></td>
                  <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i>  </button></td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>

<!-- Add Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <form class="form-horizontal"id="add_form" action="{{url('admin/adduser')}}"  name="vform" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Add User</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel-body">
                       
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Role</label>
                           <div class="col-md-5 col-xs-6">
                                <select class="form-control " name="role" id="role" required="required">
                                    <option value="">Select</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="technician">Technician</option>
                                    <option value="client">Client</option>
                                  
                                </select>
                           </div>
                           
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Name</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="name" id="name" class="form-control" placeholder="First Name" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Email</label>
                           <div class="col-md-5 col-xs-6">
                              <input type="text" name="email" id="email" class="form-control" placeholder="Email" required/>
                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">User Name</label>
                           <div class="col-md-5 col-xs-6">
                              <input type="text" name="username" id="username" class="form-control" placeholder="User Name" required/>
                           </div>
                         
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Password</label>
                           <div class="col-md-5 col-xs-6">
                              <input type="password" name="password" id="password" class="form-control" placeholder="Password" required/>
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

<!-- Edit System Detail Modal -->
<div id="myModal1" class="modal fade" role="dialog">
   <div class="modal-dialog">
   <form class="form-horizontal" action="{{url('admin/updateUser')}}" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
          
            <div class="row">
                  <div class="col-md-12">
                     <div class="panel-body">
                     <input type="hidden" name="id" id="uid" class="form-control"  required/>

                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Role</label>
                           <div class="col-md-5 col-xs-6">
                                <select class="form-control " name="role" id="urole" required="required">
                                    <option value="">Select</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="technician">Technician</option>
                                    <option value="client">Client</option>
                                  
                                </select>
                           </div>
                           
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">First Name</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="name" id="fname" class="form-control"  required/>

                           </div>
                          
                        </div>
                        
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Email</label>
                           <div class="col-md-5 col-xs-6">
                              <input type="text" name="email" id="uemail" class="form-control"  required/>
                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">User Name</label>
                           <div class="col-md-5 col-xs-6">
                              <input type="text" name="username" id="uname" class="form-control"  required/>
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
      var url = "{{ url('admin/deleteuser') }}"+"/"+id;
      //alert(url);
      window.location.href = url;
    });
</script>

<script>
   $(document).on('click','.edituser',function(){
      //alert('clivk');
      //$('#myModal1').modal('show');
      var $this = $(this);
      var id = $this.attr('data-id');
      //alert(id);
      var url = "{{url('admin/getuser')}}"+"/"+id;
              $.ajax({
                 type: 'GET',
                 url: url,
                 success:function(data){
                  console.log(data);
                  // alert(data.service.assigned_to);
                  // alert(data.service.call_attend);
                  $("#uid").val(data.userrs.id);
                  $('#fname').val(data.userrs.name);
                  //$('#lname').val(data.userrs.lastname);
                  $('#uemail').val(data.userrs.email);
                  $('#uname').val(data.userrs.username);
                 $('#urole').val(data.userrs.user_type);
                  // $('#desc1').html(data.system.description);
                  // $('#unitrent1').html(data.system.unit_rent);
   
                  $('#myModal1').modal('show');
                 }
             });
    });
</script>

@stop
@endif