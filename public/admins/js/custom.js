// $(document).ready(function () {
//     $("#recent-reviews-slider").owlCarousel({
//         items: 3,
//         loop: false,
//         center: false,
//         autoplay: true,
//         margin: 20,
//         dots: true,
//         nav: false,
//         rewind: true,
//         autoplayTimeout: 3000,
//         autoplaySpeed: 1000,
//         autoplayHoverPause: true,
//         responsive: {
//             0: {
//                 items: 1,
//             },
//             600: {
//                 items: 2,
//             },
//             1000: {
//                 items: 3,
//             }
//         }
//     });
//     $(".owl-prev").html('<i class="far fa-chevron-left"></i>');
//     $(".owl-next").html('<i class="far fa-chevron-right"></i>');
// });


// Passowrd-Eye

$(function () {

    $('#eye').click(function () {

        if ($(this).hasClass('fa-eye-slash')) {

            $(this).removeClass('fa-eye-slash');

            $(this).addClass('fa-eye');

            $('#password').attr('type', 'text');

        } else {

            $(this).removeClass('fa-eye');

            $(this).addClass('fa-eye-slash');

            $('#password').attr('type', 'password');
        }
    });
});

// Passowrd-Eye


// SIDE-MENU
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function categoryfun() {
    document.getElementById("myDropdown").classList.toggle("show");
}
function servicefun() {
    document.getElementById("myDropdown2").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
// window.onclick = function(event) {
//     if (!event.target.matches('.dropbtn')) {
//         var dropdowns = document.getElementsByClassName("dropdown-content");
//         var i;
//         for (i = 0; i < dropdowns.length; i++) {
//             var openDropdown = dropdowns[i];
//             if (openDropdown.classList.contains('show')) {
//                 openDropdown.classList.remove('show');
//             }
//         }
//     }
// }

// SIDE-MENU





// FAQ-Section

const items = document.querySelectorAll(".accordion button");

function toggleAccordion() {
    const itemToggle = this.getAttribute('aria-expanded');

    for (i = 0; i < items.length; i++) {
        items[i].setAttribute('aria-expanded', 'false');
    }

    if (itemToggle == 'false') {
        this.setAttribute('aria-expanded', 'true');
    }
}

items.forEach(item => item.addEventListener('click', toggleAccordion));

// FAQ-Tabs

$(document).ready(function () {
    $('#infocontent section:not(:first)').hide();
    var $allContentDivs = $('#infocontent section'); // Hide All Content Divs

    $('#linkwrapper a').click(function () {
        var $contentDiv = $("#" + this.id + "content");

        if ($contentDiv.is(":visible")) {
            $contentDiv.hide(); // Hide Div
        } else {
            $allContentDivs.hide(); // Hide All Divs
            $contentDiv.show(); // Show Div
        }

        return false;
    });
});


// FAQ-Tabs


// FAQ-Active


$(document).ready(function () {
    $('#accordion ul li a').click(function () {
        $('#accordion ul li a').removeClass("active");
        $(this).addClass("active");
    });
});
// FAQ-Active




// search-dropdown

$("#search_quote").on("keyup", function () {
    var search = $(this).val().toLowerCase();
    $("#search-value").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(search) > -1);
    });
});

$("#dropdown-btn").on("click", function () {
    $("#dropdown").slideToggle().toggleClass('open');
    $(this).toggleClass('opened');
});

$("body").on("click", function (event) {
    if ($(event.target).closest('.quotes').length != 0) {
        return;
    } else {
        $("#dropdown.open").slideToggle().toggleClass('open');
        $("#dropdown-btn.opened").toggleClass('opened');
    }
});





// search-dropdown


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
$(".imageUpload").change(function () {
    readURL(this);
});

// PROFILE-EDIT

// ----- Filter toggle dropdown ------//

$(document).ready(function () {
    $('.quotes2 .dropdown-filterbtn').click(function () {
        $(".dropdown-showfilter").not($(this).parent().find(".dropdown-showfilter").toggle()).hide();
        event.stopPropagation();
    });
    $(document).click(function () {
        $(".dropdown-showfilter").hide();
    });
    $('.dropdown-showfilter').click(function () {
        event.stopPropagation();
    });
});

