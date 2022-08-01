// JS to show Cover Image Preview
cover_img.onchange = evt => {
    const [file] = cover_img.files
    if (file) {
        preview.style.visibility = 'visible';

        preview.src = URL.createObjectURL(file)
    }
}

var priceInput=document.getElementById("price");
var priceSlider=document.getElementById("priceSlider");

///update value of slider based on input
function updatePriceSlider(){
    priceSlider.value=priceInput.value;
}

//calling function on change of inputs to update in slider
priceInput.addEventListener("change",updatePriceSlider);

///update value of input based on slider
function updatePriceInput(){//slider update inputs
    priceInput.value=priceSlider.value;
}

//calling function on change of slider to update inputs
priceSlider.addEventListener("change",updatePriceInput);