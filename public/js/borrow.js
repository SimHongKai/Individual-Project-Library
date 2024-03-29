// set variables
var user_id = document.getElementById("user_id");
var material_no = document.getElementById("material_no");

var title = document.getElementById("title");
var ISBN = document.getElementById("ISBN");
var author = document.getElementById("author");
var publication = document.getElementById("publication");
var language = document.getElementById("language");
var access_level = document.getElementById("access_level");
var access_dot = document.getElementById("access_dot");
var cover_img = document.getElementById("cover_img");

var username = document.getElementById("username");
var borrowed = document.getElementById("borrowed");
var available = document.getElementById("available");
var privilege = document.getElementById("privilege");

// function to get Material information with Fetch API
function getMaterialDetails(material_no){
    clearMaterialDetails();
    // do nothing unless 8 characters are entered
    if (material_no.length < 8){
        return
    }
    // fetch
    fetch('borrow_book/get-material', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
        },
        body: JSON.stringify({material_no: material_no}),
        method: 'post',
        credentials: "same-origin",})
    .then(function (response) {
        // get response and convert to JSON
        return response.json();
    })
    .then(function (response) {
        // handle response JSON
        console.log(response);
        setMaterialDetails(response);
    })
    .catch(function(error){
        // log errors
        console.log(error);
    });    
}

// function to set Material information in BorrowBook Blade
function setMaterialDetails(book){
    title.innerHTML = book.title;
    ISBN.innerHTML = book.ISBN;
    author.innerHTML = book.author;
    publication.innerHTML = book.publication;
    language.innerHTML = book.language;
    switch(book.access_level){
        case 1:
            access_level.innerHTML = "No Restrictions";
            access_dot.className = "green-dot";
            break;
        case 2:
            access_level.innerHTML = "Privileged Only";
            access_dot.className = "yellow-dot";
            break;
        case 3:
            access_level.innerHTML = "Full Restrictions";
            access_dot.className = "red-dot";
            break;
        default:
            access_level.innerHTML = "Undefined";
    }
    let cover_img_path = "images/book_covers/"
    cover_img.src = cover_img_path.concat(book.cover_img, "?", book.updated_at);
}

// function to clear Material information in BorrowBook Blade
function clearMaterialDetails(book){
    title.innerHTML = "";
    ISBN.innerHTML = "";
    author.innerHTML = "";
    publication.innerHTML = "";
    language.innerHTML = "";
    access_level.innerHTML = "";
    access_dot.className = "";
    cover_img.src = "images/book_covers/no_book_cover.jpg";
}

// function to get USER information with AJAX
function getUserDetails(user_id){
    // always clear details
    clearUserDetails();
    // do nothing unless 36 characters are entered
    if (user_id.length < 8){
        return;
    }
    // fetch
    fetch('borrow_book/get-user', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
        },
        body: JSON.stringify({user_id: user_id}),
        method: 'post',
        credentials: "same-origin",})
    .then(function (response) {
        // get response and convert to JSON
        return response.json();
    })
    .then(function (response) {
        // handle response JSON
        console.log(response);
        setUserDetails(response);
    })
    .catch(function(error){
        // log errors
        console.log(error);
    });    
}

// function to set USER information in BorrowBook Blade
function setUserDetails(user){
    username.innerHTML = user.username;
    borrowed.innerHTML = user.borrowed;
    available.innerHTML = user.available;
    let privilege = document.getElementById("privilege")
    switch(user.privilege){
        case 1:
            privilege.innerHTML = "Admin";
            break;
        case 2:
            privilege.innerHTML = "Priviliged User";
            break;
        case 3:
            privilege.innerHTML = "Basic User";
            break;
        default:
            privilege.innerHTML = "Undefined";
    }
}

// function to clear USER information in BorrowBook Blade
function clearUserDetails(){
    username.innerHTML = "";
    borrowed.innerHTML = "";
    available.innerHTML = "";
    privilege.innerHTML = "";
}

// function to get Booking Details and pass to other function to call
function getBookingDetails(booking_id){

    // fetch
    fetch('borrow_booked_book/get-booking', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
        },
        body: JSON.stringify({booking_id: booking_id}),
        method: 'post',
        credentials: "same-origin",})
    .then(function (response) {
        // get response and convert to JSON
        return response.json();
    })
    .then(function (response) {
        // handle response JSON
        console.log(response);
        user_id.value = String(response.user_id).padStart(8, '0');
        material_no.value = String(response.material_no).padStart(8, '0');
        getUserDetails(user_id.value);
        getMaterialDetails(material_no.value);
    })
    .catch(function(error){
        // log errors
        console.log(error);
    });    
}
