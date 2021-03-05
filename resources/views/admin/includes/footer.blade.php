
  @if (isset($useVue))
  <script src="{{asset('js/app.js')}}"></script>      
  @endif
  <script>var base_path = "{{url('/admin')}}";</script>
  <!-- BEGIN VENDOR JS-->
  
  <script src="{{url('/admin')}}/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="{{url('/admin')}}/app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/vendors/js/timeline/horizontal-timeline.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/vendors/js/extensions/jquery.raty.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/vendors/js/extensions/jquery.toolbar.min.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/vendors/js/editors/ckeditor/ckeditor.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/vendors/js/extensions/sweetalert.min.js" type="text/javascript"></script>

  
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="{{url('/admin')}}/app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="{{url('/admin')}}/app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/js/scripts/extensions/rating.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/js/scripts/forms/form-repeater.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/js/scripts/extensions/toolbar.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/js/scripts/forms/switch.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/js/scripts/editors/editor-ckeditor.js" type="text/javascript"></script>
  <script src="{{url('/admin')}}/app-assets/js/scripts/extensions/sweet-alerts.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
  
  <!-- Costum Scripts -->
  <script src="{{url('/admin')}}/assets/js/scripts.js" type="text/javascript"></script>
  
<script>
  $('.rating-read-only').raty({
    readOnly: function() {
      return true;
    }
  });

  

</script>

