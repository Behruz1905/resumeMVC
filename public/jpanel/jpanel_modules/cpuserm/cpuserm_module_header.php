<script>
	$(document).ready(function(e) {
        
		$("#add_button").click(function(e) {
            if($("#login").val() != "") {
				if($("#password").val() == $("#re_password").val()){
					$("#add_form").submit();
				} else {
					alert("Parol ve tekrar parol eyni olmalidir");	
				}
			} else {
				alert("Logini daxil edin.");	
				$("#login").focus();
			}
        });
		
		$("#add_button_type").click(function(e) {
            if($("#type").val() != "" && $("#code").val() != "") {
				$("#add_form_type").submit();
			} else {
				alert("Parametrleri daxil edin.");	
				$("#type").focus();
			}
        });
		
		$("#user_type").change(function() {
		  	 if($(this).val() == "AI") {
				 $("#aptek_tr").show();
			 } else {
				$("#aptek_tr").hide();
			 }
		});

		
    });
</script>
<link rel="stylesheet" href="jpanel/jpanel_style/portlet_style.css" />
