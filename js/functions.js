function setCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function deleteCookie(name) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function replaceURL(text) {
    return text.replace(/ /g, '-').replace(/:/g, '').replace(/'/g, '').toLowerCase();
}


/* Header */
$(document).ready(function(){
    $('body').on('click', '.head_login img', function(){
        if ($('.user_area').css('display') == "block") {
            $('.user_area').slideUp();
        } else {
            $('.user_area').slideDown();
        }
    });
});


/*  Menu Links  */
var scrollToElement = function(el, ms){
    var speed = (ms) ? ms : 600;
    $('html,body').animate({
        scrollTop: $(el).offset().top
    }, speed);
}


/*  Facebook Login  */

function connectToFacebook () {
  /*FB.getLoginStatus(function(response) {
      console.log(response.status);
      if (response.status === "unknown") {
          FB.login(function(response) {
              if (response.authResponse) {
               console.log('Welcome!  Fetching your information.... ');
               FB.api('/me', function(response) {
                 console.log('Good to see you, ' + response.name + '.');
               });
              } else {
               console.log('User cancelled login or did not fully authorize.');
              }
          });
      }
  });*/

  FB.login(function(response) {
      if (response.authResponse) {
       console.log('Welcome!  Fetching your information.... ');
       FB.api('/me', function(response) {
          checkLoginState();
       });
      }
  });
}


/*  Search Page  */

function SaveArticleIfNotExists(articleName, articleDescription, articleCategory, articlePageType) {
    var articleID = $.ajax({
        type: "GET",
        url: "./php/insertArticle.php",
        global: false,
        async:false,
        data: { articleName, articleDescription, articleCategory, articlePageType },
        success: function (response) {
            return response;
        }
    }).responseText;
    return articleID;
}

function GetDescription(nomeTopico, eqTopico) {
  function Aplica() {
    var data;
    for (var property in window.result.query.pages) {
        if (window.result.query.pages.hasOwnProperty(property)) {
            data = window.result.query.pages[property].extract;
            break;
        }
    }
    $('.search_temporary').eq(eqTopico).append('<div class="desc">' + data + '</div>');
  }


  $(document).ready(function(){
    $.ajax({
      type: "GET",
      url: "https://en.wikipedia.org/w/api.php?action=query&prop=extracts&format=json&exintro=&titles="+nomeTopico+"&callback=?",
      contentType: "application/json; charset=utf-8",
      async: false,
      dataType: "json",
      success: function (data, textStatus, jqXHR) {
          window.result = data;
          Aplica();
      },
      error: function (errorMessage) {
      }
    });
  });
}

function AppendInfos() {
  var titles = window.result.query.search;
  for (var i = 0; i < titles.length; i++) {
    $('.container').append(
      '<div class="search_temporary">'+
        '<a class="url" eq="'+i+'"><div class="nome"></div></a>'+
      '</div>');  
    $('.nome:last').append(titles[i].title);
    $('.url:last').attr('href', 'http://en.wikipedia.org/wiki/' + titles[i].title);
  }
  $('.url').each(function() {
    GetDescription($('.url').eq($(this).attr('eq')).text(), $(this).attr('eq'));

  }).promise().done(function(){
      Magic.FilterTags();       
  });
}