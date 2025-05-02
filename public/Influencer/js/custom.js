// PASSOWRD-EYE
// alert('hi');
$(function () {

    $('.eye').click(function () {
        if ($(this).hasClass('eye-close')) {
            $(this).removeClass('eye-close');
            $(this).addClass('eye-open');
            $(this).parent().parent().find('.password').attr('type', 'text');
        } else {
            $(this).removeClass('eye-open');
            $(this).addClass('eye-close');
            $(this).parent().parent().find('.password').attr('type', 'password');
        }
    });
});

// PASSOWRD-EYE


// OTP-VERIFICATION

$(".inputs").keyup(function () {
    if (this.value.length == this.maxLength) {
        $(this).next('.inputs').focus();
    }
    if (this.value.length == 0)
        $(this).prev('.inputs').focus();
});


// OTP-VERIFICATION


// PROFILE-EDIT

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function () {
    readURL(this);
});

// PROFILE-EDIT

// ellips
// $(document).on('click', '.elipse-wrap', function() {
//    
//     $(this).find('.show-elipse-card').toggle();
// });





$(function () {

    $('input[name="datefilter"]').daterangepicker({
        opens: 'left',
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('input[name="datefilter"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="datefilter"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

});


$(document).ready(function () {
    $('.applyBtn').click(function () {
        $('.broker-date').css('width', '240px')
    })
    $('.cancelBtn').click(function () {
        $('.broker-date').css('width', '150px')
    })
});

// datpicker


// NOTIFICATION
$(document).ready(function () {
    $('.notification-in button').click(function () {
        $('.notification-list').slideToggle('fast');
        event.stopPropagation();
    });
    $(document).click(function () {
        $('.notification-list').slideUp('fast');
        event.stopPropagation();
    });
    $('.notification-list').click(function () {
        event.stopPropagation();
    });
});
// NOTIFICATION
