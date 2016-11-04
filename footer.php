<?php 
include ('config.php');
?>

<!-- jQuery -->
<script type="text/javascript" src="/js/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script type="text/javascript" src="/js/bootstrap/bootstrap.min.js"></script>
<!-- Datatables -->
<script type="text/javascript" src="/js/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/js/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="/js/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="/js/datatables/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="/js/datatables/buttons.flash.min.js"></script>
<script type="text/javascript" src="/js/datatables/buttons.html5.min.js"></script>
<script type="text/javascript" src="/js/datatables/buttons.print.min.js"></script>
<script type="text/javascript" src="/js/datatables/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="/js/datatables/dataTables.keyTable.min.js"></script>
<script type="text/javascript" src="/js/datatables/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="/js/datatables/responsive.bootstrap.js"></script>
<script type="text/javascript" src="/js/datatables/datatables.scroller.min.js"></script>
<script type="text/javascript" src="/js/datatables/jszip.min.js"></script>
<script type="text/javascript" src="/js/datatables/pdfmake.min.js"></script>
<script type="text/javascript" src="/js/datatables/vfs_fonts.js"></script>
<!-- bootstrap-daterangepicker -->
<script type="text/javascript" src="/js/moment/moment.min.js"></script>
<script type="text/javascript" src="/js/datepicker/daterangepicker.js"></script>
<!-- jquery.inputmask -->
<script type="text/javascript" src="/js/inputmask/jquery.inputmask.bundle.min.js"></script>
<!-- FastClick -->
<script type="text/javascript" src="/js/fastclick/fastclick.js"></script>
<!-- NProgress -->	
<script type="text/javascript" src="/js/nprogress/nprogress.js"></script>
<!-- jQuery custom content scroller -->
<script type="text/javascript" src="/js/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- jQuery Smart Wizard -->
<script type="text/javascript" src="/js/jQuery-Smart-Wizard/jquery.smartWizard.js"></script>
<!-- PNotify -->
<script type="text/javascript" src="/js/pnotify/pnotify.js"></script>
<script type="text/javascript" src="/js/pnotify/pnotify.buttons.js"></script>
<script type="text/javascript" src="/js/pnotify/pnotify.nonblock.js"></script>
<!-- iCheck -->
<script type="text/javascript" src="/js/iCheck/icheck.min.js"></script>
<!-- validator -->
<script type="text/javascript" src="/js/validator/validator.js"></script>
<!-- Gentella Custom -->
<script type="text/javascript" src="/js/gentella/custom.min.js"></script>
<!-- Custom -->
<script type="text/javascript" src="/js/functions.js"></script>

<!-- Datatables -->
<script>
  $(document).ready(function() {
	var handleDataTableButtons = function() {
	  if ($("#datatable-buttons").length) {
		$("#datatable-buttons").DataTable({
		  dom: "Bfrtip",
		  buttons: [
			{
			  extend: "copy",
			  className: "btn-sm"
			},
			{
			  extend: "csv",
			  className: "btn-sm"
			},
			{
			  extend: "excel",
			  className: "btn-sm"
			},
			{
			  extend: "pdfHtml5",
			  className: "btn-sm"
			},
			{
			  extend: "print",
			  className: "btn-sm"
			},
		  ],
		  responsive: true
		});
	  }
	};

	TableManageButtons = function() {
	  "use strict";
	  return {
		init: function() {
		  handleDataTableButtons();
		}
	  };
	}();

	$('#datatable').dataTable();

	$('#datatable-keytable').DataTable({
	  keys: true
	});

	$('#datatable-responsive').DataTable();

	$('#datatable-scroller').DataTable({
	  ajax: "js/datatables/json/scroller-demo.json",
	  deferRender: true,
	  scrollY: 380,
	  scrollCollapse: true,
	  scroller: true
	});

	$('#datatable-fixed-header').DataTable({
	  fixedHeader: true
	});

	var $datatable = $('#datatable-checkbox');

	$datatable.dataTable({
	  'order': [[ 1, 'asc' ]],
	  'columnDefs': [
		{ orderable: false, targets: [0] }
	  ]
	});
	$datatable.on('draw.dt', function() {
	  $('input').iCheck({
		checkboxClass: 'icheckbox_flat-green'
	  });
	});

	TableManageButtons.init();
  });
</script>
<!-- /Datatables -->

<!-- validator -->
<script>
  // initialize the validator function
  validator.message.date = 'Fecha invalida';
  validator.message.empty = 'Complete el campo';
  validator.message.invalid = 'Campo invalido';
  validator.message.email = 'Email invalido';
  validator.message.select = 'Elija una opcion';

  // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
  $('form')
	.on('blur', 'input[required], input.optional, select.required', validator.checkField)
	.on('change', 'select.required', validator.checkField)
	.on('keypress', 'input[required][pattern]', validator.keypress);

  $('.multi.required').on('keyup blur', 'input', function() {
	validator.checkField.apply($(this).siblings().last()[0]);
  });

  $('form').submit(function(e) {
	e.preventDefault();
	var submit = true;

	// evaluate the form using generic validaing
	if (!validator.checkAll($(this))) {
	  submit = false;
	}

	if (submit)
	  this.submit();

	return false;
  });
