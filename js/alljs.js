$(document).ready(function(){ //Questo ci permette di scrivere il codice JQuery dove vogliamo, appena si e caricata la pagina la funzionalita inizia di funzionare

    
    $('.navbar-brand').mouseenter(function(){
      $('.chnageit').css('color','#21c7e1');
      $('.navbar-brand i').animate({fontSize:"28px"},1000);
      $('.nav-link').animate({fontSize:"18px"},1000);
      $('.nav-link').css('color','#21c7e1');
    }).mouseleave(function() {
      $('.chnageit').css('color','#ffffff');
      $('.navbar-brand i').animate({fontSize:"20px"},1000);
      $('.nav-link').css('color','#55595c');
      $('.nav-link').animate({fontSize:"16px"},1000);
    });

    //Trailer Sort

    //var seletedVal = $(".form-control option:selected").text();
    $('.form-control').change(function(){ //For any chnage of the select and selects from the select filed.
      var selectVal = $(this).val(); //Takes the values of select and puts it to selectVal
      $.ajax({
        url: 'sort.php',
        type:'POST',
        data: {'genere': selectVal},
        success: function(response){
          $(".row-cols-md-5").fadeOut('slow',function() { //with a callback_function, This callback function executes when the fade out effect is complete. You can use this to set alert or display a message on the screen when fadeout effect is complete.
            $(".row-cols-md-5").html(response);
            $(".row-cols-md-5").fadeIn('slow');
          });
        }
      });
    });

    //Trailer Info

    //$('.movieopen').click(function(){
    $(document).on('click','.movieopen',function() { // Attach an event handler function for one or more events to the selected elements
      var movtitle = $(this).data('title');
      var idmov = $(this).data('id');
      $('.modal-title').text(movtitle);
      // AJAX request
      $.ajax({
      url: 'trailerInfo.php',
      type: 'POST',
      data: {'postID': idmov}, //Sends to trailerInfo the idmov with the name postID that will be avaiable in side server.
      success: function(response){  //in response we get all the returned info from trailerInfo.php 
        // Add response in Modal body
        //document.getElementById(".modal-body").innerHTML =response;
        $('.modal-body').html(response);
        // Display Modal
        $('#movieModal').modal('show'); 
        var url = $("#getyt").attr('src');
        $('#movieModal').on('hide.bs.modal', function(){
        $('#getyt').attr('src', '');
        });
      }
    });
    //Return false to cancel submit
    return false;
    });

    //Trailer Editing

        $('button#editbutton').click(function(){
        //$(document).on('click','.movieopen',function() { //Attach an event handler function for one or more events to the selected elements,will bind on all element .movieopen that are not presented at the time of biding event.
            var movtitle = $(this).data('title');
            var idmov = $(this).data('id');
            $('.modal-title').text(movtitle);
            // AJAX request
            $.ajax({
            url: 'edittrailer.php',
            type: 'POST',
            data: {'postID': idmov}, //Sends to trailerInfo the idmov with the name postID that will be avaiable in side server.
            success: function(response){  //in response we get all the returned info from trailerInfo.php 
              // Add response in Modal body
              //document.getElementById(".modal-body").innerHTML =response;
              $('.modal-body').html(response);
              // Display Modal
              $('#movieModal').modal('show'); 
            }
          });
          //Return false to cancel submit
          return false;
    });
});