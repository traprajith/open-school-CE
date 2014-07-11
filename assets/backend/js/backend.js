/**
 *Convert a string to a Slug String
 *
 **/
function str2url(str,encoding,ucfirst)
{
    str = str.toUpperCase();
    str = str.toLowerCase();
    //For Vietnamese Unicode
    str = str.replace(/[\u00E1\u00E0\u1EA1\u00E2\u1EA5\u1EAD\u0103\u1EAF\u1EB7\u1EA7\u1EB1\u1EA3\u00E3\u1EA9\u1EAB\u1EB3\u1EB5]/g, 'a');
    str = str.replace(/[\u00ED\u00EC\u1ECB\u1EC9\u0129]/g, 'i');
    str = str.replace(/[\u00F3\u00F2\u1ECD\u1ECF\u00F5\u00F4\u1ED1\u1ED3\u1ED9\u1ED5\u1ED7\u01A1\u1EDB\u1EDD\u1EE3\u1EDF\u1EE1]/g, 'o');
    str = str.replace(/[\u00FA\u00F9\u1EE5\u1EE7\u0169\u01B0\u1EE9\u1EEB\u1EF1\u1EED\u1EEF]/g, 'u');
    str = str.replace(/[\u0065\u00E9\u00E8\u1EB9\u1EBB\u1EBD\u00EA\u1EBF\u1EC1\u1EC7\u1EC3\u1EC5]/g, 'e');
    str = str.replace(/[\u00FD\u1EF3\u1EF5\u1EF7\u1EF9]/g,'y');
    str = str.replace(/[\u0111]/g, 'd');
    str = str.replace(/[\u00E7\u0107\u0106]/g,'c');
    str = str.replace(/[\u0142\u0141]/g,'l');
    str = str.replace(/[\u015B\u015A]/g,'s');
    str = str.replace(/[\u017C\u017A\u017B\u0179]/g,'z');
    str = str.replace(/[\u00F1]/g,'n');
    str = str.replace(/[\u0153]/g,'oe');
    str = str.replace(/[\u00E6]/g,'ae');
    str = str.replace(/[\u00DF]/g,'ss');

    str = str.replace(/[^a-z0-9\s\'\:\/\[\]_]/g,'');
    str = str.replace(/[\s\'\:\/\[\]-]+/g,' ');
    str = str.replace(/[ ]/g,'-');

    if (ucfirst == 1) {
        c = str.charAt(0);
        str = c.toUpperCase()+str.slice(1);
    }
    
    if(str.charAt(str.length-1)=='-'){
        str=str.substring(0, str.length-1);
    }
    
    if(str.charAt(0)=='-'){
        str=str.substring(1, str.length);
    }

    return str;
}

/**
 *
 * Get the id before @ in an Email Address
 **/
function getIdinEmail(str_email){    
    var ind=str_email.indexOf("@");
    var my_slice=str_email.slice(0,ind);
    return my_slice
}

/**
 * Copy String From a Text Field to Another Text Field
 */
function CopyString(id_from,id_to,type){
    if(type=='slug'){
         $(id_from).keyup(function() {
	    $(id_to).val($(id_from).val().trim());
					    $(id_to).val(str2url($(id_from).val().trim()));
					});
	$(id_from).change(function() {
	    $(id_to).val($(id_from).val().trim());
					    $(id_to).val(str2url($(id_from).val().trim()));
					});
    } 
    
    if(type==''){
        $(id_from).keyup(function() {
	    $(id_to).val($(id_from).val().trim());
					    $(id_to).val($(id_from).val().trim());
					});
	$(id_from).change(function() {
	    $(id_to).val($(id_from).val().trim());
					    $(id_to).val($(id_from).val().trim());
					});
    }
    
    if(type=='email'){
          $(id_from).keyup(function() {
	    $(id_to).val($(id_from).val().trim());
					    $(id_to).val(getIdinEmail($(id_from).val().trim()));
					});
	$(id_from).change(function() {
	    $(id_to).val($(id_from).val().trim());
					    $(id_to).val(getIdinEmail($(id_from).val().trim()));
					});
    }
}

function autoResize(object){
        var newheight;        
        newheight=object.contentWindow.document.body.scrollHeight+100;         
        object.height= (newheight) + "px";

}
