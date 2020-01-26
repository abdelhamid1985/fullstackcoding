<!DOCTYPE html>
<html lang="en">
  <head>
    @include("parts.assets")
    <title>TopShop @yield("title")</title>
    @yield("css_section")
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ route("shop.index") }}" class="site_title"><i class="fa fa-paw"></i> <span>Top Shop</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ auth()->user()->username }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include("parts.side")
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        @include("parts.header");
        <!-- /top navigation -->
        
        <!-- page content -->
        <div class="right_col" role="main" style="min-height: 1128px; margin-top: -30px;">
          <div class="">
        @yield("content_section")
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include("parts.footer");
        <!-- /footer content -->
      </div>
    </div>

@include("parts.js")

@yield("js_section")
	
  </body>
</html>
