// Owl Carousel Start..................



$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});

// Owl Carousel End..................

//Onclick sendbutton .///
$('#sendContact').click(function () {
    var name = $('#name').val();
    var phone = $('#phone').val();
    var emaill = $('#emaile').val();
    var msg = $('#msg').val();
    contactSend(name,phone,emaill,msg);
})


//start contact buttone///

function contactSend(name,phone,email,mgs) {
    if(name.length==0){
        $('#sendContact').html('name Empty');
        setTimeout(function () {
            $('#sendContact').html('পাঠিয়ে দিন');
        },2000);
    }else if(phone.length==0){
        $('#sendContact').html('phone Empty');
        setTimeout(function () {
            $('#sendContact').html('পাঠিয়ে দিন');
        },2000);
    }
    if(email.length==0){
        $('#sendContact').html( 'emaile Empty');
        setTimeout(function () {
            $('#sendContact').html('পাঠিয়ে দিন');
        },2000);
    }else if(mgs.length==0){
        $('#sendContact') .html('mgs Empty');
        setTimeout(function () {
            $('#sendContact').html('পাঠিয়ে দিন');
        },2000);
    }else {
        axios.post('/contact',{
            name:name,
            phone:phone,
            emaile:email,
            msg:mgs,
        }).then(function (response) {
              if(response.status==200){
                  if(response.data==true){
                      $('#sendContact').html('আপনি সফল হয়েছেন');
                      setTimeout(function () {
                          $('#sendContact').html('পাঠিয়ে দিন');
                      },2000);
                  }else {
                      $('#sendContact').html('আপনি ব্যর্থ হয়েছেন');
                      setTimeout(function () {
                          $('#sendContact').html('পাঠিয়ে দিন');
                      },2000);
                  }

              }else {
                  $('#sendContact').html('Network Connection Error');
                  setTimeout(function () {
                      $('#sendContact').html('পাঠিয়ে দিন');
                  },2000)
              }
        }).catch(function (error) {
            touster.error('Ragistion Success');
        })
    }

}
