// const values = ['Brussels', 'Cairo', 'Casablanca', 'Cengzhou', 'Caracas',
// 'Los Angeles', 'Osaka'];

// filterInput.addEventListener('keyup', filterProducts);

function filterProducts() {

    // remove all the childs from the current element
    while (grid.childNodes.length > 1) {
        grid.removeChild(grid.lastChild)
    }

    fetch('')
        .then(res => res.json())
        .then(json => {

            let filterValue = filterInput.value.toUpperCase();
            let filterData = match(json, 'title', filterValue)

            for (const value of filterData) {
                addElement(grid, value)
            }

        });

}



let grid = document.querySelector(".search-product-list");
let filterInput = document.getElementById("filterInput");

fetch('')
    .then(res => res.json())
    .then(json => {

        // iterating products
        for (let value of json) {
            addElement(grid, value)
        }

    });


// add event listener
filterInput.addEventListener('keyup', filterProducts);

// callback function 
function filterProducts() {
    let matchCount = 0;
    let filterValue = filterInput.value.toUpperCase();
    let item = grid.querySelectorAll('.search-product-list-in')

    if (filterValue.length > 0) {
        for (let i = 0; i < item.length; i++) {
            let span = item[i].querySelector('.title');

            if (span.innerHTML.toUpperCase().indexOf(filterValue) > -1) {
                item[i].style.display = "block";
                $('.search-inner').hide();
                $('.search-product-list-btn').show();
                $('#no-product-find').hide();
                matchCount++;
            } else {
                item[i].style.display = "none";
                $('.search-product-list-btn').hide();
                $('.search-inner').hide();
            }
        }

        if (matchCount <= 0) {
            $('#no-product-find').show();
            $('.search-inner').hide();
        }
    } else {
        $('.search-inner').show();
        $('#no-product-find').hide();
        $('.search-product-list-in').hide();
        $('.search-product-list-btn').hide();
    }
}