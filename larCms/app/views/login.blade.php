@extends('layouts.master')

@section('sidebar')
    @parent
@stop

@section('content')
    <div class="container">
		<div class="row">
		
				<div class="panel-wrapper panel-login">
					@if(isset($data["error"]))
                                            asdasd
                                        @endif    
                                        <div class="panel">
						<div class="title">
							<h4>User Login</h4>
							<!--<div class="option">Sign up for free &raquo;</div>-->
						</div>
						
						<div class="content">
						<!-- ## Panel Content  -->

							{{ Form::open(array('url' => '/login','action' => 'Controller@method')) }}
								<div>
									<input type="text"  name="username" />
								</div>
								
								<div>
									<input type="password" name="password" />
								</div>
								 
								<div>
									<input type="submit" href="#" class="button-blue submit" value="Login" /> 
								</div>
							{{ Form::close() }}
						
						<!-- ## / Panel Content  -->
						</div>
					</div>
					
					<div class="shadow"></div>
				</div>
				
				<div class="login-details">
					<p>Forgot your password? &nbsp;&nbsp;&nbsp;<a href="#">Click here</a></p>
				</div>
				
		</div>	
	</div>
@stop
