
 @if(Auth::user()->user_type =='admin')  
<ul class="x-navigation">
   <li class="xn-logo">
      <a href="#">Admin</a>
      <a href="#" class="x-navigation-control"></a>
   </li>
   <!-- <li class="xn-profile">
      <a href="#" class="profile-mini">
          <img src="{{asset('public/admin/assets/images/users/avatar.jpg')}}" alt="John Doe"/>
      </a>
      <div class="profile">
          <div class="profile-image">
              <img src="{{asset('public/admin/assets/images/users/avatar.jpg')}}" alt="John Doe"/>
          </div>
          <div class="profile-data">
              <div class="profile-data-name">John Doe</div>
              <div class="profile-data-title">Web Developer/Designer</div>
          </div>
          <div class="profile-controls">
              <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
              <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
          </div>
      </div>                                                                        
      </li> -->
   <li class="xn-title"></li>
   <li class="active">
      <a href="{{url('home')}}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
   </li>
   <li class="xn-openable">
      <a href="#"><span class="fa fa-users"></span> <span class="xn-text">Clients </span></a>
      <ul>
         <li><a href="{{url('admin/addclient')}}"><span class="fa fa-user"></span> Add Client</a></li>
         <li><a href="{{url('admin/clientlist')}}"><span class="fa fa-users"></span> Client List</a></li>
      </ul>
   </li>
   <li >
      <a href="{{url('admin/userlist')}}"><span class="fa fa-user"></span> <span class="xn-text">Users</span></a>
      <!-- <ul>
         <li><a href="{{url('admin/adduser')}}"><span class="fa fa-user"></span> Add User</a></li>
          <li><a href="{{url('admin/userlist')}}"><span class="fa fa-user"></span> User List</a></li>
          
                                
         </ul> -->
   </li>
  
   <li class="xn-openable">
      <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Invoice</span></a>
      <ul>
         <li><a href="{{url('admin/addpermission')}}"><span class="fa fa-user"></span>Add User Permission</a></li>
         <li><a href="{{url('admin/permissionlist')}}"><span class="fa fa-user"></span>User Permission List</a></li>
      </ul>
   </li>
   <li>
      <a href="{{url('admin/userleadslist')}}"><span class="fa fa-cogs"></span> <span class="xn-text">New Leads</span></a>
      <!-- <ul>
         <li><a href="{{url('admin/addpermission')}}"><span class="fa fa-user"></span>Add User Permission</a></li>
         <li><a href="{{url('admin/permissionlist')}}"><span class="fa fa-user"></span>User Permission List</a></li>
      </ul> -->
   </li>
   <li >
      <a href="{{url('admin/amountlist')}}"><span class="fa fa-cogs"></span> <span class="xn-text">Accounts</span></a>
      <!-- <ul>
         <li><a href="{{url('admin/addpermission')}}"><span class="fa fa-user"></span>Add User Permission</a></li>
         <li><a href="{{url('admin/permissionlist')}}"><span class="fa fa-user"></span>User Permission List</a></li>
      </ul> -->
   </li>
   <li class="xn-openable">
      <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Service Call</span></a>
      <ul>
         <li><a href="{{url('admin/addService')}}"><span class="fa fa-user"></span>Add Service</a></li>
         <li><a href="{{url('admin/servicelist')}}"><span class="fa fa-user"></span>Service List</a></li>
      </ul>
   </li>
   <li >
      <a href="{{url('admin/servicetypelist')}}"><span class="fa fa-cogs"></span> <span class="xn-text">Service Type</span></a>
     
   </li>
</ul>
@else

<ul class="x-navigation">
   <li class="xn-logo">
      <a href="index-2.html">Admin</a>
      <a href="#" class="x-navigation-control"></a>
   </li>
   <!-- <li class="xn-profile">
      <a href="#" class="profile-mini">
          <img src="{{asset('public/admin/assets/images/users/avatar.jpg')}}" alt="John Doe"/>
      </a>
      <div class="profile">
          <div class="profile-image">
              <img src="{{asset('public/admin/assets/images/users/avatar.jpg')}}" alt="John Doe"/>
          </div>
          <div class="profile-data">
              <div class="profile-data-name">John Doe</div>
              <div class="profile-data-title">Web Developer/Designer</div>
          </div>
          <div class="profile-controls">
              <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
              <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
          </div>
      </div>                                                                        
      </li> -->
   <li class="xn-title"></li>
   <!-- <li class="active">
      <a href="{{url('home')}}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
   </li> -->
   
   <li class="xn-openable">
      <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Service Call</span></a>
      <ul>
         <li><a href="{{url('admin/addService')}}"><span class="fa fa-user"></span>Add Service</a></li>
         <li><a href="{{url('admin/servicelist')}}"><span class="fa fa-user"></span>Service List</a></li>
      </ul>
   </li>
</ul>
@endif