@extends('layouts.master')


@section('headbar')
   <div id="header-wrapper" class="container">
		<div id="user-account" class="row" >
			<div class="threecol"> <span>Welcome to LarCms</span> </div>
                        <div class="ninecol last"> <a href="{{$data["logout_url"]}}">Logout</a> <span>|</span> <a href="#">My account</a> <span>|</span> <span>Welcome, <strong>{{$data["user_name"]}}</strong></span> </div>
                </div>

		<div id="user-options" class="row">
			<div class="threecol"><a href="dashboard.html"><img class="logo" src="/images/back-logo.png" alt="QuickAdmin" /></a></div>
			<div class="ninecol last fixed">
				
				<ul class="nav-user-options">
					<li><a href="#"><img src="_layout/images/icons/icon-menu-profile.png" alt="Profile Settings" />&nbsp; Profile</a></li>
					<li><a href="#"><img src="_layout/images/icons/icon-menu-messages.png" alt="Messages" />&nbsp; Messages</a></li> 
					<li><a href="#"><img src="_layout/images/icons/icon-menu-tasks.png" alt="Tasks" />&nbsp; Task</a></li>
					<li><a href="#"><img src="_layout/images/icons/icon-menu-users.png" alt="Users" />&nbsp; User list</a></li>
					<li>
						<a href="#"><img src="_layout/images/icons/icon-menu-settings.png" alt="Settings" />&nbsp; Settings <img class="pin" src="_layout/images/back-nav-sub-pin.png" alt="" /></a>
						
						<ul>
							<li class="first"><a href="#">Item number 01</a></li>
							<li><a href="#">Item number 02</a></li>
							<li><a href="#">Item number 03</a></li>
							<li class="last"><a href="#">Item number 04</a></li>
							<li class="pin"></li>
						</ul>
					</li>
				</ul>
				
			</div>
		</div>
	</div>     
        
@stop
 
    
@section('sidebar')
    <div class="row">
		
			<div id="sidebar" class="threecol">
				<ul id="navigation">
                                        @foreach ($data["user_modules"] as $module)
                                            <li class="sub  @if($data["user_modules"][0]->name == $module->name) first @endif">
                                                <a href="#">{{ucfirst(str_replace("_" , " ", $module->name))}}<img src="/images/back-nav-sub-pin.png" alt="" /> <span class="icon-{{$module->icon}}"></span></a>
						<ul>
                                                    @foreach(json_decode($module->sections) as $section=>$cls)
                                                        <li class="no"><a href="{{$module->name}}/{{strtolower($section)}}">{{ucfirst(str_replace("_" , " ", $section))}}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li> 
					@endforeach
				</ul>
			</div>
@stop

@section('content')
    
@stop

    
