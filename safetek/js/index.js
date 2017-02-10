$(document).ready(function(){
    // simple ajax calls function
    function myAjax(t, n, o, type = 'post') {
        var e = '';
        if (type == 'post') {
            var id = $(t).attr("id");
            var query = $(t).attr("query");
            var value = $(t).attr("value");
            var e = 'id='+ encodeURIComponent(id) + '&query='+ encodeURIComponent(query) + '&value='+ encodeURIComponent(value);
        }else if(type == 'form'){
            var e = new FormData(t);

        }

        if (type == 'post') {

            $.ajax({
                type: "POST",
                url: n,
                data: e,
                dataType: "html",
                beforeSend: function() {
                },
                success: function(t) {
                    $(o).html(t).show() 
                }
            });
        }else if (type == 'form'){
            $.ajax({
                type: "POST",
                url: n,
                data: e,
                cache: !1,
                contentType: !1,
                processData: !1,
                beforeSend: function() {
                },
                success: function(t) {
                    $(o).html(t).show()
                },
                error: function(t) {
                    console.log("something's wrong")
                }
            });
        }
    }

    /*realtime search function*/
    function getStates(thisInput){
      var id = $(thisInput).attr("id");
      var value = $(thisInput).val();
      var destination = $(thisInput).attr("destination");
      var output = $(thisInput).attr("output");

      $.post(destination, {srch:value, idAttr:id},function(data){
        $(output).html(data);
      });
    };


    $(document).on("submit", "#signupForm", function(e){
        e.preventDefault();
        myAjax(this, "http://localhost/safetek/logs/processing.php", "#feedback", "form");
    });

    $(document).on("submit", "#loginForm", function(e){
        e.preventDefault();
        myAjax(this, "http://localhost/safetek/logs/processing.php", "#feedback", "form");
    });

    $(document).on("keyup", "#searchInput", function(e){
        getStates(this);
    });

    $(document).on("click", ".createGroup", function(e){
        e.preventDefault();
        myAjax(this, "http://localhost/safetek/group/new/new.php", ".joinContainer");
    });

    $(document).on("submit", "#createForm", function(e){
        e.preventDefault();
        myAjax(this, "http://localhost/safetek/group/new/new.php", "#feedback", "form");
    })
});
