@extends('admin.default')
@section('content')

<div class="col-md-12">
<!-- START DEFAULT DATATABLE -->
<div class="panel panel-default">
   <div class="panel-heading">
      <h3 class="panel-title">Amount List</h3>
      <ul class="panel-controls">
         <a href="#"><button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModal"><b>ADD</b><i class="fa fa-plus-circle"></i></button></a>
            @if(($totincome->income)!='')
            <li style="margin-right:20px"><h5><b>Income :</b> {{$totincome->income}}</h5></li>
            @else
            <li style="margin-right:20px"><h5><b>Income :</b> 0</h5></li>
            @endif
            @if(($totincome->income)!='')
            <li style="margin-right:20px"><h5><b>Expense :</b> {{$totexpense->expense}}</h5></li>
            @else
            <li style="margin-right:20px"><h5><b>Expense :</b> 0</h5></li>
            @endif
            <li style="margin-right:20px"><h5><b>Balance :</b> {{$balance}}</h5></li>
      </ul>
   </div>
   <div class="panel-body">
      <div class="table-responsive">
         <table class="table datatable">
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>Description</th>
                  <th>Invoice To</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Transaction Type</th>
                  <th>Edit</th>
                  <th>Delete</th>
               </tr>
            </thead>
            <tbody>
            <?php
                  $i=0;
                  ?>
               @foreach ($amount as $val)
               <tr>
                  <td>{{++$i}}</td>
                  <td>{{ $val->description}}</td>
                  <td>{{ $val->invoice_vendor}}</td>
                  <td>{{$val->expense_date}}</td>
                  <td>{{$val->entry_amount}}</td>
                  <td>{{$val->cash_type}}</td>
                  <!-- <td><a href="{{ url('admin/clientview/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <span>View</span></a></td> -->
                  <!-- <td><a href="{{ url('admin/viewclient/'.$val->id) }}"  class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small" > <i class="fa fa-eye"></i> </a></td> -->
                  <td><a href="#" data-id="{{$val->id}}" data-toggle="modal" class="btn btn-gradient-ibiza waves-effect waves-light m-1 .btn-small editamount" > <i class="fa fa-edit"></i> </a></td>
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
      <form class="form-horizontal"id="add_form" action="{{url('admin/addamount')}}"  name="vform" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Add UserAmountDetails</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel-body">
                       
                       
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Entry Date</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="date" name="expense_date"  class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Invoice Vendor</label>
                           <div class="col-md-5 col-xs-6">
                           <select id="select" class="form-control"  name="invoice_vendor"  required="required">
                                 <option value="">Select</option>
                                 @foreach($vendor as $val)
                                 <option value="{{$val->vendor_name}}">{{$val->vendor_name}}</option>
                                 @endforeach
                              </select>
                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Entry Type</label>
                           <div class="col-md-5 col-xs-6">
                           <select class="form-control " name="expense_type"  required="required">
                                    <option value="">Select</option>
                                    <option value="rentalincome">RentalIncome</option>
                                    <option value="general">General</option>
                                </select>
                           </div>
                         
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Entry Category</label>
                           <div class="col-md-5 col-xs-6">
                           <select class="form-control " name="cash_type"  required="required">
                                    <option value="">Select</option>
                                    <option value="credit">credit</option>
                                    <option value="debit">debit</option>
                                </select>
                           </div>
                           
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Description</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="description"  class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Payment Type</label>
                           <div class="col-md-5 col-xs-6">
                           <select class="form-control " name="payment_type"  required="required">
                                    <option value="">Select</option>
                                    <option value="cash">cash</option>
                                    <option value="cheque">Cheque</option>
                                </select>
                           </div>
                           
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Amount</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="entry_amount"  class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Voucher/Cheque No:</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="voucher_no"  class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Person</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="voucher_person"  class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Payment Remarks</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <textarea name="payment_remarks"  class="form-control" placeholder="" required></textarea>

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
      <form class="form-horizontal"id="add_form" action="{{url('admin/addamount')}}"  name="vform" method="post">
         {{csrf_field() }}
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Edit UserAmountDetails</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="panel-body">
                     <input type="hidden" name="id"  id="id" class="form-control" placeholder="" required/>

                       
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Entry Date</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="expense_date"  id="ed" class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Invoice Vendor</label>
                           <div class="col-md-5 col-xs-6">
                                <select id="select" class="form-control"  name="invoice_vendor"  required="required">
                                 <option value="">Select</option>
                                 @foreach($vendor as $val)
                                 <option value="{{$val->vendor_name}}">{{$val->vendor_name}}</option>
                                 @endforeach
                              </select>
                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Entry Type</label>
                           <div class="col-md-5 col-xs-6">
                           <select class="form-control " name="expense_type" id="et" required="required">
                                    <option value="">Select</option>
                                    <option value="rentalincome">RentalIncome</option>
                                    <option value="general">General</option>
                                </select>
                           </div>
                         
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Entry Category</label>
                           <div class="col-md-5 col-xs-6">
                           <select class="form-control " name="cash_type" id="ec" required="required">
                                    <option value="">Select</option>
                                    <option value="credit">credit</option>
                                    <option value="debit">debit</option>
                                </select>
                           </div>
                           
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Description</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="description" id="des" class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Payment Type</label>
                           <div class="col-md-5 col-xs-6">
                           <select class="form-control " name="payment_type" id="pt"  required="required">
                                    <option value="">Select</option>
                                    <option value="cash">cash</option>
                                    <option value="cheque">Cheque</option>
                                </select>
                           </div>
                           
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Amount</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="entry_amount" id="am" class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Voucher/Cheque No:</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="voucher_no" id="vn" class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Person</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <input type="text" name="voucher_person" id="per" class="form-control" placeholder="" required/>

                           </div>
                          
                        </div>
                        <div class="form-group">
                           <label class="col-md-4 col-xs-6 control-label">Payment Remarks</label>
                           <div class="col-md-5 col-xs-6">
                            
                           <textarea name="payment_remarks" id="pr" class="form-control" placeholder="" required></textarea>

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
   $(document).on('click','.editamount',function(){
     //alert('alert');
      var $this = $(this);
      var id = $this.attr('data-id');
      //alert(id);
      var url = "{{url('admin/editamount')}}"+"/"+id;
              $.ajax({
                 type: 'GET',
                 url: url,
                 success:function(data){
                  console.log(data);
                  $('#id').val(data.system.id);
                  $('#ed').val(data.system.expense_date);
                  $('#iv').val(data.system.invoice_vendor);
                  $('#et').val(data.system.expense_type);
                  $('#ec').val(data.system.cash_type);
                  $('#des').val(data.system.description);
                  $('#pt').val(data.system.payment_type);
                  $('#am').val(data.system.entry_amount);
                  $('#vn').val(data.system.voucher_no);
                 $('#per').val(data.system.voucher_person);
                  $('#pr').val(data.system.payment_remarks);
                 
   
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
      var url = "{{ url('admin/deleteamount') }}"+"/"+id;
      //alert(id);
      window.location.href = url;
    });
</script>
@stop