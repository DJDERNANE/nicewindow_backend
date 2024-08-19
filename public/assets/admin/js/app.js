function toggleSidebar() {
  let windowWidth = $(window).width();
  let sidebarWidth = $('#sidebar').width();
  let bodyWidth = $('#admin-body').width();
  let newSidebarWidth = 100;

  if(windowWidth <= 400)
  {
    $('.sidebar').slideToggle(0);
  }
  else
  {
    if(sidebarWidth > 100)
    {
      setTimeout(function() {
        $('.sidebar-brand-img').fadeIn(100);
      }, 400);

      $('.sidebar-logo').css({padding: '3px 1.5rem'});
      $('.se-txt, .se-icon, .sidebar-logo-img').hide(0);
      $('#sidebar').css({width: '100px'});
      $('#admin-body').css({marginRight: '100px'});
      $('.collapse').removeClass('show');
    }
    else
    {
      $('.sidebar-brand-img').hide(0);
      $('.sidebar-logo-img').show(0);
      $('.sidebar-logo').css({padding: '3px 3rem'});
      $('#sidebar').css({width: '20%'});
      $('#admin-body').css({marginRight: '20%'});
      setTimeout(function() {
        $('.se-txt, .se-icon').show(0);
      }, 100);
    }
  }
}

$(document).ready(function() {
  /******** START click events *********/
  // notifications box
  $('.header-notification-icon').click(function() {
    $('.header-account-list, .header-messages-list').hide(0);
    $('.header-notifications-list').slideToggle(100);
  });

  // profile list
  $('.header-list-profile').click(function() {
    $('.header-notifications-list, .header-messages-list').hide(0);
    $('.header-account-list').slideToggle(100);
  });

  //m messages list
  $('.header-message-icon').click(function() {
    $('.header-account-list, .header-notifications-list').hide(0);
    $('.header-messages-list').slideToggle(100);
  });
  /******** END click events *********/

  /*********** START hover events **********/
  $('#sidebarElements').hover(function() {
    let width = $('#sidebar').width();

    if(width <= 110)
    {
      $('#sidebar').css({position: 'fixed', width: '20%', zIndex: '10'});
      $('.sidebar-brand-img').hide(0);
      $('.sidebar-logo-img').show(0);
      $('.sidebar-logo').css({padding: '3px 3rem'});
      setTimeout(function() {
        $('.se-txt, .se-icon').show(0);
      }, 100);
    }
  });
  /*********** END hover events **********/

  /************ START MOUSELEAVE events  ***************/
  $('#sidebarElements').mouseleave(function() {
    let bodyWidth = $('#admin-body').width();

    // 1200          1300
    if(Number(bodyWidth) > Number($(window).width())-Number(150))
    {
      setTimeout(function() {
        $('.sidebar-brand-img').fadeIn(100);
      }, 400);

      $('.sidebar-logo').css({padding: '3px 1.5rem'});
      $('.se-txt, .se-icon, .sidebar-logo-img').hide(0);
      $('#sidebar').css({width: '100px'});
      $('#admin-body').css({marginRight: '100px'});
      $('.collapse').removeClass('show');
    }
  });
  /************ END MOUSELEAVE events  ***************/
});

$(document).mouseup(function(e) 
{
  var container = $('.one-dropdown-container');
  var dropdown = $(".one-dropdown");

  // if the target of the click isn't the container nor a descendant of the container
  if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0 && !container.is(e.target) && container.has(e.target).length === 0)
  {
    dropdown.hide();
  }
});

function readURL(input, img) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(img)
          .attr('src', e.target.result)
          .attr('style', 'display:block!important;left:0;');
    };

    reader.readAsDataURL(input.files[0]);
  }
}