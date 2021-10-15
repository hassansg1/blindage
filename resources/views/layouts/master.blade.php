<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8"/>
      <title> @yield('title') | Skote - Admin & Dashboard Template</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
      <meta content="Themesbrand" name="author"/>
      <!-- App favicon -->
      <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
      @include('layouts.head-css')
   </head>
   @section('body')
   <body data-topbar="dark" data-layout="horizontal">
      @include('layouts.preloader')
      @show
      <!-- Begin page -->
      <div id="layout-wrapper">
         @include('layouts.horizontal')
         <!-- ============================================================== -->
         <!-- Start right Content here -->
         <!-- ============================================================== -->
         <div class="main-content">
            <div class="page-content">
               <!-- Start content -->
               <div class="container-fluid">
                  @yield('content')
               </div>
               <!-- content -->
            </div>
            @include('layouts.footer')
            @include('components.modals')
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here -->
         <!-- ============================================================== -->
      </div>
      <!-- END wrapper -->
      <!-- Right Sidebar -->
      <!-- END Right Sidebar -->
      @include('layouts.vendor-scripts')
      <div class="modal fade" id="clientInfoModal" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" id="div_id_clientInfoModal_content">
            
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
   </body>
</html>