<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>larCms</title>
		<!-- 1140px Grid styles for IE -->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" /><![endif]-->
                <!-- The 1140px Grid -->
		<link rel="stylesheet" href="/style/1140.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="/style/styles.css" type="text/css" media="screen" />
		<link rel='stylesheet' href='/style/default.css' type='text/css' media='screen' />
                <!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold|PT+Sans+Narrow:regular,bold|Droid+Serif:iamp;v1' rel='stylesheet' type='text/css' />
		<link rel='stylesheet' href='/js/jquery.uniform/uniform.default.css' type='text/css' media='screen' />
        </head>

	<body class="texture">
        @section('headbar')
        
        @show
        
            
        @section('sidebar')
            
        @show
        
        @section ('content')
        
        @stop
        
        @yield('content')
                <script type='text/javascript'>
                    var globalObj = {  
                            @if(array_key_exists("model_set",$data))
                                model :'{{$data["model_set"]}}',
                            @endif
                                ajax_url : '{{$data["ajax_url"]}}',
                    }          
                </script>    
        
        
                <!-- Scripts -->
                <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js?ver=1.6'></script>
		
		
		<!-- Charts -->
		<script type='text/javascript' src='/js/jquery.raphael/raphael-min.js'></script>
		<script type='text/javascript' src='/js/jquery.morris/morris.min.js'></script>
	
		
		<!-- WYSISYG Editor -->
		<script type='text/javascript' src='/js/nicEdit/nicEdit.js'></script>
		
		
		<!-- Forms Elemets -->
		<script type='text/javascript' src='/js/jquery.uniform/jquery.uniform.min.js'></script>
		
		
		<!-- Table sorter -->
		<script type='text/javascript' src='/js/jquery.tablesorter/jquery.tablesorter.min.js'></script>
		<script type='text/javascript' src='/js/table.resizable/resizable.tables.js'></script>
		
		
		<!-- Lightbox - Colorbox -->
		<script type='text/javascript' src='/js/jquery.colorbox/jquery.colorbox-min.js'></script>
		<link rel='stylesheet' href='/js/jquery.colorbox/colorbox.css' type='text/css' media='screen' />
		
		
		<script type='text/javascript' src='/js/custom.js'></script>
			
		
    </body>
</html>