// ----- Filter toggle dropdown ------//



$(document).ready(function () {
    $('.quotes .dropdown-btn').click(function () {
        $(".dropdown").not($(this).parent().find(".dropdown").toggle()).hide();
        event.stopPropagation();
    });
    $(document).click(function () {
        $(".dropdown").hide();
    });
    $('.dropdown').click(function () {
        event.stopPropagation();
    });
});



$(function () {

    $('input[name="datefilter"]').daterangepicker({
        opens: 'left',
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Cancel'
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


// search-dropdown-5

$("#search_quote-5").on("keyup", function () {
    var search = $(this).val().toLowerCase();
    $("#search-value-5").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(search) > -1);
    });
});

$(".dropdown-btn-5").on("click", function () {
    $(".dropdown-5").slideToggle().toggleClass('open');
    $(this).toggleClass('opened');
});

$("body").on("click", function (event) {
    if ($(event.target).closest('.quotes2').length != 0) {
        return;
    } else {
        $(".dropdown-5.open").slideToggle().toggleClass('open');
        $(".dropdown-btn-5.opened").toggleClass('opened');
    }
});

// search-dropdown-5


// Multi-Modal-Open-Close
$("#myModal-4").on('show.bs.modal', function (e) {
    $("#myModal-3").modal("hide");
});

// Multi-Modal-Open-Close


// Multi-Modal-Open-Close-2
$("#myModal-7").on('show.bs.modal', function (e) {
    $("#myModal-6").modal("hide");
});

// Multi-Modal-Open-Close-2


// Multi-Modal-Open-Close-2
$("#myModal-12").on('show.bs.modal', function (e) {
    $("#myModal-11").modal("hide");
});

// Multi-Modal-Open-Close-2

// Multi-Modal-Open-Close-3
$("#myModal-14").on('show.bs.modal', function (e) {
    $("#myModal-13").modal("hide");
});

// Multi-Modal-Open-Close-3


// all-filters

$(document).on('click', '#mydiv a', function () {
    $(this).addClass('active').siblings().removeClass('active')
});
// all-filters
// scroll


// jQuery(function($) {
//     $.fn.hScroll = function(amount) {
//         amount = amount || 120;
//         $(this).bind("DOMMouseScroll mousewheel", function(event) {
//             var oEvent = event.originalEvent,
//                 direction = oEvent.detail ? oEvent.detail * -amount : oEvent.wheelDelta,
//                 position = $(this).scrollLeft();
//             position += direction > 0 ? -amount : amount;
//             $(this).scrollLeft(position);
//             event.preventDefault();
//         })
//     };
// });
// $(document).ready(function() {
//     $('#table-responsive-1').hScroll(60); // You can pass (optionally) scrolling amount
// });


// scroll

// custum-select

var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    /* For each element, create a new DIV that will act as the selected item: */
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /* For each element, create a new DIV that will contain the option list: */
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
        /* For each option in the original select element,
        create a new DIV that will act as an option item: */
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function (e) {
            /* When an item is clicked, update the original select box,
            and the selected item: */
            var y, i, k, s, h, sl, yl;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            sl = s.length;
            h = this.parentNode.previousSibling;
            for (i = 0; i < sl; i++) {
                if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y = this.parentNode.getElementsByClassName("same-as-selected");
                    yl = y.length;
                    for (k = 0; k < yl; k++) {
                        y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                }
            }
            h.click();
        });
        b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function (e) {
        /* When the select box is clicked, close any other select boxes,
        and open/close the current select box: */
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
    });
}

function closeAllSelect(elmnt) {
    /* A function that will close all select boxes in the document,
    except the current select box: */
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
            arrNo.push(i)
        } else {
            y[i].classList.remove("select-arrow-active");
        }
    }
    for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
        }
    }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);

// custum-select


// sidemenu
const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
    sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault();
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchButtonIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
        }
    }
})





if (window.innerWidth < 768) {
    sidebar.classList.add('hide');
} else if (window.innerWidth > 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search');
    searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
    if (this.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
})

// sidemenu



/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "300px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}