</script>
<!-- /validator -->

<!-- bootstrap-daterangepicker -->
<script>
  $(document).ready(function() {
	var cb = function(start, end, label) {
	  console.log(start.toISOString(), end.toISOString(), label);
	  $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	};

	var optionSet1 = {
	  startDate: moment().subtract(29, 'days'),
	  endDate: moment(),
	  minDate: '01/01/2012',
	  maxDate: '12/31/2015',
	  dateLimit: {
		days: 60
	  },
	  showDropdowns: true,
	  showWeekNumbers: true,
	  timePicker: false,
	  timePickerIncrement: 1,
	  timePicker12Hour: true,
	  ranges: {
		'Today': [moment(), moment()],
		'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Last 7 Days': [moment().subtract(6, 'days'), moment()],
		'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		'This Month': [moment().startOf('month'), moment().endOf('month')],
		'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	  },
	  opens: 'right',
	  buttonClasses: ['btn btn-default'],
	  applyClass: 'btn-small btn-primary',
	  cancelClass: 'btn-small',
	  format: 'MM/DD/YYYY',
	  separator: ' to ',
	  locale: {
		applyLabel: 'Submit',
		cancelLabel: 'Clear',
		fromLabel: 'From',
		toLabel: 'To',
		customRangeLabel: 'Custom',
		daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
		monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		firstDay: 1
	  }
	};

	$('#reportrange_right span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

	$('#reportrange_right').daterangepicker(optionSet1, cb);

	$('#reportrange_right').on('show.daterangepicker', function() {
	  console.log("show event fired");
	});
	$('#reportrange_right').on('hide.daterangepicker', function() {
	  console.log("hide event fired");
	});
	$('#reportrange_right').on('apply.daterangepicker', function(ev, picker) {
	  console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
	});
	$('#reportrange_right').on('cancel.daterangepicker', function(ev, picker) {
	  console.log("cancel event fired");
	});

	$('#options1').click(function() {
	  $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
	});

	$('#options2').click(function() {
	  $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
	});

	$('#destroy').click(function() {
	  $('#reportrange_right').data('daterangepicker').remove();
	});

  });
</script>

<script>
  $(document).ready(function() {
	var cb = function(start, end, label) {
	  console.log(start.toISOString(), end.toISOString(), label);
	  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	};

	var optionSet1 = {
	  startDate: moment().subtract(29, 'days'),
	  endDate: moment(),
	  minDate: '01/01/2012',
	  maxDate: '12/31/2015',
	  dateLimit: {
		days: 60
	  },
	  showDropdowns: true,
	  showWeekNumbers: true,
	  timePicker: false,
	  timePickerIncrement: 1,
	  timePicker12Hour: true,
	  ranges: {
		'Today': [moment(), moment()],
		'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Last 7 Days': [moment().subtract(6, 'days'), moment()],
		'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		'This Month': [moment().startOf('month'), moment().endOf('month')],
		'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	  },
	  opens: 'left',
	  buttonClasses: ['btn btn-default'],
	  applyClass: 'btn-small btn-primary',
	  cancelClass: 'btn-small',
	  format: 'MM/DD/YYYY',
	  separator: ' to ',
	  locale: {
		applyLabel: 'Submit',
		cancelLabel: 'Clear',
		fromLabel: 'From',
		toLabel: 'To',
		customRangeLabel: 'Custom',
		daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
		monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		firstDay: 1
	  }
	};
	$('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
	$('#reportrange').daterangepicker(optionSet1, cb);
	$('#reportrange').on('show.daterangepicker', function() {
	  console.log("show event fired");
	});
	$('#reportrange').on('hide.daterangepicker', function() {
	  console.log("hide event fired");
	});
	$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
	  console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
	});
	$('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
	  console.log("cancel event fired");
	});
	$('#options1').click(function() {
	  $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
	});
	$('#options2').click(function() {
	  $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
	});
	$('#destroy').click(function() {
	  $('#reportrange').data('daterangepicker').remove();
	});
  });
</script>

<script>
  $(document).ready(function() {
	$('#reservation').daterangepicker(null, function(start, end, label) {
	  console.log(start.toISOString(), end.toISOString(), label);
	});
  });
</script>
<!-- /bootstrap-daterangepicker -->

<!-- jquery.inputmask -->
<script>
  $(document).ready(function() {
	$(":input").inputmask();
  });
</script>
<!-- /jquery.inputmask -->
