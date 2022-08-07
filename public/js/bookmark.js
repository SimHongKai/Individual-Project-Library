// JS Bookmark
// get the Bookmark Btn
var btn = document.getElementById('bookmark_btn');
var ISBN = document.getElementById('')
// When click button
function bookmarkBtnClick(ISBN){
    // if Btn is bookmarked/active remove it
    if (btn.classList.contains("active")) {
        btn.classList.remove("active")
        bookmark(ISBN, removeBookmarkURL);
        //btn.html(bookmarkOff);
    //else add it
    } else {
        btn.classList.add("active");
        bookmark(ISBN, addBookmarkURL);
        //btn.html(bookmarkOn);
    }
}

// Add/remove bookmark from DB
// fetch
function bookmark(ISBN, BookmarkURL){
    fetch(BookmarkURL, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
        },
        body: JSON.stringify({ISBN: ISBN}),
        method: 'post',
        credentials: "same-origin",})
    .then(function (response) {
        // get response and convert to JSON
        return response.json();
    })
    .then(function (response) {
        // handle response JSON
        console.log(response);
    })
    .catch(function(error){
        // log errors
        console.log(error);
    });
}

// JQuery Bookmark
// $(function() {
//     //var bookmarkOn = '<i class="fa fa-bookmark"></i>'
//     //var bookmarkOff = '<i class="fa fa-bookmark-o"></i>'
  
//     $('.pp-bookmark-btn')
//       //.html( $('.pp-bookmark-btn').data('state') ? bookmarkOn : bookmarkOff )
//       //.html( $('.pp-bookmark-btn').hasClass( "active" ) ? bookmarkOn : bookmarkOff )
//       .click(function() {
//         var btn = $(this);
  
//         var context = $(this).data("context");
//         var contextAction = $(this).data("context-action");
//         var contextId = $(this).data("context-id");
//         // $('#log').html(context + " " + contextAction + " " + contextId )
  
//         // if( btn.data('state') ) {
//         //    btn.data('state', false);
//         if (btn.hasClass("active")) {
//           btn.removeClass("active")
//             // $getJSON
//             //btn.html(bookmarkOff);
//         } else {
//           // btn.data('state', true);
//           btn.addClass("active");
//           //btn.html(bookmarkOn);
//         };
//       });
  
//     /*
//       updateBookmarks(action, context, context-action, context-id) {
      
//       }
//       */
//     //     $('form').html('asfafaf');
//     //     var btn = $('form').attr('action');
//     //     var jqxhr = $.ajax({
//     //         url: '/echo/html/',
//     //         dataType: 'json',
//     //         data:{ id: $('form input').val() }
//     //     })
//     //     .success(function(data) {
//     //         alert("success"+data);
//     //     })
//     //     .error(function(err) {
//     //         alert("error"+err);
//     //     })
//     //     .complete(function(stuff) {
//     //         alert("complete"+stuff);
//     //     });
//     //
//     //     e.preventDefault();
  
//   });