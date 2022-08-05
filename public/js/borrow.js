// set variables
var title = document.getElementById("title");
var ISBN = document.getElementById("ISBN");
var author = document.getElementById("author");
var publication = document.getElementById("publication");
var language = document.getElementById("language");
var access_level = document.getElementById("access_level");
var cover_img = document.getElementById("cover_img");

var username = document.getElementById("username");
var borrowed = document.getElementById("borrowed");
var available = document.getElementById("available");
var privilege = document.getElementById("privilege");

// function to get Material information with AJAX
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
            break;
        case 2:
            access_level.innerHTML = "Privileged Only";
            break;
        case 3:
            access_level.innerHTML = "Full Restrictions";
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
    cover_img.src = "images/book_covers/no_book_cover.jpg";
}

// function to get USER information with AJAX
function getUserDetails(user_id){
    // always clear details
    clearUserDetails();
    // do nothing unless 8 characters are entered
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

// function to claer USER information in BorrowBook Blade
function clearUserDetails(){
    username.innerHTML = "";
    borrowed.innerHTML = "";
    available.innerHTML = "";
    privilege.innerHTML = "";
}