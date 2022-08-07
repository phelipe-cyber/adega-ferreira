<!-- Select2 -->
<link rel = "shortcut icon" type = "imagem/x-icon" href = "/images-on-off/icone.ico"/>

<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">


<!-- Theme style -->
<link rel="stylesheet" href="/dist/css/adminlte.min.css">


<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->

<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

 <!-- MDBootstrap Datatables  -->
 <link href="boostrap/css/addons/datatables.min.css" rel="stylesheet">

<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="boostrap/js/addons/datatables.min.js"></script>


<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>

<script src="/dist/js/jquery.maskMoney.js" type="text/javascript"></script>
<script src="/dist/js/jquery.maskMoney.min.js" type="text/javascript"></script>

<!-- Font Awesome Icons -->
<!-- overlayScrollbars -->
<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

</head>



</div>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>


<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<script src="/plugins/select2/js/select2.full.min.js"></script>

<script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>


<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
</body>

</html>



<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });
</script>
<!-- DataTables -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<script src="vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="vendors/cropper/dist/cropper.min.js"></script>
<!-- FastClick -->
<script src="vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- Ion.RangeSlider -->
<script src="vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
<!-- Bootstrap Colorpicker -->
<script src="vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- jQuery Knob -->
<script src="vendors/jquery-knob/dist/jquery.knob.min.js"></script>


<!-- Custom Theme Scripts -->
<script src="build/js/custom.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "searching": true,
            "paging": false,
            "ordering": false,
            "info": true,
            
        });
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
        });
    });
</script>

<style>
    .number-input input[type="number"] {
        -webkit-appearance: textfield;
        -moz-appearance: textfield;
        appearance: textfield;
    }

    .number-input input[type=number]::-webkit-inner-spin-button,
    .number-input input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }

    .number-input {
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .number-input button {
        -webkit-appearance: none;
        background-color: transparent;
        border: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin: 0;
        position: relative;
    }

    .number-input button:before,
    .number-input button:after {
        display: inline-block;
        position: absolute;
        content: '';
        height: 2px;
        transform: translate(-50%, -50%);
    }

    .number-input button.plus:after {
        transform: translate(-50%, -50%) rotate(90deg);
    }

    .number-input input[type=number] {
        text-align: center;
    }

    .number-input.number-input {
        border: 1px solid #ced4da;
        width: 10rem;
        border-radius: .25rem;
    }

    .number-input.number-input button {
        width: 2.6rem;
        height: .7rem;
    }

    .number-input.number-input button.minus {
        padding-left: 10px;
    }

    .number-input.number-input button:before,
    .number-input.number-input button:after {
        width: .7rem;
        background-color: #495057;
    }

    .number-input.number-input input[type=number] {
        max-width: 4rem;
        padding: .5rem;
        border: 1px solid #ced4da;
        border-width: 0 1px;
        font-size: 1rem;
        height: 2rem;
        color: #495057;
    }

    @media not all and (min-resolution:.001dpcm) {
        @supports (-webkit-appearance: none) and (stroke-color:transparent) {

            .number-input.def-number-input.safari_only button:before,
            .number-input.def-number-input.safari_only button:after {
                margin-top: -.3rem;
            }
        }
    }
</style>

<script>
    $(document).ready(function() {

        $("#valordavenda").maskMoney({
            thousands: ".",
            decimal: ",",
            prefix: "R$ ",
            showSymbol: true,
            symbolStay: true
        });
        $("#valorrecebido").maskMoney({
            thousands: ".",
            decimal: ",",
            prefix: "R$ ",
            showSymbol: true,
            symbolStay: true11
        });
    });
</script>

<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>


<style>
    #response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
    text-align: center;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
    text-align: center;
}

div#response.display-block {
    display: block;
}
</style>

</body>

</html>


