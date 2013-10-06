@extends('admin')


@section('content')
<div id="content" class="nicecol last">
    <div class="panel-wrapper">
                                        @if(array_key_exists("users",$data))
						
					<div class="panel">
						<div class="title">
							<h4>{{Common::getCleaned($data["module_active"])}}</h4>
							<div class="collapse">collapse</div>
						</div>
						
						<div class="content">
						<!-- ## Panel Content  -->
						<table id="sample-table-sortable" class="sortable resizable"> 
							<thead> 
								<tr> 
                                                                        @foreach($data["users"]->first()->toArray() as $key_col=>$col)
                                                                            <th>{{Common::getCleaned($key_col)}}</th>
                                                                        @endforeach
                                                                        <th class='lst_th'></th>
                                                                </tr> 
							</thead> 
							<tbody> 
                                                            
                                                            
								@foreach($data["users"] as $user)
                                                                <tr>
                                                                    @foreach($user->toArray() as $key_us => $val_us)
                                                                        <td>{{$val_us}}</td>
                                                                    @endforeach
                                                                        <td class='last_table_td'>
                                                                            <a href='{{$data["basic_admin_url"]}}/users/edit_user/{{$user->id}}'><img src='/images/icons/icon-edit.png' /></a>
                                                                            &nbsp;
                                                                            &nbsp;
                                                                            <a href='' class='delete' row='{{$user->id}}'><img src='/images/icons/icon-delete.png' /></a>
                                                                        </td>
                                                                </tr>
                                                                @endforeach
							</tbody> 
						</table> 
						@endif
						<!-- ## / Panel Content  -->
						</div>
					</div>
					
					
				</div>

    
</div>        

@stop