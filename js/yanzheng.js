	function validate_required(target){
    if (target.value==null||target.value=="") {
        return false;
    } else {
        return true;
    }
	}
	function valid_string_equal(str1,str2){
	    if(str1==str2){
	        return true;
	    }	
	    return false;
	}
	function valid_character(ch){
		if (ch>="0"&&ch<="9") {
        return false;
    } else {
        return true;
    }
	}
	function valid_length(str,min,max){
	  if(str.length>=min&&str.length<=max){
	      return true;
    } else {
        return false;
    }	
	}
	function validate_email(email){
    var apos=email.indexOf("@");
    if(apos==-1){
        return false;
    }  
    var dotpos=email.lastIndexOf(".");
    if (dotpos-apos<2) {
    	return false;
    }
    return true;
}
