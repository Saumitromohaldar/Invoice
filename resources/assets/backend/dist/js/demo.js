/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
$(function () {
  'use strict'
  /**
   * Get access to plugins
   */
  $('[data-toggle="control-sidebar"]').controlSidebar()
  $('[data-toggle="push-menu"]').pushMenu()

  var $pushMenu       = $('[data-toggle="push-menu"]').data('lte.pushmenu')
  var $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar')
  var $layout         = $('body').data('lte.layout')

  /**
   * List of all the available skins
   *
   * @type Array
   */
  var mySkins = [
    'skin-blue',
    'skin-black',
    'skin-red',
    'skin-yellow',
    'skin-purple',
    'skin-green',
    'skin-blue-light',
    'skin-black-light',
    'skin-red-light',
    'skin-yellow-light',
    'skin-purple-light',
    'skin-green-light'
  ]

  /**
   * Get a prestored setting
   *
   * @param String name Name of of the setting
   * @returns String The value of the setting | null
   */
  function get(name) {
    if (typeof (Storage) !== 'undefined') {
      return localStorage.getItem(name)
    } else {
      window.alert('Please use a modern browser to properly view this template!')
    }
  }

  /**
   * Store a new settings in the browser
   *
   * @param String name Name of the setting
   * @param String val Value of the setting
   * @returns void
   */
  function store(name, val) {
    if (typeof (Storage) !== 'undefined') {
      localStorage.setItem(name, val)
    } else {
      window.alert('Please use a modern browser to properly view this template!')
    }
  }

  /**
   * Toggles layout classes
   *
   * @param String cls the layout class to toggle
   * @returns void
   */
  function changeLayout(cls) {
    $('body').toggleClass(cls)
    $layout.fixSidebar()
    if ($('body').hasClass('fixed') && cls == 'fixed') {
      $pushMenu.expandOnHover()
      $layout.activate()
    }
    $controlSidebar.fix()
  }

  /**
   * Replaces the old skin with the new skin
   * @param String cls the new skin class
   * @returns Boolean false to prevent link's default action
   */
  function changeSkin(cls) {
    $.each(mySkins, function (i) {
      $('body').removeClass(mySkins[i])
    })

    $('body').addClass(cls)
    store('skin', cls)
    return false
  }

  /**
   * Retrieve default settings and apply them to the template
   *
   * @returns void
   */
  function setup() {
    var tmp = get('skin')
    if (tmp && $.inArray(tmp, mySkins))
      changeSkin(tmp)

    // Add the change skin listener
    $('[data-skin]').on('click', function (e) {
      if ($(this).hasClass('knob'))
        return
      e.preventDefault()
      changeSkin($(this).data('skin'))
    })

    // Add the layout manager
    $('[data-layout]').on('click', function () {
      changeLayout($(this).data('layout'))
    })

    $('[data-controlsidebar]').on('click', function () {
      changeLayout($(this).data('controlsidebar'))
      var slide = !$controlSidebar.options.slide

      $controlSidebar.options.slide = slide
      if (!slide)
        $('.control-sidebar').removeClass('control-sidebar-open')
    })

    $('[data-sidebarskin="toggle"]').on('click', function () {
      var $sidebar = $('.control-sidebar')
      if ($sidebar.hasClass('control-sidebar-dark')) {
        $sidebar.removeClass('control-sidebar-dark')
        $sidebar.addClass('control-sidebar-light')
      } else {
        $sidebar.removeClass('control-sidebar-light')
        $sidebar.addClass('control-sidebar-dark')
      }
    })

    $('[data-enable="expandOnHover"]').on('click', function () {
      $(this).attr('disabled', true)
      $pushMenu.expandOnHover()
      if (!$('body').hasClass('sidebar-collapse'))
        $('[data-layout="sidebar-collapse"]').click()
    })

    //  Reset options
    if ($('body').hasClass('fixed')) {
      $('[data-layout="fixed"]').attr('checked', 'checked')
    }
    if ($('body').hasClass('layout-boxed')) {
      $('[data-layout="layout-boxed"]').attr('checked', 'checked')
    }
    if ($('body').hasClass('sidebar-collapse')) {
      $('[data-layout="sidebar-collapse"]').attr('checked', 'checked')
    }

  }

  // Create the new tab
  var $tabPane = $('<div />', {
    'id'   : 'control-sidebar-theme-demo-options-tab',
    'class': 'tab-pane active'
  })

  // Create the tab button
  var $tabButton = $('<li />', { 'class': 'active' })
    .html('<a href=\'#control-sidebar-theme-demo-options-tab\' data-toggle=\'tab\'>'
      + '<i class="fa fa-wrench"></i>'
      + '</a>')

  // Add the tab button to the right sidebar tabs
  $('[href="#control-sidebar-home-tab"]')
    .parent()
    .before($tabButton)

  // Create the menu
  var $demoSettings = $('<div />')

  // Layout options
  $demoSettings.append(
    '<h4 class="control-sidebar-heading">'
    + 'Layout Options'
    + '</h4>'
    // Fixed layout
    + '<div class="form-group">'
    + '<label class="control-sidebar-subheading">'
    + '<input type="checkbox"data-layout="fixed"class="pull-right"/> '
    + 'Fixed layout'
    + '</label>'
    + '<p>Activate the fixed layout. You can\'t use fixed and boxed layouts together</p>'
    + '</div>'
    // Boxed layout
    + '<div class="form-group">'
    + '<label class="control-sidebar-subheading">'
    + '<input type="checkbox"data-layout="layout-boxed" class="pull-right"/> '
    + 'Boxed Layout'
    + '</label>'
    + '<p>Activate the boxed layout</p>'
    + '</div>'
    // Sidebar Toggle
    + '<div class="form-group">'
    + '<label class="control-sidebar-subheading">'
    + '<input type="checkbox"data-layout="sidebar-collapse"class="pull-right"/> '
    + 'Toggle Sidebar'
    + '</label>'
    + '<p>Toggle the left sidebar\'s state (open or collapse)</p>'
    + '</div>'
    // Sidebar mini expand on hover toggle
    + '<div class="form-group">'
    + '<label class="control-sidebar-subheading">'
    + '<input type="checkbox"data-enable="expandOnHover"class="pull-right"/> '
    + 'Sidebar Expand on Hover'
    + '</label>'
    + '<p>Let the sidebar mini expand on hover</p>'
    + '</div>'
    // Control Sidebar Toggle
    + '<div class="form-group">'
    + '<label class="control-sidebar-subheading">'
    + '<input type="checkbox"data-controlsidebar="control-sidebar-open"class="pull-right"/> '
    + 'Toggle Right Sidebar Slide'
    + '</label>'
    + '<p>Toggle between slide over content and push content effects</p>'
    + '</div>'
    // Control Sidebar Skin Toggle
    + '<div class="form-group">'
    + '<label class="control-sidebar-subheading">'
    + '<input type="checkbox"data-sidebarskin="toggle"class="pull-right"/> '
    + 'Toggle Right Sidebar Skin'
    + '</label>'
    + '<p>Toggle between dark and light skins for the right sidebar</p>'
    + '</div>'
  )
  var $skinsList = $('<ul />', { 'class': 'list-unstyled clearfix' })

  // Dark sidebar skins
  var $skinBlue =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Blue</p>')
  $skinsList.append($skinBlue)
  var $skinBlack =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Black</p>')
  $skinsList.append($skinBlack)
  var $skinPurple =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Purple</p>')
  $skinsList.append($skinPurple)
  var $skinGreen =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Green</p>')
  $skinsList.append($skinGreen)
  var $skinRed =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Red</p>')
  $skinsList.append($skinRed)
  var $skinYellow =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin">Yellow</p>')
  $skinsList.append($skinYellow)

  // Light sidebar skins
  var $skinBlueLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Blue Light</p>')
  $skinsList.append($skinBlueLight)
  var $skinBlackLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Black Light</p>')
  $skinsList.append($skinBlackLight)
  var $skinPurpleLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-purple-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Purple Light</p>')
  $skinsList.append($skinPurpleLight)
  var $skinGreenLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Green Light</p>')
  $skinsList.append($skinGreenLight)
  var $skinRedLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Red Light</p>')
  $skinsList.append($skinRedLight)
  var $skinYellowLight =
        $('<li />', { style: 'float:left; width: 33.33333%; padding: 5px;' })
          .append('<a href="javascript:void(0)" data-skin="skin-yellow-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
            + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
            + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
            + '</a>'
            + '<p class="text-center no-margin" style="font-size: 12px">Yellow Light</p>')
  $skinsList.append($skinYellowLight)

  $demoSettings.append('<h4 class="control-sidebar-heading">Skins</h4>')
  $demoSettings.append($skinsList)

  $tabPane.append($demoSettings)
  $('#control-sidebar-home-tab').after($tabPane)

  setup()

  $('[data-toggle="tooltip"]').tooltip()
})





