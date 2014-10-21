 $(document).ready(function() {  
     $('input[type="text"], input[type="password"]').addClass("idleField");  
     $('input[type="text"], input[type="password"]').focus(function() {  
         $(this).removeClass("idleField").addClass("focusField");  
         if (this.value == this.defaultValue){  
             this.value = '';
         }  
		 if(this.name == "pass_txt"){
			 $(this).css('display', 'none');
			 $("#pass").css('display', 'block');
			 $("#pass").removeClass("idleField").addClass("focusField"); 
			 $("#pass").focus();
		 }
         if(this.value != this.defaultValue){  
             this.select();  
         }  
     });  
     $('input[type="text"], input[type="password"]').blur(function() {  
		 $(this).removeClass("focusField").addClass("idleField"); 
         if (!$(this).val()){ 
             this.value = (this.defaultValue ? this.defaultValue : '');  
			 if(this.name == "pass"){
				$(this).css('display', 'none');
				$("#pass_txt").css('display', 'block');
				$("#pass_txt").blur();
			 }
         }  
     });  
 });