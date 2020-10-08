

(function ($) {
  "use strict";

  
  /////////////////////////////////////////////////// slider

  



  $('.profile_image').find('img').each(function () {
    var imgClass = (this.width / this.height > 1) ? 'wide' : 'tall';
    $(this).addClass(imgClass);
  })




  $(document).ready(function () {
    $('#preloader').css('display', 'none')
    if($('body').hasClass('page-template-chat_page')){

      $.ajax({
        url: ajax_login_object['site_url'] +  '/inc/chat_ajax.php?action=getChat',
        dataType: 'json',
        success: function(response) {       
          $('#pagination-container').pagination({
            dataSource: response,
            pageSize: 10,
            prevText: 'Previous',
            nextText: 'Next',
            callback: function(data) {
              $.ajax({
                url: ajax_login_object['site_url'] +  '/inc/chat_ajax.php?action=notification_chat',
                dataType: 'json',
                success: function(response) {       
        
                    response.forEach((element) => {
                      let user_id = element.user_id;
                      $('[user_id=' + user_id + ']').children().append('<i class="fa fa-envelope blinks"></i>')
                      $('[user_id=' + user_id + ']').css(':nth-child(1)', 'order: 1;')  
                    })
                },
                error: function(req, status, err) {
                  console.log('Something went wrong', status, err);
                }
              });
                var html = simpleTemplating(data);
                $('#users').html(html);
                fuck()
            }
          })


          
          
        },
        error: function(req, status, err) {
          console.log('Something went wrong', status, err);
        }
      });

      //Getting notification


      
    }


    $('#ok_status').hover(function () {
      $(this).fadeOut();
    })


    $('.click_item').on('click', function () {
      var thisid = $(this).children().data('id');
      window.location.location = '/profile/?w1=' + thisid;
      $(this).children().attr('href', window.location.location);
    });







    if (!$('body').hasClass('home')) {
      var menuBoxes = document.getElementsByClassName('mega-menu');
      for (var i = 0; i < menuBoxes.length; i++) {
        menuBoxes[i].onmouseover = function (e) {
          var color = '#' + Math.floor(Math.random() * 16777215).toString(16);
          var colorString = '0px 0px 30px 0px ' + color;
          this.style['box-shadow'] = colorString;
          this.style['-webkit-box-shadow'] = colorString;
          this.style['-moz-box-shadow'] = colorString;
          var letters = '0123456789ABCDEF';
          var color = '#';
          for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
          }
          this.style['background-color'] = color;
        }
      }
      var topbar = document.getElementsByClassName('topbar')
      topbar.onmouseover = function (e) {
        this.style['background-color'] = 'green';
      }
      $('#respond').addClass('container');
    }
    //  FEMALE
    if ($('.gender_hidden').val() == 'Female') {
      $('body').addClass('Female')
      $('.the_quest').html('My Quest for Guys')
      $('.soul_text').html('Search for men to fulfill your dreams.....')
    }
    //  MALE
    if ($('.gender_hidden').val() == 'Male') {
      $('body').addClass('male')
      $('.the_quest').html("My Quest for Girls")
      $('.soul_text').html('Search for women to fulfill your fantasies.....')

    }
    if ($('.gender_hidden').val() == '') {
      $('section').css('background', 'linear-gradient(90deg, #26a8fe, #f73af9)')
      $('body').addClass('guest')
      $('.my_blogs').mouseenter(function () {
        $('.pl_login').fadeIn("fast", function () {
          $(this).delay(1000).fadeOut("slow");
        });

      })

      //WHEEL CLICK EVENTS
      $('.profile-item').on('click', function (e) {
        e.preventDefault();
        if ($(this).data('id') == 'female') {
          if (!$(this).children().hasClass('meet_user_female')) {
            $(this).prepend('<div class="meet_user_female">To meet this girl, Join the Quest!</div>')
          }
        }
        if ($(this).data('id') == 'male') {
          if (!$(this).children().hasClass('meet_user_male')) {
            $(this).prepend('<div class="meet_user_male">To meet this guy, Join the Quest!</div>')
          }

        }
      })
      $('.profile-itme').off('mouseover', function () {
        $(this).children().removeClass('meet_user')
      })











      $('.the_quest').html('Join The Quest')
      $('.create_male').html('Guys Click Here')
      $('.search_female').html('Girls Click Here')
      $('.girls_link').removeAttr('rel')
      $('.girls_link').attr('href', $('.female_page_hidden').val())
      $('.guys_link').attr('href', $('.male_page_hidden').val())




    }
    $('.blocker').on('click', function () {
      $(this).css('z-index', 100)
      $(this).css('background', 'green')
    })

    if ($('body').hasClass('home')) {
      $('.footer_links').css('display', 'block')
    }


    

    $(".write_msg").emojioneArea({pickerPosition: "bottom"});
    $(".write_message_profile").emojioneArea({
      pickerPosition: "bottom",
      events: {
        keyup: function (editor, event) {

          var url = '/wp-content/themes/dating/inc/chat_ajax.php?action=SendMessageFromProfile&message=';
          var message = $(".emojionearea-editor").data("emojioneArea").getText();

          var reciever_id = $('.write_message_profile').attr('reciever_id');
          var reciever = $('.write_message_profile').attr('id_attr');
          // catches everything but enter
          if (event.which == 13) {

            $.post(url + message + '&reciever=' + reciever + '&reciever_id=' + reciever_id,
              function (response) {
                loadChat();
                $('.write_message_profile').val('');
                $('.emojionearea-editor').text('');
              });
          } else {
            //alert("Key pressed: " + event.which);
          }
        }
      }
    });


    //3D carousel


    // set and cache variables
    var w, container, carousel, item, radius, itemLength, rY, ticker, fps;
    var mouseX = 0;
    var mouseY = 0;
    var mouseZ = 0;
    var addX = 0;


    // fps counter created by: https://gist.github.com/sharkbrainguy/1156092,
    // no need to create my own :)
    var fps_counter = {

      tick: function () {
        // this has to clone the array every tick so that
        // separate instances won't share state 
        this.times = this.times.concat(+new Date());
        var seconds, times = this.times;

        if (times.length > this.span + 1) {
          times.shift(); // ditch the oldest time
          seconds = (times[times.length - 1] - times[0]) / 1000;
          return Math.round(this.span / seconds);
        } else return null;
      },

      times: [],
      span: 20
    };
    var counter = Object.create(fps_counter);



    $(document).ready(init)

    function init() {
      w = $(window);
      container = $('#contentContainer');
      carousel = $('#carouselContainer');
      item = $('.carouselItem');
      itemLength = $('.carouselItem').length;
      fps = $('#fps');
      rY = 360 / itemLength;
      radius = Math.round((250) / Math.tan(Math.PI / itemLength));

      // set container 3d props
      TweenMax.set(container, {
        perspective: 600
      })
      TweenMax.set(carousel, {
        z: -(radius)
      })

      // create carousel item props

      for (var i = 0; i < itemLength; i++) {
        var $item = item.eq(i);
        var $block = $item.find('.carouselItemInner');

        //thanks @chrisgannon!        
        TweenMax.set($item, {
          rotationY: rY * i,
          z: radius,
          transformOrigin: "50% 50% " + -radius + "px"
        });

        animateIn($item, $block)
      }

      // set mouse x and y props and looper ticker
      window.addEventListener("mousemove", onMouseMove, false);
      ticker = setInterval(looper, 1000 / 60);
    }

    function animateIn($item, $block) {
      var $nrX = 360 * getRandomInt(2);
      var $nrY = 360 * getRandomInt(2);

      var $nx = -(2000) + getRandomInt(4000)
      var $ny = -(2000) + getRandomInt(4000)
      var $nz = -4000 + getRandomInt(4000)

      var $s = 1.5 + (getRandomInt(10) * 2)
      var $d = 1 - (getRandomInt(8) * .1)

      TweenMax.set($item, {
        autoAlpha: 1,
        delay: $d
      })
      TweenMax.set($block, {
        z: $nz,
        rotationY: $nrY,
        rotationX: $nrX,
        x: $nx,
        y: $ny,
        autoAlpha: 0
      })
      TweenMax.to($block, $s, {
        delay: $d,
        rotationY: 0,
        rotationX: 0,
        z: 0,
        ease: Expo.easeInOut
      })
      TweenMax.to($block, $s - .5, {
        delay: $d,
        x: 0,
        y: 0,
        autoAlpha: 1,
        ease: Expo.easeInOut
      })
    }

    function onMouseMove(event) {
      mouseX = -(-(window.innerWidth * .5) + event.pageX) * .00125;
      mouseY = -(-(window.innerHeight * .5) + event.pageY) * .002;
      mouseZ = -(radius) - (Math.abs(-(window.innerHeight * .5) + event.pageY) - 200);
    }

    // loops and sets the carousel 3d properties
    function looper() {
      addX += mouseX
      TweenMax.to(carousel, 1, {
        rotationY: addX,
        rotationX: mouseY,
        ease: Quint.easeOut
      })
      TweenMax.set(carousel, {
        z: mouseZ
      })
      fps.text('Framerate: ' + counter.tick() + '/60 FPS')
    }

    function getRandomInt($n) {
      return Math.floor((Math.random() * $n) + 1);
    }



    $('#profile_carousel').owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      items: 4
    });




    $('.click_to_open').on('click', function () {
      $(this).parent().fadeOut();
      $('.jewelry_opened').delay(300).fadeIn(2000)
    })




    $('.yellow').css('display', 'block')
    $('.mesgs').css('padding', '0')
    $('.arrow').css('display', 'none')



    $('.priv_image_link').on('click', function () {
      $('.private_imgs_click').css('display', 'block')
      $('.private_video_coll').css('display', 'none')

    })
    $('.priv_video_link').on('click', function () {
      $('.private_imgs_click').css('display', 'none')
      $('.private_video_coll').css('display', 'block')
    })







    var vid = [];
    var unvid = [];
    var del = [];
    var klir = [];
    var puc = [];


    $('.save_btn').fadeOut()
    $('.secret_image').on('click', function () {
      var imgid = $(this).attr('imgsrc');
    })

    $('.image_checkbox').on('click', function () {
      var zyu = $(this).attr('privatr')
      $(this).val('Click on Save button')
      $(this).css('background-color', 'red')
      klir.push(zyu);
      $('.es_inchae').val(klir)

    })


    $('.unset_private').on('click', function () {
      var zyu = $(this).attr('privatr')
      $(this).val('Click on Save button')
      puc.push(zyu);
      $(this).css('background-color', 'red')
      $('.esim_incha').val(puc)
    })

    $('.video_button').on('click', function () {
      $('.save_btn').fadeIn('slow', function () {
       $(this).delay(500).fadeOut('slow');
      });
      var vl = $('#html5gallery-elem-html5-video-0').attr('src')

      vid.push(vl)
      $('.video_click').val(vid)
    })
    $('.unset_video_button').on('click', function () {
      $('.save_btn').fadeIn('slow', function () {

        $(this).delay(500).fadeOut('slow');
      });
      var vl = $('#html5gallery-elem-html5-video-0').attr('src')
      unvid.push(vl)
      $('.unset_video_click').val(unvid)
    })
    $('.delete_video').on('click', function () {
      $('.save_btn').fadeIn('slow', function () {

        $(this).delay(500).fadeOut('slow');
      });
      var vl = $('#html5gallery-elem-html5-video-0').attr('src')
      del.push(vl)
      $('.delete_vid').val(del)
    })





    // Find soul
    $('select').each(function () {
      var $this = $(this),
        numberOfOptions = $(this).children('option').length;

      $this.addClass('select-hidden');
      $this.wrap('<div class="select"></div>');
      $this.after('<div class="select-styled"></div>');

      var $styledSelect = $this.next('div.select-styled');
      $styledSelect.text($this.children('option').eq(0).text());

      var $list = $('<ul />', {
        'class': 'select-options'
      }).insertAfter($styledSelect);

      for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
          text: $this.children('option').eq(i).text(),
          rel: $this.children('option').eq(i).val()
        }).appendTo($list);
      }

      var $listItems = $list.children('li');

      $styledSelect.click(function (e) {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function () {
          $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').toggle();
      });

      $listItems.click(function (e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
        // console.log($this.val());
      });

      $(document).click(function () {
        $styledSelect.removeClass('active');
        $list.hide();
      });

    });
