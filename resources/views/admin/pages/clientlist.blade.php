@if(Auth::user()->user_type =='admin')  
@extends('admin.default')
@section('content')


<script src="{{asset('public/admin/js/jquery.table2excel.js')}}"></script>

<div class="col-md-12">
<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">Client List</h3>
      <ul class="panel-controls">
      <!-- <h4><b>Total Income : {{$totincome->totrent}}</b></h4> -->
         <button type="button" class="btn btn-box-tool export" ><b>Export</b><i class="fa fa-upload"></i></button>
         <li style="margin-right:20px"><h4><b>Total Income : {{$totincome->totrent}}</b></h4></li>
            <!-- <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li> -->
      </ul>
   </div>
   <div class="panel-body">
      <div class="table-responsive">
         <table class="table datatable clientlst" id="example">
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>Organisation</th>
                  <th>Contact Person</th>
                  <th>Phone No</th>
                  <th>Email</th>
                  <th>Rental</th>
                  <th>InvoiceDay</th>
                  <th>System</th>
                  <th>View</th>
                  <th>Edit</th>
                  <!-- <th>Delete</th> -->
               </tr>
            </thead>
            <tbody>
               <?php
                  $i=0;
                  ?>
               @foreach ($clientrs as $val)
               <tr>
                  <td>{{++$i}}</td>
                  <td>{{ $val->organisation}}</td>
                  <td>{{ $val->contact_person}}</td>
                  <td>{{ $val->mobileno}}</td>
                  <td>{{ $val->emailid}}</td>
                  <td>{{$amount[$val->id]}}</td>
                  <td>{{ $val->invoice_date}}</td>
                  <td><a href="{{ url('admin/clientview/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <span>View</span></a></td>
                  <td><a href="{{ url('admin/viewclient/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-eye"></i> </a></td>
                  <td><a href="{{ url('admin/editclient/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-edit"></i> </a></td>
                  <!-- <td><button type="button" class="btn btn-gradient-forest waves-effect waves-light m-1 delete" data-id="{{ $val->id }}" > <i class="fa fa fa-trash-o"></i>  </button></td> -->
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
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
<script>
			$(document).on('click','.export',function(){
				$(".clientlst").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "clientlist" + new Date().toISOString().replace(/[\-\:\.]/g, ""),
					fileext: ".xls",
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
				});
			});
		</script>

@stop
@endif