// set variables
var username = document.getElementById("username");
var borrowed = document.getElementById("borrowed");
var available = document.getElementById("available");
var privilege = document.getElementById("privilege");

var title = document.getElementById("title");
var ISBN = document.getElementById("ISBN");
var author = document.getElementById("author");
var publication = document.getElementById("publication");
var language = document.getElementById("language");
var access_level = document.getElementById("access_level");
var access_dot = document.getElementById("access_dot");
var borrowed_at = document.getElementById("borrowed_at");
var due_at = document.getElementById("due_at");
var cover_img = document.getElementById("cover_img");
var late_fee = document.getElementById("late_fee");

// function to get Return information with AJAX
function getReturnDetails(material_no){
    clearReturnDetails();
    // do nothing unless 8 characters are entered
    if (material_no.length < 8){
        return
    }
    // fetch
    fetch('return_book/get-return-details', {
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
        if(response != null){
            console.log(response);
            setReturnDetails(response);
        }
    })
    .catch(function(error){
        // log errors
        console.log(error);
    });    
}

// function to set Return user and Material information in Return Book Blade
function setReturnDetails(response){
    username.innerHTML = response.username;
    borrowed.innerHTML = response.borrowed;
    available.innerHTML = response.available;
    let privilege = document.getElementById("privilege")
    switch(response.privilege){
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

    title.innerHTML = response.title;
    ISBN.innerHTML = response.ISBN;
    author.innerHTML = response.author;
    publication.innerHTML = response.publication;
    language.innerHTML = response.language;
    switch(response.access_level){
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
    borrowed_at.innerHTML = response.borrowed_at;
    due_at.innerHTML = response.due_at;
    late_fee.innerHTML = response.late_fee;
    let cover_img_path = "images/book_covers/"
    cover_img.src = cover_img_path.concat(response.cover_img, "?", response.updated_at);
    
}

// function to clear Material information in BorrowBook Blade
function clearReturnDetails(book){
    username.innerHTML = "";
    borrowed.innerHTML = "";
    available.innerHTML = "";
    privilege.innerHTML = "";
    title.innerHTML = "";
    ISBN.innerHTML = "";
    author.innerHTML = "";
    publication.innerHTML = "";
    language.innerHTML = "";
    access_level.innerHTML = "";
    access_dot.className = "";
    cover_img.src = "images/book_covers/no_book_cover.jpg";
    borrowed_at.innerHTML = "";
    due_at.innerHTML = "";
}