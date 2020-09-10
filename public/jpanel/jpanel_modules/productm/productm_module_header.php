<?php if ($ckey != "MODULE_INCLUDE") exit("Error module loading");  ?>

<link rel="stylesheet" href="resources/lib/jquery_ui/smoothness/jquery-ui-1.10.4.custom.min.css"  />

<script src="resources/lib/jquery_ui/jquery-ui-1.10.4.custom.min.js" language="javascript" ></script>

<script>

	 $(function() {

		function split( val ) {

		  return val.split( /,\s*/ );

		}

		function extractLast( term ) {

		  return split( term ).pop();

		}

	 

		$("#tagbox" ).bind( "keydown", function( event ) {

			

			if ( event.keyCode === $.ui.keyCode.TAB &&

				$( this ).data( "ui-autocomplete" ).menu.active ) {

			  event.preventDefault();

			}

		  })

		  .autocomplete({

			source: function( request, response ) {

			  $.getJSON("jpanel/jpanel_modules/shopm/shopm_module_back.php", {

				term: extractLast( request.term )

			  }, response );

			},

			search: function() {

			  // custom minLength

			  var term = extractLast( this.value );

			  if ( term.length < 2 ) {

				return false;

			  }

			},

			focus: function() {

			  // prevent value inserted on focus

			  return false;

			},

			select: function( event, ui ) {

			  var terms = split( this.value );

			  // remove the current input

			  terms.pop();

			  // add the selected item

			  terms.push( ui.item.value );

			  // add placeholder to get the comma-and-space at the end

			  terms.push( "" );

			  this.value = terms.join( ", " );

			  return false;

			}

		  });

  });



</script>



<link rel="stylesheet" href="jpanel/jpanel_modules/productm/style/productm_module_style.css"  />

<script src="jpanel/jpanel_modules/productm/script/productm_module_script.js" language="javascript" ></script>