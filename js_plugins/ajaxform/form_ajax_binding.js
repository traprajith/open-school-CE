/**
 * Binding ajax behavior to form submission.
 * User: Spiros Kabasaskalis,kabasakalis@gmail.com,www.reverbnation/spiroskabasakalis.com.
 * Date: 11/29/11
 * Time: 8:43 AM
 * This js file is binding ajax behavior to  the form submission  using the jquery form plugin.(http://jquery.malsup.com/form/#getting-started)
 * With this plugin it is possible to include file fields in the form-they will be submitted without a page refresh,
 * though this is technically not ajax,(since this is not possible with xhr object).The plugin uses a technique involving an iframe.
 * If you intend to include a  file field in your form,read more in the link below.
 * http://jquery.malsup.com/form/#file-upload
 *
 */
$(function () {

    //used to provide feedback for atrribute client validation
    $.js_afterValidateAttribute = function(form, attribute, data, hasError) {
        if (!hasError) {
            $("#success-" + attribute.id).fadeIn(500);
            $("label[for=" + attribute.id + "]").removeClass("error");
        } else {
            $("label[for=" + attribute.id + "]").addClass("error");
            $("#success-" + attribute.id).fadeOut(500);
        }
    };


    //this function hijacks regular form submission and turns it into ajax submission with jquery form plugin.
    $.js_afterValidate = function(form, data, hasError) {
        if (!hasError) {
            $.submit_ajax();
            return false;
        } //if has not error submit via ajax
        else {
            return false;
        }
    };

    // post-submit callback.
    function showResponse(responseText, statusText, xhr, $form) {
      //  console.log(responseText);
        if (responseText.success == true) {
            $("#success-note")
                .fadeOut(1000, "linear", function() {
                    $(this)
                        .fadeIn(2000, "linear")
                }
            );
            $("#ajax-form  > form").slideToggle(1500);
         
        }
        else {
            $("#error-note")
                .hide()
                .show()
                .css({"opacity": 1 })
        }
    } ;

  //options for the ajax form submission
    var options = {
        success:       showResponse,  // post-submit callback
      dataType:  'json'   ,     // 'xml', 'script', or 'json' (expected server response type)
    //   iframe:true, //please read jquery form plugin documentaion for this option.
        // $.ajax options can be used here too.
        beforeSend : function() {
            $(".grid-view").addClass("ajax-sending");
        },
        complete : function() {
            $(".grid-view").removeClass("ajax-sending");
        }
    };

    $.submit_ajax = function() {
        $('#ajax-form > form').ajaxSubmit(options)
    };

});

