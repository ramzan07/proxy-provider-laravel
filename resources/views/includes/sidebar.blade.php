<!-- About Me (Left Sidebar) Start -->
<div class="col-md-3">
   <div class="about-fixed">
      <div class="my-pic">
         <img src="{{asset('resources/assets/images/my-pic.png')}}" alt="">
         <a href="javascript:void(0)" class="collapsed" data-target="#menu" data-toggle="collapse"><i class="icon-menu menu"></i></a>
         <div id="menu" class="collapse">
            <ul class="menu-link">
               <li><a href="#">RSS Posts</a></li>
               <li><a href="#">RSS Providers</a></li>
            </ul>
         </div>
      </div>
      @yield('sidebarCards')
   </div>
</div>
<!-- About Me (Left Sidebar) End -->