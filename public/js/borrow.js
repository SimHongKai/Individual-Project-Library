// function to get user information with AJAX
function getMaterialInfo(material_no){
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
        if (response.login){
            var cartQty = document.getElementById('cartQty');
            var cartPrice = document.getElementById('cartPrice');
                       
            console.log(response);
            cartQty.innerHTML = response.qty;
            cartPrice.innerHTML = "RM"+ response.price;
        }
        else{
            window.location.href = "{{ route('LoginUser') }}";
        }
    })
    .catch(function(error){
        // log errors
        console.log(error)
    });    
}