<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<head>
    
    <!-- Meta Tag -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO -->
    <meta name="description" content="150 words">
    <meta name="author" content="uipasta">
    <meta name="url" content="http://www.yourdomainname.com">
    <meta name="copyright" content="company name">
    <meta name="robots" content="index,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @yield('title')
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="resources/assets/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" type="image/x-icon" href="images/favicon/apple-touch-icon.png">
    
    <!-- All CSS Plugins -->
    <link href="{{asset('public/css/plugin.css')}}" rel="stylesheet" type="text/css">
    
    <!-- Main CSS Stylesheet -->
    <link href="{{asset('public/css/style.css')}}" rel="stylesheet" type="text/css">
    
    <!-- Google Web Fonts  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700">
    
    
    <!-- HTML5 shiv and Respond.js support IE8 or Older for HTML5 elements and media queries -->
    <!--[if lt IE 9]>
	   <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	   <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('page_styles')

  </head>
  <body>

	
     
	 <!-- Preloader Start 
     <div class="preloader">
	   <div class="rounder"></div>
      </div>
 Preloader End -->
      
      
    
    
    <div id="main">
        <div class="container-fluid">
            <div class="row">
    @include('includes.sidebar')

    <!-- Blog Post (Right Sidebar) Start -->
                 <div class="col-md-9">
                    <div class="col-md-12 page-body">
                    	<div class="row">
                    		
                            @yield('page_heading')
                            @yield('action_buttons')
                            
                            <div class="col-md-12 content-page">
                            	@yield('content')

                                @yield('loadPosts')
                           	</div>
                        </div>
                    </div>
        					@include('includes.footer')
        		</div>
        </div>
         </div>
      </div>
      <!-- Back to Top Start -->
    <a href="#" class="scroll-to-top"><i class="fa fa-long-arrow-up"></i></a>
    <!-- Back to Top End -->

    <!-- All Javascript Plugins  -->
    <script src="{{asset('public/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/js/plugin.js')}}"></script>

    
    <!-- Main Javascript File  -->
    <script src="{{asset('public/js/scripts.js')}}"></script>
    @yield('page_scripts')
    <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    </script>
</html>