$(function () {
   $('.select2').select2()
});


/**
 * Site : http:www.smarttutorials.net
 * @author muni
 */

//adds extra table rows
var i=$('table#invoiceTable tr').length;
$("#addmore").on('click',function(){
	html = '<tr>';
	html += '<td class="text-center"><input class="case" type="checkbox"/></td>';
	html += '<td><input type="text" data-type="description" name="description[]" id="description_'+i+'" class="form-control autocomplete_txt " autocomplete="off"></td>';
	html += '<td><input type="text" name="total[]" id="total_'+i+'" class="form-control totalLinePrice changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
	html += '</tr>';
	$('table#invoiceTable').append(html);
	i++;
});

//to check all checkboxes
$(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$("#delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('#check_all').prop("checked", false);
	calculateTotal();
});




//price change
$(document).on('change keyup blur','.changesNo',function(){

	calculateTotal();
});


//total price calculation
function calculateTotal(){
	subTotal = 0 ; total = 0,discount=0,tax=0;
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
  });
  
  $('#subTotal').val(subTotal.toFixed(2));
  
 // $('#taxAmount').val(0);


  tax = $('#tax').val();
  discount = $('#discount').val();
  console.log('Tax:'+tax);
  console.log('discount:'+discount);
  total = subTotal;
  if(discount){
    total = total - parseFloat(discount);
  }
  if(tax){
    total =total + parseFloat(tax);
  }
  $('#totalAftertax').val( total.toFixed(2) );
  
	calculateAmountDue();
}

