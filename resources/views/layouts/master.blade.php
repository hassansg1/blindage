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
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Client Information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="client-summary-wrapper client-summary-modal">
                     <div class="client-summary-info">
                        <div class="client-pic-wrapper">
                           <div class="client-pic">
                              AY
                           </div>
                        </div>
                        <div class="client-info-detail">
                           <div class="client-name">
                              <h4>Atique Yousaf</h4>
                           </div>
                           <div class="mb-2 icon-wrapper">
                              <i class="fas fa-phone-alt icon"></i>
                              <div>Contact Number</div>
                           </div>
                           <div class="icon-wrapper mb-2">
                              <i class="fas fa-envelope icon"></i>
                              <div>Email ID</div>
                           </div>
                           <div class="mb-3 box-wrapper">
                              <i class="fas fa-clock"></i>
                              <div class="">
                                 <div><span>6:45 p.m.</span>  -  <span>7:15 p.m.</span></div>
                                 <div> Monday, October 18, 2021</div>
                              </div>
                           </div>
                           <div class="mb-3 box-wrapper">
                              <i class="fas fa-file-signature"></i>
                              <div class="">
                                 <div>Miscellaneous Service</div>
                                 <div> 30 Min. (6:45 p.m. - 7:15 p.m.)</div>
                              </div>
                           </div>
                           <div class="mb-3 box-wrapper">
                              <i class="fas fa-address-card"></i>
                              <div class="">
                                 <div><span>Employee:</span> <span>Ateeq Yousaf</span></div>
                                 <div> 30 Min. (6:45 p.m. - 7:15 p.m.)</div>
                              </div>
                           </div>
                           <div class="box-wrapper">
                              <i class="fas fa-bell"></i>
                              <div class="">
                                 <div><span>Employee:</span> <span>Ateeq Yousaf</span></div>
                                 <div> 30 Min. (6:45 p.m. - 7:15 p.m.)</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <div class="btn btn-primary primary-alt">Appt. Details</div>
                  <div class="btn btn-primary" data-bs-dismiss="modal">Schedule</div>
               </div>
            </div>
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
   </body>
</html>