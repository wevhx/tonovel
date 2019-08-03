!function(t){var e=function(e){this._options={checkOnLoad:!1,resetOnEnd:!1,loopCheckTime:50,loopMaxNumber:5,baitClass:"pub_300x250 pub_300x250m pub_728x90 text-ad textAd text_ad text_ads text-ads text-ad-links",baitStyle:"width: 1px !important; height: 1px !important; position: absolute !important; left: -10000px !important; top: -1000px !important;",debug:!1},this._var={version:"3.2.1",bait:null,checking:!1,loop:null,loopNumber:0,event:{detected:[],notDetected:[]}},void 0!==e&&this.setOption(e);var o=this,i=function(){setTimeout(function(){o._options.checkOnLoad===!0&&(o._options.debug===!0&&o._log("onload->eventCallback","A check loading is launched"),null===o._var.bait&&o._creatBait(),setTimeout(function(){o.check()},1))},1)};void 0!==t.addEventListener?t.addEventListener("load",i,!1):t.attachEvent("onload",i)};e.prototype._options=null,e.prototype._var=null,e.prototype._bait=null,e.prototype._log=function(t,e){console.log("[BlockAdBlock]["+t+"] "+e)},e.prototype.setOption=function(t,e){if(void 0!==e){var o=t;t={},t[o]=e}for(var i in t)this._options[i]=t[i],this._options.debug===!0&&this._log("setOption",'The option "'+i+'" he was assigned to "'+t[i]+'"');return this},e.prototype._creatBait=function(){var e=document.createElement("div");e.setAttribute("class",this._options.baitClass),e.setAttribute("style",this._options.baitStyle),this._var.bait=t.document.body.appendChild(e),this._var.bait.offsetParent,this._var.bait.offsetHeight,this._var.bait.offsetLeft,this._var.bait.offsetTop,this._var.bait.offsetWidth,this._var.bait.clientHeight,this._var.bait.clientWidth,this._options.debug===!0&&this._log("_creatBait","Bait has been created")},e.prototype._destroyBait=function(){t.document.body.removeChild(this._var.bait),this._var.bait=null,this._options.debug===!0&&this._log("_destroyBait","Bait has been removed")},e.prototype.check=function(t){if(void 0===t&&(t=!0),this._options.debug===!0&&this._log("check","An audit was requested "+(t===!0?"with a":"without")+" loop"),this._var.checking===!0)return this._options.debug===!0&&this._log("check","A check was canceled because there is already an ongoing"),!1;this._var.checking=!0,null===this._var.bait&&this._creatBait();var e=this;return this._var.loopNumber=0,t===!0&&(this._var.loop=setInterval(function(){e._checkBait(t)},this._options.loopCheckTime)),setTimeout(function(){e._checkBait(t)},1),this._options.debug===!0&&this._log("check","A check is in progress ..."),!0},e.prototype._checkBait=function(e){var o=!1;if(null===this._var.bait&&this._creatBait(),(null!==t.document.body.getAttribute("abp")||null===this._var.bait.offsetParent||0==this._var.bait.offsetHeight||0==this._var.bait.offsetLeft||0==this._var.bait.offsetTop||0==this._var.bait.offsetWidth||0==this._var.bait.clientHeight||0==this._var.bait.clientWidth)&&(o=!0),void 0!==t.getComputedStyle){var i=t.getComputedStyle(this._var.bait,null);!i||"none"!=i.getPropertyValue("display")&&"hidden"!=i.getPropertyValue("visibility")||(o=!0)}this._options.debug===!0&&this._log("_checkBait","A check ("+(this._var.loopNumber+1)+"/"+this._options.loopMaxNumber+" ~"+(1+this._var.loopNumber*this._options.loopCheckTime)+"ms) was conducted and detection is "+(o===!0?"positive":"negative")),e===!0&&(this._var.loopNumber++,this._var.loopNumber>=this._options.loopMaxNumber&&this._stopLoop()),o===!0?(this._stopLoop(),this._destroyBait(),this.emitEvent(!0),e===!0&&(this._var.checking=!1)):(null===this._var.loop||e===!1)&&(this._destroyBait(),this.emitEvent(!1),e===!0&&(this._var.checking=!1))},e.prototype._stopLoop=function(t){clearInterval(this._var.loop),this._var.loop=null,this._var.loopNumber=0,this._options.debug===!0&&this._log("_stopLoop","A loop has been stopped")},e.prototype.emitEvent=function(t){this._options.debug===!0&&this._log("emitEvent","An event with a "+(t===!0?"positive":"negative")+" detection was called");var e=this._var.event[t===!0?"detected":"notDetected"];for(var o in e)this._options.debug===!0&&this._log("emitEvent","Call function "+(parseInt(o)+1)+"/"+e.length),e.hasOwnProperty(o)&&e[o]();return this._options.resetOnEnd===!0&&this.clearEvent(),this},e.prototype.clearEvent=function(){this._var.event.detected=[],this._var.event.notDetected=[],this._options.debug===!0&&this._log("clearEvent","The event list has been cleared")},e.prototype.on=function(t,e){return this._var.event[t===!0?"detected":"notDetected"].push(e),this._options.debug===!0&&this._log("on",'A type of event "'+(t===!0?"detected":"notDetected")+'" was added'),this},e.prototype.onDetected=function(t){return this.on(!0,t)},e.prototype.onNotDetected=function(t){return this.on(!1,t)},t.BlockAdBlock=e,void 0===t.blockAdBlock&&(t.blockAdBlock=new e({checkOnLoad:!0,resetOnEnd:!0}))}(window);
var myLazyLoad = new LazyLoad();
function imgError(image) {
  image.onerror = "";
  image.src = "/img/default.png";
  return true;
}
$.fn.textWidth = function(){
  var html_org = $(this).html();
  var html_calc = '<span>' + html_org + '</span>';
  $(this).html(html_calc);
  var width = $(this).find('span:first').width();
  $(this).html(html_org);
  return width;
};
          var option = {
            target: document.getElementById('headku')
          };
          noveltips('.noveltips',{
            zIndex : '999999'
          });
