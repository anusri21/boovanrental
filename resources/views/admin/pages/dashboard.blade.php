@extends('admin.default')
@section('content')


                    <div class="row">
                        
                        <div class="col-md-2">
                            
                            <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('admin/clientlist')}}';">
                                    <div class="widget-title">Clients</div>
                                    <div class="widget-int">{{$clientcount}}</div>      
                                <!-- <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div> -->
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                            
                        </div>
                        <div class="col-md-2">
                            
                            <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='{{url('admin/userleadslist')}}';">
                                    <div class="widget-title">New Leads</div>
                                    <div class="widget-int">{{$leadscount}}</div>      
                                <!-- <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div> -->
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                            
                        </div>
                        <div class="col-md-2">
                            
                            <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='#';">
                                     <div class="widget-title">Income</div>
                                    <div class="widget-int">{{$totincome->totrent}}</div>    
                               
                            </div>                            
                          
                            
                        </div>
                        <!-- <div class="col-md-2">
                            
                          
                            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                                    <div class="widget-title">Invoice</div>
                                    <div class="widget-int">3,548</div>             
                                      
                              
                            </div>                            
                            
                            
                        </div>

                        <div class="col-md-2">
                            
                           
                            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                                    <div class="widget-title">Users</div>
                                    <div class="widget-int">3,548</div>     
                             
                            </div>                            
                            
                            
                        </div>
                        <div class="col-md-2">
                            
                            
                            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                                    <div class="widget-title">Service</div>
                                    <div class="widget-int">3,548</div>     
        
                            </div>                            
                           
                            
                        </div> -->
                    </div>
                    <!-- END WIDGETS -->           
   @stop