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
      <!--  Add New Client Modal Starts Here -->
      <div class="modal fade addNewClientModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
         <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Add New Client</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form class="needs-validation" novalidate method="posts">
                  <div class="modal-body">
                     <h3 class="mb-4">General Info</h3>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="mb-3">
                              <label for="first_name" class="form-label required">First
                              Name</label>
                              <input type="text" value=""
                                 class="form-control" id="first_name"
                                 name="first_name" required>
                              <div class="invalid-feedback">
                                 Please Enter your First Name.
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="mb-3">
                              <label for="last_name" class="form-label required">Last
                              Name</label>
                              <input type="text" value=""
                                 class="form-control" id="" name=""
                                 required>
                              <div class="invalid-feedback">
                                 Please Enter your Last Name.
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <label for="category" class="form-label">Category</label>
                           <select class="form-select" name="">
                              <option value="">--Select Category--</option>
                              <option value="">VIP</option>
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="mb-3">
                              <label for="first_name" class="form-label">Mobile Phone</label>
                              <input type="text" value=""
                                 class="form-control" id=""
                                 name="">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="mb-3">
                              <label for="first_name" class="form-label">Alternative Phone</label>
                              <input type="text" value=""
                                 class="form-control" id=""
                                 name="">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="mb-3">
                              <label for="when" class="form-label">Date of Birth</label>
                                 <div class="input-group" id="datepicker2">
                                     <input type="text" class="form-control" placeholder="dd M, yyyy"
                                         data-date-format="dd M, yyyy" data-date-container='#datepicker2' data-provide="datepicker">
                                     <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                 </div><!-- input-group -->
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="mb-3">
                              <label for="" class="form-label">Email</label>
                              <input type="email" value=""
                                 class="form-control" id=""
                                 name="">
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="row">
                                 <div class="col-md-6">
                                    <p>Send appointment notifications to this client by:</p>
                                    <div class="row">
                                       <div class="col-md-6">
                                          <div class="form-check">
                                               <div class="mb-2">
                                                   <input class="form-check-input mt-0" type="checkbox" name="appointment_email" value="1" id="1">
                                                   <label class="form-check-label" for="1">
                                                       Email
                                                   </label>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-check">
                                               <div class="mb-2">
                                                   <input class="form-check-input mt-0" type="checkbox" name="appointment_email" value="1" id="2">
                                                   <label class="form-check-label" for="2">
                                                       Text Message
                                                   </label>
                                               </div>
                                           </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <p>Send marketing campaign to this client by:</p>
                                     <div class="row">
                                       <div class="col-md-6">
                                          <div class="form-check">
                                               <div class="mb-2">
                                                   <input class="form-check-input mt-0" type="checkbox" name="appointment_email" value="1" id="3">
                                                   <label class="form-check-label" for="3">
                                                       Email
                                                   </label>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="form-check">
                                               <div class="mb-2">
                                                   <input class="form-check-input mt-0" type="checkbox" name="appointment_email" value="1" id="4">
                                                   <label class="form-check-label" for="4">
                                                       Text Message
                                                   </label>
                                               </div>
                                           </div>
                                       </div>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 text-center">
                           <p class="mb-0">Messaging has not been enabled. Click here to enable messaging.</p>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <div class="btn btn-primary primary-alt" data-bs-dismiss="modal">Close</div>
                     <div class="btn btn-primary" type="submit">Save</div>
                  </div>
               </form>
            </div>
            <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- Add New Client Modal Ends Here -->
   </body>
</html>