var novelbar = new Novelbar(option);

var adBlockDetected = function() {
    var txt = $('#konten').text()
    , charCount = txt.length
    , wordCount = txt.replace( /[^\w ]/g, "" ).split( /\s+/ ).length
    ;
    if(charCount > 200){
        $('#a-konten').append('<div class="read-more-with-ads"><a href="javascript:window.location.reload(true)" class="btn btn-pink btn-xs">Untuk melanjutkan silahkan matikan pemblokir iklan kamu</a></div>');    
    }$('#konten').addClass('active');
}
var adBlockNotDetected = function() {
    $('#konten').removeClass('active');
    $('.read-more-with-ads').remove();
}
if(typeof blockAdBlock === 'undefined') {
    adBlockDetected();
} else {
    blockAdBlock.onDetected(adBlockDetected).onNotDetected(adBlockNotDetected);
}

$(document).ready(function () {
if ( $( "#ch-tp" ).length ) {
    $(window).scroll( function() {
        // apply css classes based on the situation now
        if ($(".navbar").offset().top > 20) {
          $(".navbar-fixed-top").removeClass("transparent").addClass('animated fadeIn');
          $("#novel-promotion-carousel").removeClass("transparent");
        } else {
          $(".navbar-fixed-top").addClass("transparent").removeClass('animated fadeIn');
          $("#novel-promotion-carousel").addClass("transparent");
        }
      });
}
if ( $( "#novelid" ).length ) {
    $('#ack-review').on('click', function (e) {
        e.preventDefault();
        $('#review-form').toggle();
        $(this).remove();
    });
    $('#ack-voter').on('click', function (e) {
        e.preventDefault();
        $('#voter-item').toggle();
        if ( $('#voter-item').is(':visible') == true) {
            $(this).html('<<');
          } else{
            $(this).html('>>');
          }
    });
}
if ( $( "#novelid" ).length ) {
    var _0x7ce2x3 = $('#novelid')['val']();
    var _0x7ce2x4 = $('#babid')['val']();
    var _0x7ce2x5 = $('#bab')['val']();
    $(document)['on']('click', '#favorite', function(_0x7ce2x6) {
        _0x7ce2x6['preventDefault']();
        if ($('#favorite')['hasClass']('btn-pink')) {
            $['ajax']({
                type: 'GET',
                url: '/api/user/library/favorite/' + _0x7ce2x3 + '?favorite=0',
                contentType: 'text/html; charset=UTF-8',
                success: function(_0x7ce2x7) {
                    if (_0x7ce2x7['status'] == 'success') {
                        $('#favorite')['removeClass']('btn-pink')['addClass']('btn-red');
                        iziToast['success']({
                            timeout: 2000,
                            title: capi(_0x7ce2x7['status']),
                            message: _0x7ce2x7['msg']
                        })
                    } else {
                        iziToast['warning']({
                            timeout: 2000,
                            title: capi(_0x7ce2x7['status']),
                            message: _0x7ce2x7['msg']
                        })
                    }
                }
            })
        } else {
            $['ajax']({
                type: 'GET',
                url: '/api/user/library/favorite/' + _0x7ce2x3 + '?favorite=1',
                contentType: 'text/html; charset=UTF-8',
                success: function(_0x7ce2x7) {
                    if (_0x7ce2x7['status'] == 'success') {
                        $('#favorite')['addClass']('btn-pink')['removeClass']('btn-red');
                        iziToast['success']({
                            timeout: 2000,
                            title: capi(_0x7ce2x7['status']),
                            message: _0x7ce2x7['msg']
                        })
                    } else {
                        iziToast['warning']({
                            timeout: 2000,
                            title: capi(_0x7ce2x7['status']),
                            message: _0x7ce2x7['msg']
                        })
                    }
                }
            })
        }
    });
    $(document)['on']('click', '.status-menu li a', function(_0x7ce2x6) {
        _0x7ce2x6['preventDefault']();
        $(this)['parents']('.dropdown')['find']('.btn')['html']($(this)['html']() + ' <span class="caret"></span>');
        $(this)['parents']('.dropdown')['find']('.btn')['val']($(this)['data']('value'));
        if ($(this)['text']() == ' Dibaca') {
            $['ajax']({
                type: 'GET',
                url: '/api/user/library/status/' + _0x7ce2x3 + '?status=1',
                contentType: 'text/html; charset=UTF-8',
                beforeSend: function(_0x7ce2x8, _0x7ce2x9) {
                    $('#status')['html']('<i class="glyphicon glyphicon-cog gly-spin"></i><span class="spaned-top"></span>')
                },
                success: function(_0x7ce2x7) {
                    if (_0x7ce2x7['status'] == 'success') {
                        iziToast['success']({
                            timeout: 2000,
                            title: capi(_0x7ce2x7['status']),
                            message: _0x7ce2x7['msg']
                        });
                        $('.tool-library')['show']();
                        $('#status')['html']('<i class="glyphicon glyphicon-eye-open"></i> Dibaca <span class="caret"></span>')
                    } else {
                        iziToast['warning']({
                            timeout: 2000,
                            title: capi(_0x7ce2x7['status']),
                            message: _0x7ce2x7['msg']
                        })
                    }
                }
            })
        } else {
            if ($(this)['text']() == ' Selesai') {
                $['ajax']({
                    type: 'GET',
                    url: '/api/user/library/status/' + _0x7ce2x3 + '?status=2',
                    contentType: 'text/html; charset=UTF-8',
                    beforeSend: function(_0x7ce2x8, _0x7ce2x9) {
                        $('#status')['html']('<i class="glyphicon glyphicon-cog gly-spin"></i><span class="spaned-top"></span>')
                    },
                    success: function(_0x7ce2x7) {
                        if (_0x7ce2x7['status'] == 'success') {
                            iziToast['success']({
                                timeout: 2000,
                                title: capi(_0x7ce2x7['status']),
                                message: _0x7ce2x7['msg']
                            });
                            $('.tool-library')['show']();
                            $('#status')['html']('<i class="glyphicon glyphicon-check"></i> Selesai <span class="caret"></span>')
                        } else {
                            iziToast['warning']({
                                timeout: 2000,
                                title: capi(_0x7ce2x7['status']),
                                message: _0x7ce2x7['msg']
                            })
                        }
                    }
                })
            } else {
                if ($(this)['text']() == ' Ditahan') {
                    $['ajax']({
                        type: 'GET',
                        url: '/api/user/library/status/' + _0x7ce2x3 + '?status=3',
                        contentType: 'text/html; charset=UTF-8',
                        beforeSend: function(_0x7ce2x8, _0x7ce2x9) {
                            $('#status')['html']('<i class="glyphicon glyphicon-cog gly-spin"></i><span class="spaned-top"></span>')
                        },
                        success: function(_0x7ce2x7) {
                            if (_0x7ce2x7['status'] == 'success') {
                                iziToast['success']({
                                    timeout: 2000,
                                    title: capi(_0x7ce2x7['status']),
                                    message: _0x7ce2x7['msg']
                                });
                                $('.tool-library')['show']();
                                $('#status')['html']('<i class="glyphicon glyphicon-pushpin"></i> Ditahan <span class="caret"></span>')
                            } else {
                                iziToast['warning']({
                                    timeout: 2000,
                                    title: capi(_0x7ce2x7['status']),
                                    message: _0x7ce2x7['msg']
                                })
                            }
                        }
                    })
                } else {
                    if ($(this)['text']() == ' Direncanakan') {
                        $['ajax']({
                            type: 'GET',
                            url: '/api/user/library/status/' + _0x7ce2x3 + '?status=4',
                            contentType: 'text/html; charset=UTF-8',
                            beforeSend: function(_0x7ce2x8, _0x7ce2x9) {
                                $('#status')['html']('<i class="glyphicon glyphicon-cog gly-spin"></i><span class="spaned-top"></span>')
                            },
                            success: function(_0x7ce2x7) {
                                if (_0x7ce2x7['status'] == 'success') {
                                    iziToast['success']({
                                        timeout: 2000,
                                        title: capi(_0x7ce2x7['status']),
                                        message: _0x7ce2x7['msg']
                                    });
                                    $('.tool-library')['show']();
                                    $('#status')['html']('<i class="glyphicon glyphicon-hourglass"></i> Direncanakan <span class="caret"></span>')
                                } else {
                                    iziToast['warning']({
                                        timeout: 2000,
                                        title: capi(_0x7ce2x7['status']),
                                        message: _0x7ce2x7['msg']
                                    })
                                }
                            }
                        })
                    } else {
                        if ($(this)['text']() == ' Dibuang') {
                            $['ajax']({
                                type: 'GET',
                                url: '/api/user/library/status/' + _0x7ce2x3 + '?status=5',
                                contentType: 'text/html; charset=UTF-8',
                                beforeSend: function(_0x7ce2x8, _0x7ce2x9) {
                                    $('#status')['html']('<i class="glyphicon glyphicon-cog gly-spin"></i><span class="spaned-top"></span>')
                                },
                                success: function(_0x7ce2x7) {
                                    if (_0x7ce2x7['status'] == 'success') {
                                        iziToast['success']({
                                            timeout: 2000,
                                            title: capi(_0x7ce2x7['status']),
                                            message: _0x7ce2x7['msg']
                                        });
                                        $('.tool-library')['show']();
                                        $('#status')['html']('<i class="glyphicon glyphicon-trash"></i> Dibuang <span class="caret"></span>')
                                    } else {
                                        iziToast['warning']({
                                            timeout: 2000,
                                            title: capi(_0x7ce2x7['status']),
                                            message: _0x7ce2x7['msg']
                                        })
                                    }
                                }
                            })
                        } else {
                            $['ajax']({
                                type: 'GET',
                                url: '/api/user/library/delete/' + _0x7ce2x3,
                                contentType: 'text/html; charset=UTF-8',
                                beforeSend: function(_0x7ce2x8, _0x7ce2x9) {
                                    $('#status')['html']('<i class="glyphicon glyphicon-cog gly-spin"></i><span class="spaned-top"></span>')
                                },
                                success: function(_0x7ce2x7) {
                                    if (_0x7ce2x7['status'] == 'success') {
                                        iziToast['success']({
                                            timeout: 2000,
                                            title: capi(_0x7ce2x7['status']),
                                            message: _0x7ce2x7['msg']
                                        });
                                        $('.tool-library')['hide']();
                                        $('#status')['html']('<i class="glyphicon glyphicon-trash"></i> Dihapus dari entry <span class="caret"></span>')
                                    } else {
                                        iziToast['warning']({
                                            timeout: 2000,
                                            title: capi(_0x7ce2x7['status']),
                                            message: _0x7ce2x7['msg']
                                        });
                                        $('#status')['html']('<i class="glyphicon glyphicon-remove"></i> Dihapus dari entry <span class="caret"></span>')
                                    }
                                }
                            })
                        }
                    }
                }
            }
        }
    });
    if ($('#rating')['length']) {
        $('#rating')['rateYo']()['on']('rateyo.set', function(_0x7ce2xa, _0x7ce2x7) {
            _0x7ce2xa['preventDefault']();
            $['ajax']({
                type: 'GET',
                url: '/api/user/library/score/' + _0x7ce2x3 + '?score=' + _0x7ce2x7['rating'],
                contentType: 'text/html; charset=UTF-8',
                success: function(_0x7ce2x7) {
                    if (_0x7ce2x7['status'] == 'success') {
                        iziToast['success']({
                            timeout: 2000,
                            title: capi(_0x7ce2x7['status']),
                            message: _0x7ce2x7['msg']
                        })
                    } else {
                        iziToast['warning']({
                            timeout: 2000,
                            title: capi(_0x7ce2x7['status']),
                            message: _0x7ce2x7['msg']
                        })
                    }
                }
            })
        });
        $('#rating')['rateYo']({
            ratedFill: '#E74C3C'
        });
        $('#rating')['rateYo']('option', 'ratedFill', '#E74C3C')
    };
}
               $("#search").focusin(function() {
  $(".search-suggest").show();
}).focusout(function () {
  $(".search-suggest").delay("100").fadeOut();
});
$("#search").on("input propertychange",function(){
      if( $(this).val().length > 2 ){
        $("ul #s-result").remove();
search($(this).val());
      }else{
        $("ul #s-result").remove();
        $(".search-helper").html('MINIMAL 3 HURUF');
      }
});
  var ajax_request;
function search(inputVal)
{
  if(typeof ajax_request !== 'undefined')
      ajax_request.abort();
  ajax_request = $.ajax({
      type: 'GET',
      url: "/api/search?s="+inputVal,
  beforeSend: function(){
          $(".search-suggest").css("background","#FFF url(/img/loader.gif) no-repeat 450px");
          $(".search-helper").html('Loading...');
          $("ul #s-result").remove();
  },
  success : function(data){
           data = data.novel;
           if(data != ''){
       for (var i=0;i<data.length;++i)
       {
          $(".search-helper").html('');
          if(data[i].type == 1) data[i].type = 'Light Novel';
          if(data[i].type == 2) data[i].type = 'Web Novel';
          if(data[i].type > 2) data[i].type = 'Other Novel';
          if(data[i].thumb != '/img/noimg.png') data[i].thumb = '/uploads/poster/2/'+data[i].thumb;
       $(".search-suggest").append('<ul id="s-result" style="margin-bottom: 0;z-index:250"><li title="'+data[i].title+'"><a style="background-image: url('+data[i].thumb+')" class="thumb" href="/novel/'+data[i].slug+'"></a><div class="ss-info"><a href="/novel/'+data[i].slug+'" class="ss-title">'+data[i].title+'</a> <p>'+data[i].type+', '+data[i].year+'</p></div><div class="clearfix"></div></li></ul>');
       }
           }else{
            $("ul #s-result").remove();
          $(".search-helper").html('Tidak Ditemukan');
           }
    $(".search-suggest").removeAttr("style");}
  });
}
if ( $( "#chapter-list" ).length ) {
    $('#chapter-list').DataTable( {
      processing: true,
      "pagingType": "first_last_numbers",
      "bLengthChange": false,
      "bInfo": false,
      "bSort": false,
      "language": {
        "zeroRecords": "Tidak dapat menemukan chapter",
        "info": "Menampilkan page _PAGE_ dari _PAGES_",
        "infoEmpty": "Tidak dapat menemukan chapter"
      },
      serverSide: true,
      ajax: '/api/chapter/'+$('#novel-id').val(),
      columns : [
        {data: 'volume', name: 'volume', orderable: false},
        {data: 'title', name: 'title', orderable: false},
        {data: 'action', name: 'action', orderable: false}
      ],
      pageLength: 12,
    } );
  };
if($('.read-more-wrap').length){
    
      // Configure/customize these variables.
      var showChar = 200;  // How many characters are shown by default
      var ellipsestext = "...";
      var moretext = "Lebih banyak <i class='fa fa-arrow-down'></i>";
      var lesstext = "Lebih sedikit <i class='fa fa-arrow-up'></i>";
      
  
      $('.read-more-wrap').each(function() {
          var content = $(this).html();
   
          if(content.length > showChar) {
   
              var c = content.substr(0, showChar);
              var h = content.substr(showChar, content.length - showChar);
   
              var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a class="morelink btn btn-block btn-white btn-sm">' + moretext + '</a></span>';
   
              $(this).html(html);
          }
   
      });
   
      $(".morelink").click(function(){
          if($(this).hasClass("less")) {
              $(this).removeClass("less");
              $(this).html(moretext);
          } else {
              $(this).addClass("less");
              $(this).html(lesstext);
          }
          $(this).parent().prev().toggle();
          $(this).prev().toggle();
          return false;
      });
  }
$('#theme').on('change', function(){
  var selected = $(this).find("option:selected").val();
  Cookies.set('theme-mode', selected, { expires: 365 });
  if(selected == 'default'){
  $("head link#bs-theme").attr("href","/css/base.css");
  }
  else{
  $("head link#bs-theme").attr("href","https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/"+selected+"/bootstrap.min.css");
  } });

                $("#rightbar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('.more').on('click', function (e) {
                  e.preventDefault();
                  $('.block-info').show();
                  $(this).remove();
                });
                $('#comment-ack').on('click', function (e) {
                  e.preventDefault();
                  getComment($('#val-current').val());
                });
                $('#refresh-capt').on('click', function (e) {
                  e.preventDefault();
                  getChapter($('#val-novel').val());
                });
                $('#act-listing').on('click', function (e) {
            e.preventDefault();
                    if($('.infor').hasClass('active')){
                    $('#commentbar').addClass('active');
                    $('#rightbar').addClass('active');
                    $('#content').addClass('active');
                    $('.infor').removeClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                    }else{
                    $('.infor').addClass('active');
                    $('#content').removeClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                    }
                });
                $('#act-setting').on('click', function (e) {
            e.preventDefault();
                    if($('.setting').hasClass('active')){
                    $('#infobar').addClass('active');
                    $('#commentbar').addClass('active');
                    $('#content').addClass('active');
                    $('.setting').removeClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                    }else{
                    $('.setting').addClass('active');
                    $('#content').removeClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                    }
                });
                $('#act-comment').on('click', function (e) {
            e.preventDefault();
                    if($('#commentbar').hasClass('active')){
                    $('#rightbar').addClass('active');
                    $('#infobar').addClass('active');
                    $('#content').addClass('active');
                    $('.comment').removeClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                    }else{
                    $('.comment, #content').toggleClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                    }
                });
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('._close').on('click', function (e) {
            e.preventDefault();
                    $('#rightbar,#infobar,#commentbar').addClass('active');
                    $('#content').removeClass('active');
                })
                $('#sidebarCollapse').on('click', function (e) {
            e.preventDefault();
                    $('#sidebar, #content').toggleClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
            $("#otomatis").change(function() {
    $('#cf-auto').val($(this).val());
            });
            $("#jenis-font").change(function() {
    //alert($(this).val());
    $('#konten').css("font-family", $(this).val());
});
            $('#act-bookmark').click(function(e){
            e.preventDefault();
    iziToast.success({
    timeout: 2000,
    message: 'Berhasil Mengupdate library'
});
            });
            $('.btn-number').click(function(e){
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            $('#konten').css("font-size", currentVal-1+ "px");
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            $('#konten').css("font-size", currentVal+1+ "px");
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$("body").keydown(function (e) {
    if(e.keyCode == 39){
        if($('#val-next-capt').val()){
            gochapt($('#val-next-capt').val());
        }
    }else if(e.keyCode == 37){
        if($('#val-before-capt').val()){
            gochapt($('#val-before-capt').val());
        }
    }
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
            var bodyStyle = $('body')[0].style;
$('.bg-picker').colorpicker().on('changeColor', function(ev){
                //bodyStyle.backgroundColor = ev.color.toRGB();
              warna = ev.color.toRGB();
              $('#sidebar,.navbar-default,.navibar,nav,.panel-body,.nav ul li a,body').css('background-color', 'rgba(' + warna.r + ',' + warna.g + ',' + warna.b + ',1)');
              $('p,div,.nav ul li a,body,nav').css('border', '.1px normal rgba(239, 239, 239, 0.09)');
              $('body').css('--main-filter', 'invert(50%)');
              $('#sidebar ul.components').css('border-bottom', 'rgba(' + warna.r + ',' + warna.g + ',' + warna.b + ',0.2)');
              $('#sidebar,.navbar-default,.navibar').css('background', 'rgba(' + warna.r + ',' + warna.g + ',' + warna.b + ',1)');
            });
$('.font-picker').colorpicker().on('changeColor', function(ev){
                bodyStyle.color = ev.color.toHex();
              $('.navibar,nav,p,div,.nav ul li a,body,#konten').css("color", ev.color.toHex());
            });
function changeval(meta,val){
    $(meta).val(val);
}
function capi(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function autoResize(){
    $('#comment-box').height($('#comment-box').contents().height());
}
 $(window).scroll(function() {
    blockAdBlock.onDetected(adBlockDetected).onNotDetected(adBlockNotDetected);
          var percentscroll = Math.round(($(window).scrollTop()) / ($(document).height() - $(window).height()) *100);
      novelbar.go(percentscroll);
      $('#counter').text(percentscroll+'%');
   var btm = $('#val-bottom').val();
   var top = $('#val-top').val();
   var cfauto = $('#cf-auto').val();
   if($(window).scrollTop() + $(window).height() == $(document).height() && btm == 0) {
    if(cfauto == 0){
    changeval('#val-bottom',1);
    }else{
    changeval('#val-bottom',1);
    iziToast.info({
    timeout: 1000,
    position: 'bottomCenter',
    title: 'Tips',
    message: 'Scroll ke kebawah lagi untuk ke chapter selanjutnya !'
});
  }
   }else if($(window).scrollTop() + $(window).height() == $(document).height() && btm == 1 && $('#val-next-capt').val() !== '') {
    if(cfauto == 0){
    changeval('#val-bottom',2);
      $('#val-bottom').after( '<div class="padding-10"><a href="#" id="nextcap" class="btn btn-info btn-block">Selanjutnya</a></div>' );
    }else{
    gochapt($('#val-next-capt').val());
    changeval('#val-bottom',2);
    iziToast.success({
    timeout: 2000,
    position: 'bottomCenter',
    title: 'Info',
    message: 'Akan berpindah ke halaman selanjutnya!'
});
   }
   }

   if($(window).scrollTop() === 0 && top == 0) {
    if(cfauto == 0){
    changeval('#val-top',1);
    }else{
    changeval('#val-top',1);
    iziToast.info({
    position: 'topCenter',
    timeout: 1000,
    title: 'Tips',
    message: 'Scroll ke atas lagi untuk ke chapter sebelumnya !'
});
    }
   }else if($(window).scrollTop() === 0 && top == 1 && $('#val-before-capt').val() !== '') {
    if(cfauto == 0){
    changeval('#val-top',2);
      $('#val-top').after( '<div class="padding-10"><a href="#" id="beforecap" class="btn btn-warning btn-block">Sebelumnya</a></div>' );
    }else{
    gochapt($('#val-before-capt').val());
    changeval('#val-top',2);
    iziToast.success({
    position: 'topCenter',
    timeout: 2000,
    title: 'Info',
    message: 'Akan berpindah ke halaman sebelumnya!'
});
   }
 }
});
 setTimeout(function(){ 
    $('.plcgo').removeClass('placeholder');
    $('.plcgo-panel').removeAttr('style');
}, 3000);
var specialElementHandlers = {
    '#rightbar': function (element, renderer) {
        return true;
    }
};

$("#comment-send").on("click", function(e) {
  e.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  if(typeof ajax_request !== 'undefined')
      ajax_request.abort();
  ajax_request = $.ajax({
    headers: {
        'X-CSRF-TOKEN': CSRF_TOKEN
      },
      type: 'POST',
      url: "/api-send",
      data: "__token="+CSRF_TOKEN+"&loca="+$('#current-comment').val()+"&messsage="+$('.u-comment').val()+'&type='+$('#reply-status').val()+'&reply='+$('#reply-options').val()+'&object='+$('#val-current').val(),
  beforeSend: function(){
            $('#comment-send').html('<i class="glyphicon glyphicon-refresh gly-spin"></i>');
  },
  success : function(data,message,request){
    window.parent.autoResize();
    comment = data.data;
    if(data.response == 0){
        iziToast.warning({
        timeout: 2000,
        message: comment
    });
    $('#comment-send').html('<i class="glyphicon glyphicon-send"></i>');
    }else{
        iziToast.success({
        timeout: 2000,
        message: 'Berhasil Mengirim Komentar'
    });
    $('#total_comment').text(function(i, t) {
        return Number(t) + 1;
    });
    $('.rem-wrap').remove();
    $('#comment-send').html('<i class="glyphicon glyphicon-send"></i>');
    valu = $('#reply-options').val();
    $('.u-comment').val('');
    if(valu == 0){
        if(!comment.user.userimg) comment.user.userimg = '/img/default_user_profile.png';
        $(".commentlist").prepend('<div class="comment-wrap dibaca" id="comment-wrap" data-comment="'+comment.id+'" data-username="'+comment.user.name+'"><div class="photo"><div class="avatar" style="background-image: url('+'/uploads/user/2/'+comment.user.userimg+')"></div></div><div class="comment-block"><div class="comment-user">'+comment.user.name+'</div><p class="comment-text">'+comment.message+'</p><div class="bottom-comment"><div class="comment-date" data-livestamp="'+comment.date+'">'+comment.date+'</div><ul class="comment-actions"><li class="reply" onclick="replyget('+comment.id+')">0 Balasan</li><li class="complain" onclick="reportc('+comment.id+')"><i class="glyphicon glyphicon-flag"></i></li></ul></div><div class="comment-reply-'+comment.id+'" id="comment-reply-'+comment.id+'"><br></div></div> </div>');    
    }else{
        $('.comment-reply-'+valu).append('<li class="reply-li" data-name="'+comment.user.name+'" data-reply="'+comment.id+'"> <div class="reply-user">'+comment.user.name+'</div> <p class="reply-text">'+comment.message+'</p> <div class="reply-date" data-livestamp="'+comment.date+'">'+comment.date+'</div> <ul class="reply-actions"> <li class="complain" onclick="reportc('+valu+')"><i class="glyphicon glyphicon-flag"></i></li> </ul> </li>');
    }
    }
 },
  error: function (x, settings, exception) {
    iziToast.info({
    timeout: 2000,
    message: 'Komentar tak tersedia saat ini'
});
$('#comment-send').html('<i class="glyphicon glyphicon-send"></i>');
$('.panel-footer').remove();
  }
});
});
$('ul').on('click','#footer', function (e) {
  e.preventDefault();
    $('html, body').animate({
        scrollTop: $("#content").offset().top + 10
    }, 800);
});
$('div').on('click','#beforecap', function (e) {
  beforecap = $('#val-before-capt').val();
  $(this).addClass('disabled').html('<i class="glyphicon glyphicon-refresh gly-spin"></i> Loading..');
  e.preventDefault();
  gochapt(beforecap);
});
$('div').on('click','#nextcap', function (e) {
  nextcap = $('#val-next-capt').val();
  $(this).addClass('disabled').html('<i class="glyphicon glyphicon-refresh gly-spin"></i> Loading..');
  e.preventDefault();
  gochapt(nextcap);
});

function returnx(x,exception,element){
            var message;
            var statusErrorMap = {
                '400' : "Server memahami permintaan tersebut, namun permintaan konten tidak valid.",
                '401' : "Akses tidak sah.",
                '403' : "Sumber daya terlarang tidak bisa diakses.",
                '404' : "Konten ini tak tersedia saat ini.",
                '500' : "Hmm.. saat ini server sedang error, coba lagi",
                '429' : "Request Kebanyakan -,- tunggu beberapa menit lagi",
                '419' : "Haaaaaaaaaa ? Apa ini ? jangan bilang error",
                '503' : "Layanan tidak tersedia saat ini, coba lagi."
            };
            if (x.status) {
                message =statusErrorMap[x.status];
                                if(!message){
                                      message="Error Yang tidak diketahui \n.";
                                  }
            }else if(exception=='parsererror'){
                message="Error.\nSaat melakukan Parsing data.";
            }else if(exception=='timeout'){
                message="Request Time out.";
            }else if(exception=='abort'){
                message="Request dibatalkan oleh server";
            }else {
                message="Hmmm Sepertinya Peramban kamu bermasalah \n.";
            }
            $(element).html('<h1 style="text-align:center"><i class="glyphicon glyphicon-alert gly-scale" style="font-size:115px"></i><br>Yaaaaaaah... :(</h1><h4 style="font-size:12px;color:red;text-align:center;">'+message+'</h4>');
            
}
function reportc(id){
alert(id);
}
function getComment(page){
  if(typeof comm_request !== 'undefined')
      comm_request.abort();
      comm_request = $.ajax({
      type: 'GET',
      url: "/api-comment/"+page,
  beforeSend: function(){
    $('#reply-options').val(0);
    $('.u-rep').hide()
    $('.u-focus').removeAttr('style').val('');
    $(".comment-wrap,.rem-wrap").remove();
            $('#dump-comment').html('<i class="glyphicon glyphicon-refresh gly-spin"></i> Loading..');
  },
  success : function(data,message,request){
           comment = data.comment;
           $('.panel-footer').show();
           if(comment != ''){
       for (var i=0;i<comment.length;++i)
       {
           if(!comment[i].user.userimg) comment[i].user.userimg = '/img/default_user_profile.png';
       $(".commentlist").prepend('<div class="comment-wrap" id="comment-wrap" data-comment="'+comment[i].id+'" data-username="'+comment[i].user.name+'"><div class="photo"><div class="avatar" style="background-image: url('+'/uploads/user/2/'+comment[i].user.userimg+')"></div></div><div class="comment-block"><div class="comment-user">'+comment[i].user.name+'</div><p class="comment-text">'+comment[i].message+'</p><div class="bottom-comment"><div class="comment-date" data-livestamp="'+comment[i].date+'">'+comment[i].date+'</div><ul class="comment-actions"><li class="reply" onclick="replyget('+comment[i].id+')">'+comment[i].totalc+' Balasan</li><li class="complain" onclick="reportc('+comment[i].id+')"><i class="glyphicon glyphicon-flag"></i></li></ul></div><div class="comment-reply-'+comment[i].id+'" id="comment-reply-'+comment[i].id+'"><br></div></div> </div>');
       }
           }else{
          $(".commentlist").append('<div class="rem-wrap">Belum Ada Komentar</div>');
           }
    $('#dump-comment').html('');
  },
  error: function (x, settings, exception) {
    returnx(x,exception,'#dump-comment');
  }
});

}
function getChapter(page){
  if(typeof ajax_request !== 'undefined')
      ajax_request.abort();
  ajax_request = $.ajax({
      type: 'GET',
      url: "/api/chapter/"+page,
  beforeSend: function(){
            $('.list-group-item').remove('');
            $('#dump-list').html('<br><i class="glyphicon glyphicon-refresh gly-spin gly-2x"></i><br>Loading..<br>');
  },
  success : function(data,message,request){
    chapter = data.data;
           if(chapter != ''){
       for (var i=0;i<chapter.length;++i)
       {
           if(chapter[i].slug == $('#val-current').val()){
            $(".infolist").append('<li class="list-group-item selected">'+chapter[i].volume+' - '+chapter[i].title+'</li>');    
           }else{
            $(".infolist").append('<li class="list-group-item" onclick="gochapt(\''+chapter[i].slug+'\')">'+chapter[i].volume+' - '+chapter[i].title+'</li>');     
           }
            }
           }else{
          $(".infolist").html('<i class="glyphicon glyphicon-remove gly-spin gly-4x"></i>');
           }
           $('.selected')[0].scrollIntoView(true);
    $('#dump-list').html('');
  },
  error: function (x, settings, exception) {
    returnx(x,exception,'#dump-list');
  }
});
}


function initReply() {
        $(".u-comment").keyup(function(e){if(e.keyCode == 8){
          if($(this).val().length == 0 && $('#reply-status').val() == 0){
            $(this).removeAttr('style').attr("placeholder", "Tambah Komentar");
            $('#reply-options').val(0);
            $('.u-rep').hide();
          }
          $('#reply-status').val(0);
        }});
        $("div").on("click", ".comment-wrap", function() {
            var a = $(this)['attr']('data-comment');
            var b = $(this)['attr']('data-username');
            $('.u-rep').show();
            $('#reply-options').val(a);
            $('#reply-status').val(1);
            $('.u-rep').html('Balas '+b+': ');
            $(".u-comment").css('text-indent',$('.u-rep').textWidth()+5).attr("placeholder", "....");;
        });
    }
    initReply();
function replyget(page){
  if(typeof ajax_request !== 'undefined')
      ajax_request.abort();
  ajax_request = $.ajax({
      type: 'GET',
      url: "/api-comment/"+$('#val-current').val()+'?reply='+page,
  beforeSend: function(){
            $('.comment-reply-'+page).html('<br><i class="glyphicon glyphicon-refresh gly-spin"></i><br>Loading..');
  },
  success : function(data,message,request){
           reply = data.reply;
          $(".comment-reply-"+page).html('');
           if(reply != ''){
       $(".comment-reply-"+page).append('<ul class="reply-ul">');
       for (var i=0;i<reply.length;++i)
       {
       $(".comment-reply-"+page).append('<li class="reply-li" data-name="'+reply[i].user.name+'" data-reply="'+reply[i].id+'"> <div class="reply-user">'+reply[i].user.name+'</div> <p class="reply-text">'+reply[i].message+'</p> <div class="reply-date" data-livestamp="'+reply[i].date+'">'+reply[i].date+'</div> <ul class="reply-actions"> <li class="complain" onclick="reportc('+reply[i].id+')"><i class="glyphicon glyphicon-flag"></i></li> </ul> </li>');
       }
       $(".comment-reply-"+page).append('</ul>');
           }else{
          $(".comment-reply-"+page).html('<br>');
           }
  },
  error: function (x, settings, exception) {
          $(".comment-reply-"+page).html('<br>');
  }
});

}

function gochapt(page){
getComment(page);
    history.pushState('data', '', document.location.origin+"/read/"+page);
  if(typeof ajax_request !== 'undefined')
      ajax_request.abort();
  ajax_request = $.ajax({
      type: 'GET',
      url: "/read/"+page,
  beforeSend: function(request){
    $('.list-group-item').remove('');
    $('#dump-list').html('<br><i class="glyphicon glyphicon-hourglass gly-spin gly-2x"></i><br><br>');
    request.setRequestHeader("ToNovel", 1);
            $('.plcgo').addClass('placeholder');
            $('.preload').show();
            $('#konten').html('');
    $('.navibar').show();
 $.each($('.plcgo-panel'), function (index, obj) {
    $(this).css({
        'max-width' : (Math.random() * 3000 / 10)+'%'
    });
});
  },
  success : function(data,message,request){
ciphertext = request.getResponseHeader('ToNovelKey');
var key = "tonovelcryptokey";
var decrypted = CryptoJS.AES.decrypt(ciphertext, key);
json = decrypted.toString(CryptoJS.enc.Utf8);
obj = JSON.parse(json);
$('#tonl-viewer').html(obj.views);
$('#tonl-diff').html(obj.differ);
$('#tonl-author').html('Oleh <a href="/group/'+obj.group_slug+'">'+obj.group+'</a>');
$('#tonl-chapter').html(obj.chapter);
$('#konten').html(obj.content);
if(!obj.content){
$('#konten').html('<h1 style="text-align:center" onclick="reqt(\''+obj.chapter_slug+'\')"><i class="glyphicon glyphicon-info-sign gly-buzz" style="font-size:115px"></i></h1><h4 style="font-size:12px;color:brown;text-align:center;">Fitur bacaan tidak tersedia silahkan mengunjungi tautan <a href="/redirect?url='+obj.source+'" style="color:blue">disini</a><br><br><a href="/diff/'+obj.chapter_slug+'" class="btn btn-primary">Buat diff disini</a></h4>')
$('#cf-auto').val(0);
}
if(obj.before_cap){
$('#val-before-capt').val(obj.before_cap);
}else{
$('#val-before-capt').val('');
}
if(obj.next_cap){
$('#val-next-capt').val(obj.next_cap);
}else{
$('#val-next-capt').val('');
}
$('#val-current').val(obj.chapter_slug);
getChapter(obj.novel_id);
            $('.plcgo').removeClass('placeholder');
            $('.preload').hide();
    changeval('#val-bottom',0);
    changeval('#val-top',0);
    $('.padding-10').remove();
    $('html, body').animate({
        scrollTop: $("#tonovel-isi").offset().top - 60
    }, 500);
    blockAdBlock.onDetected(adBlockDetected).onNotDetected(adBlockNotDetected);
  },
  error: function (x, settings, exception) {
            returnx(x,exception,'#konten');
            $('#val-before-capt').val('');
            $('#val-next-capt').val('');
            $('.plcgo').removeClass('placeholder');
            $('.preload').hide();
            $('.navibar').hide();
            $('.padding-10').remove();
  }
});
}