$(document).on('change keyup blur','#amountPaid',function(){
	calculateAmountDue();
});


//due amount calculation
function calculateAmountDue(){
	amountPaid = $('#amountPaid').val();
	total = $('#totalAftertax').val();
	if(amountPaid != '' && typeof(amountPaid) != "undefined" ){
		amountDue = parseFloat(total) - parseFloat( amountPaid );
		$('.amountDue').val( amountDue.toFixed(2) );
	}else{
		total = parseFloat(total).toFixed(2);
		$('.amountDue').val( total);
	}
}


//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8,46); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}

//datepicker
$(function () {
    $('#invoiceDate').datepicker({
        format: 'dd-mm-yyyy'
    });
    $('#due_date').datepicker({
        format: 'dd-mm-yyyy'
    });

    $('.date_field').datepicker({
        format: 'dd-mm-yyyy'
    });
    
});


$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	if(typeof errorFlag !== 'undefined'){
		$('.message_div').delay(5000).slideUp();
    }


    $('#save-company').on('submit', function(e) {
        e.preventDefault();
        $(".ajax_loading").fadeIn();
        var formAction=this.action;
        var formData = $(this).serialize();

        $(this).find('.error_message').html('');
        $(this).find('.has-error').removeClass("has-error");
        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            success: function(data){
                $(".ajax_loading").fadeOut();
                if(data.status=='success'){

                  swal({
                        title: '',
                        text: data.message,
                        icon: "success"
                    }).then((value) => {
                      window.location = host+"/companies";
                    });

                }else{
                    printErrorMsg(data.errors);
                }
            }
        });
    });

    

    $('#save-user').on('submit', function(e) {
      e.preventDefault();
      $(".ajax_loading").fadeIn();
      var formAction=this.action;
      var formData = $(this).serialize();

      $(this).find('.error_message').html('');
      $(this).find('.has-error').removeClass("has-error");
      $.ajax({
          type: "POST",
          url: formAction,
          data: formData,
          success: function(data){
              $(".ajax_loading").fadeOut();
              if(data.status=='success'){

                swal({
                      title: '',
                      text: data.message,
                      icon: "success"
                  }).then((value) => {
                    window.location = host+"/users";
                  });

              }else{
                  printErrorMsg(data.errors);
              }
          }
      });
  });

  $('#update-user').on('submit', function(e) {
    e.preventDefault();
    $(".ajax_loading").fadeIn();
    var formAction=this.action;
    var formData = $(this).serialize();

    $(this).find('.error_message').html('');
    $(this).find('.has-error').removeClass("has-error");
    $.ajax({
        type: "PUT",
        url: formAction,
        data: formData,
        success: function(data){

            $(".ajax_loading").fadeOut();
            
            if(data.status=='success'){
              swal({
                  title: '',
                  text: data.message,
                  icon: "success"
              }).then((value) => {
                //window.location = host+"/users";
                location.reload(true);
              });

            }else{
                printErrorMsg(data.errors);
            }

        }
    });
});
  
