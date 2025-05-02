<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{asset('admins/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admins/js/custom.js')}}" type="text/javascript"></script>
<script src="{{asset('admins/js/animation.js')}}" type="text/javascript"></script>
<script src="{{asset('admins/js/datepicker.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- Add this in the <head> section of your HTML -->

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script>



        $(document).on('keyup', "#input-box", function() {
            if ($(this).val() != '')
                $(".result-box").show();
            else
                $(".result-box").hide();
        })
    </script>


</body>

</html>