var iamge_ids = []
$('.lenta-item-inner').on('click', function(e){
  e.preventDefault()
  $(this).css('filter', 'blur(3px)')
  $(this).siblings('.prevent_delete').css('display', 'block')
  $(this).siblings('.prevent_delete').contextmenu(function(e) {
    e.preventDefault()
    $(this).css('color', 'red')
    $(this).text('Click SAVE button')
    if($.inArray($(this).attr('image-id'),iamge_ids) == -1){iamge_ids.push($(this).attr('image-id'))}
    $('.delete_image').val(JSON.stringify(iamge_ids))

  });
 
})


$('.upload_form input').change(function () {
  $('.upload_form p').text(this.files.length + " file(s) selected");
  $('.show_images').empty()
  for(var i = 0; i < this.files.length; i++){
    console.log(this.files[i])
 $('.show_images').append("<img src="+URL.createObjectURL(this.files[i]) + ">")
}

});
    


$(".save_button_after_preview").mouseenter(function(){
  clearTimeout($(this).data('timeoutId'));
  $('.kayfavat').css('display', 'block')
}).mouseleave(function(){
  var someElement = $(this),
      timeoutId = setTimeout(function(){
        $('.kayfavat').css('display', 'none')
      }, 950);
  //set the timeoutId, allowing us to clear this trigger if the mouse comes back over
  someElement.data('timeoutId', timeoutId); 
});