$('#update-password').on('submit', function(e) {
  e.preventDefault();
  $(".ajax_loading").fadeIn();
  var formAction=this.action;
  var formData = $(this).serialize();

  $(this).find('.error_message').html('');
  $(this).find('.has-error').removeClass("has-error");
  $.ajax({
      type: "POST",
      url: formAction,
      data: formData,
      success: function(data){

          $(".ajax_loading").fadeOut();
          
          if(data.status=='success'){
            swal({
                title: '',
                text: data.message,
                icon: "success"
            }).then((value) => {
              //window.location = host+"/users";
              location.reload(true);
            });

          }else{
              printErrorMsg(data.errors);
          }

      }
  });
});

    $('#save-invoice').on('submit', function(e) {

        e.preventDefault();
        $(".ajax_loading").fadeIn();
        var formAction=this.action;
        var formData = $(this).serialize();

        $(this).find('.error_message').html('');

        $(this).find('.has-error').removeClass("has-error");

        $.ajax({
            type: "POST",
            url: formAction,
            data: formData,
            success: function(data){
                $(".ajax_loading").fadeOut();
                if(data.status=='success'){

                  swal({
                        title: '',
                        text: data.message,
                        icon: "success"
                    }).then((value) => {
                      window.location = host+"/invoices";
                    });
                    // , function() {
                    //     window.location = host+"/invoices";
                    // });

                }else{
                    printErrorMsg(data.errors);
                }
            }
        });

    });

    /* save category */
    $('#save-category').on('submit', function(e) {

      e.preventDefault();
      $(".ajax_loading").fadeIn();
      var formAction=this.action;
      var formData = $(this).serialize();
      $(this).find('.error_message').html('');
      $(this).find('.has-error').removeClass("has-error");
      $.ajax({
          type: "POST",
          url: formAction,
          data: formData,
          success: function(data){
              $(".ajax_loading").fadeOut();
              if(data.status=='success'){
                swal({
                      title: '',
                      text: data.message,
                      icon: "success"
                  }).then((value) => {
                    window.location = host+"/categories";
                  });      
              }else{
                  printErrorMsg(data.errors);
              }
          }
      });

      

    });


    /* save income  */
    $('#save-income').on('submit', function(e) {
      e.preventDefault();
      $(".ajax_loading").fadeIn();
      var formAction=this.action;
      var formData = $(this).serialize();
      $(this).find('.error_message').html('');
      $(this).find('.has-error').removeClass("has-error");
      $.ajax({
          type: "POST",
          url: formAction,
          data: formData,
          success: function(data){
              $(".ajax_loading").fadeOut();
              if(data.status=='success'){
                swal({
                      title: '',
                      text: data.message,
                      icon: "success"
                  }).then((value) => {
                    window.location = host+"/income_expenses";
                  });      
              }else{
                  printErrorMsgIncome(data.errors);
              }
          }
      });

    });

    /* save expense  */
    $('#save-expense').on('submit', function(e) {
      e.preventDefault();
      $(".ajax_loading").fadeIn();
      var formAction=this.action;
      var formData = $(this).serialize();
      $(this).find('.error_message').html('');
      $(this).find('.has-error').removeClass("has-error");
      $.ajax({
          type: "POST",
          url: formAction,
          data: formData,
          success: function(data){
              $(".ajax_loading").fadeOut();
              if(data.status=='success'){
                swal({
                      title: '',
                      text: data.message,
                      icon: "success"
                  }).then((value) => {
                    window.location = host+"/income_expenses";
                  });      
              }else{
                  printErrorMsgExpense(data.errors);
              }
          }
      });

    });

    

    /* save expense  */
    $('#update-income_expense').on('submit', function(e) {
      e.preventDefault();
      $(".ajax_loading").fadeIn();
      var formAction=this.action;
      var formData = $(this).serialize();
      $(this).find('.error_message').html('');
      $(this).find('.has-error').removeClass("has-error");
      $.ajax({
          type: "PUT",
          url: formAction,
          data: formData,
          success: function(data){
              $(".ajax_loading").fadeOut();
              if(data.status=='success'){
                swal({
                      title: '',
                      text: data.message,
                      icon: "success"
                  }).then((value) => {
                    window.location = host+"/income_expenses";
                  });      
              }else{
                  printErrorMsg(data.errors);
              }
          }
      });

    });



    /**
     * On change populate company data invoice page
     */
    $('#clientCompanyName').on('change', function() {

        var company_id=this.value;

        if(company_id){
            $.ajax({
                type: "POST",
                url: host+'/get/company-data',
                data: {
                    company_id:company_id
                },
                success: function(data){
                    //console.log(data);
                    $('#address').val(data.address);
                    //$('#address').val(data.address);
                    $('#district').val(data.district).trigger('change');
                    //$('#district').select2('data', {id: data.district, text: data.district});
                    $('#city').val(data.city);
                    $('#postcode').val(data.postcode);
                    $('#email').val(data.email);
                    $('#phone_no').val(data.phone_no);

                }
            });
        }

    });


    /**
     * print error message for form validation
     * @param {*} msg
     */
    function printErrorMsg (msg) {

        $.each( msg, function( key, value ) {
            //alert(key);
            jQuery('.error_'+key).parent().addClass('has-error');
            jQuery('.error_'+key).html(value);
            jQuery('.error_'+key).fadeIn();
        });

    }

    

    function printErrorMsgExpense (msg) {

      $.each( msg, function( key, value ) {
          //alert(key);
          jQuery('#save-expense .error_'+key).parent().addClass('has-error');
          jQuery('#save-expense .error_'+key).html(value);
          jQuery('#save-expense .error_'+key).fadeIn();
      });

    }

    function printErrorMsgIncome(msg) {

      $.each( msg, function( key, value ) {
          //alert(key);
          jQuery('#save-income .error_'+key).parent().addClass('has-error');
          jQuery('#save-income .error_'+key).html(value);
          jQuery('#save-income .error_'+key).fadeIn();
      });

    }

    

    $('#save-document').on('submit', function(e) {

        e.preventDefault();

        $(".ajax_loading").fadeIn();
        
        var formAction=this.action;

        // var formData = $(this).serialize();

        //var formData = new FormData($(this)[0]);

        var form = this,
        formData = new FormData(form);

        $(this).find('.error_message').html('');

        $(this).find('.has-error').removeClass("has-error");

        $.ajax({
            type: "POST",
            url: formAction,
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){

                $(".ajax_loading").fadeOut();

                if(data.status=='success'){

                  swal({
                        title: '',
                        text: data.message,
                        icon: "success"
                    }).then((value) => {
                      location.reload(true);
                    });

                }else{
                    console.log(data.errors);
                    printErrorMsg(data.errors);
                }
            }
        });

    });



    /**
     * Create folder
     */

    $('#create-folder').on('submit', function(e) {

        e.preventDefault();

        $(".ajax_loading").fadeIn();
        var formAction=this.action;
        var form = this,
        formData = new FormData(form);

        $(this).find('.error_message').html('');

        $(this).find('.has-error').removeClass("has-error");

        $.ajax({
            type: "POST",
            url: formAction,
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){

                $(".ajax_loading").fadeOut();

                if(data.status=='success'){

                  swal({
                        title: '',
                        text: data.message,
                        icon: "success"
                    }).then((value) => {
                      location.reload(true);
                    });

                }else{
                    console.log(data.errors);
                    printErrorMsg(data.errors);
                }
            }
        });

    });





});

/**
 * Delete Confirmation
 * @param {*} delete_url 
 */
function deleteConfirmation(delete_url) {
      
  swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this item!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      window.location.href = delete_url;
    } 
  });
  
};

/**
 * Delete Confirmation
 * @param {*} delete_url 
 */
function deleteCategory(delete_url) {
      
  swal({
    title: "Are you sure?",
    text: "Once deleted, you will not be able to recover this item!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
          url: delete_url,
          type: 'DELETE',
          success: function(data) {
            if(data.status=='success'){
              swal({
                  title: '',
                  text: data.message,
                  icon: "success"
              }).then((value) => {
                location.reload(true);
              });
            }

          }
      });
     
    } 
  });
  
};


