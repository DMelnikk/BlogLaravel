/**************************************
    File Name: custom.js
    Template Name: Markedia
    Created By: HTML.Design
    http://themeforest.net/user/wpdestek
**************************************/

(function($) {
    "use strict";
    $(document).ready(function() {
        $('#nav-expander').on('click', function(e) {
            e.preventDefault();
            $('body').toggleClass('nav-expanded');
        });
        $('#nav-close').on('click', function(e) {
            e.preventDefault();
            $('body').removeClass('nav-expanded');
        });
    });

    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('.carousel').carousel({
        interval: 4000
    })

    $(window).load(function() {
        $("#preloader").on(500).fadeOut();
        $(".preloader").on(600).fadeOut("slow");
    });

    jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 1) {
            jQuery('.dmtop').css({bottom:"25px"});
        } else {
            jQuery('.dmtop').css({bottom:"-100px"});
        }
    });
    jQuery('.dmtop').click(function(){
        jQuery('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });


    $('.comment-form').on('submit', function(e) {
       e.preventDefault();

       let iziModalAlertSuccess = $('.iziModal-alert-success');
       let iziModalAlertError = $('.iziModal-alert-error');

       iziModalAlertSuccess.iziModal({
          padding: 20,
          title: 'Success',
          headerColor: '#00897b'
       });

        iziModalAlertError.iziModal({
            padding: 20,
            title: 'Error',
            headerColor: '#e53935'
        });

       let form = $(this);
       let btn = form.find('button');
       let btnText = btn.text();
       let commentsList = $('.comments-list');

       $.ajax({
           url: form.attr('action'),
           type: 'POST',
           data: form.serialize(),
           beforeSend: function() {
             btn.prop('disabled', true).text('Loading...');
           },
           success: function (res) {
               if(res.status === 'success') {
                   iziModalAlertSuccess.iziModal(
                    'setContent',{
                        content: res.data,
                       }
                   );
                   iziModalAlertSuccess.iziModal('open');
                   form.trigger('reset');
                   commentsList.prepend(res.comment);
                   $('html,body').animate({
                      scrollTop: $('#comments').offset().top
                   },500);
               } else {
                   iziModalAlertError.iziModal(
                       'setContent',{
                           content: res.data,
                       }
                   );
                   iziModalAlertError.iziModal('open');
               }
               btn.prop('disabled', false).text(btnText);
           },
           error: function () {
               alert('Something went wrong!');
               btn.prop('disabled', false).text(btnText);
           }
       });
    });

})(jQuery);


function openCategory(evt, catName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(catName).style.display = "block";
    evt.currentTarget.className += " active";
}