$('.save_button_after_preview').on('click', function(){

  $('.saved_after_click').fadeIn('slow', function () {
    $(this).delay(500).fadeOut('slow');
   });


  $('.profile_images').css('display', 'block')
$('.upload_img').css('display', 'block')
$('.pci_vor').addClass('pci_maz')

})
//Save button
$('.save_button_after_preview').on('click', function(){

    jQuery.ajax({
    url: '/wp-admin/admin-ajax.php',
        type: 'post',
        
        data: {
          action:'update_user_info',
          'ethnicity':$("input[name='ethnicity']").val(),
          'hair_color': $("label[for='hair_color']").siblings('.select').children('.select-styled').text(),
          'size': $("label[for='size']").siblings('.select').children('.select-styled').text(),
          'puc':$("input[name='puc']").val(),
          'education': $("label[for='education']").siblings('.select').children('.select-styled').text(),
          'looking_for': $("label[for='looking_for']").siblings('.select').children('.select-styled').text(),
          'user_tatoo': $("label[for='user_tatoo']").siblings('.select').children('.select-styled').text(),
          'piercings': $("label[for='piercings']").siblings('.select').children('.select-styled').text(),
          'relationship': $("label[for='relationship']").siblings('.select').children('.select-styled').text(),
          'income': $("label[for='income']").siblings('.select').children('.select-styled').text(),
          'smoking': $("label[for='smoking']").siblings('.select').children('.select-styled').text(),
          'eye_color': $("label[for='eye_color']").siblings('.select').children('.select-styled').text(),
          'drinking': $("label[for='drinking']").siblings('.select').children('.select-styled').text(),
          'delete_image': $('.delete_image').val(),
          'first_name':$("input[name='first_name']").val(),
          'last_name':$("input[name='last_name']").val(),
          'email':$("input[name='email']").val(),
          'pwd1': $("input[name='pwd1']").val(),
          'pwd2': $("input[name='pwd2']").val(),
          'pwd3': $("input[name='pwd3']").val(),
          'about_me':$("textarea[name='about_me']").val(),
          'looking_for_in':$("textarea[name='looking_for_in']").val()
        },
        success:function(data) {
          
           console.log($.parseJSON(data));
            console.log("success!");
        },
        error: function(errorThrown){
            console.log(errorThrown);
            console.log("fail");
        }
  });
  })


//Preview button
$('.kayfavat').on('click', function(){
$('.profile_images').css('display', 'none')
$('.upload_img').css('display', 'none')
$('.pci_maz').addClass('pci_vor').removeClass('pci_maz')

  jQuery.ajax({
  url: '/wp-admin/admin-ajax.php',
      type: 'post',
      
      data: {
        action:'update_user_info',
        'ethnicity':$("input[name='ethnicity']").val(),
        'hair_color': $("label[for='hair_color']").siblings('.select').children('.select-styled').text(),
        'size': $("label[for='size']").siblings('.select').children('.select-styled').text(),
        'puc':$("input[name='puc']").val(),
        'education': $("label[for='education']").siblings('.select').children('.select-styled').text(),
        'looking_for': $("label[for='looking_for']").siblings('.select').children('.select-styled').text(),
        'user_tatoo': $("label[for='user_tatoo']").siblings('.select').children('.select-styled').text(),
        'piercings': $("label[for='piercings']").siblings('.select').children('.select-styled').text(),
        'relationship': $("label[for='relationship']").siblings('.select').children('.select-styled').text(),
        'income': $("label[for='income']").siblings('.select').children('.select-styled').text(),
        'smoking': $("label[for='smoking']").siblings('.select').children('.select-styled').text(),
        'eye_color': $("label[for='eye_color']").siblings('.select').children('.select-styled').text(),
        'drinking': $("label[for='drinking']").siblings('.select').children('.select-styled').text(),
        'delete_image': $('.delete_image').val(),
        'first_name':$("input[name='first_name']").val(),
        'last_name':$("input[name='last_name']").val(),
        'email':$("input[name='email']").val(),
        'pwd1': $("input[name='pwd1']").val(),
        'pwd2': $("input[name='pwd2']").val(),
        'pwd3': $("input[name='pwd3']").val(),
        'about_me':$("textarea[name='about_me']").val(),
        'looking_for_in':$("textarea[name='looking_for_in']").val()
      },
      success:function(data) {
        
         console.log($.parseJSON(data));
          console.log("success!");
      },
      error: function(errorThrown){
          console.log(errorThrown);
          console.log("fail");
      }
});
})








// Make the DIV element draggable:


dragElement(document.getElementById("small_window"));

function dragElement(elmnt) {
  if(elmnt !== null){
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    // if present, the header is where you move the DIV from:
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    // otherwise, move the DIV from anywhere inside the DIV:
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
}









  });

  //variable






})(jQuery);