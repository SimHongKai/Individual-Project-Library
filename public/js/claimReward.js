// set variables
var reward = document.getElementById("reward");
var description = document.getElementById("description");
var points_spent = document.getElementById("points_spent");
var claimed_on = document.getElementById("claimed_on");
var username = document.getElementById("username");
var reward_img = document.getElementById("reward_img");

// function to get Material information with AJAX
function getClaimDetails(reward_history_id){
    clearClaimDetails();
    // do nothing unless 8 characters are entered
    if (reward_history_id.length < 8){
        return
    }
    // fetch
    fetch('claim_reward/get-claim-details', {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": $('meta[name="csrf_token"]').attr('content')
        },
        body: JSON.stringify({reward_history_id: reward_history_id}),
        method: 'post',
        credentials: "same-origin",})
    .then(function (response) {
        // get response and convert to JSON
        return response.json();
    })
    .then(function (response) {
        // handle response JSON
        console.log(response);
        setClaimDetails(response);
    })
    .catch(function(error){
        // log errors
        console.log(error);
    });    
}

// function to set Material information in BorrowBook Blade
function setClaimDetails(rewardHistory){
    username.innerHTML = rewardHistory.username;
    reward.innerHTML = rewardHistory.name;
    description.innerHTML = rewardHistory.description;
    points_spent.innerHTML = rewardHistory.points_required;
    claimed_on.innerHTML = rewardHistory.created_at;
    let reward_img_path = "images/rewards/"
    reward_img.src = reward_img_path.concat(rewardHistory.reward_img);
}

// function to clear Material information in BorrowBook Blade
function clearClaimDetails(rewardHistory){
    username.innerHTML = "";
    reward.innerHTML = "";
    description.innerHTML = "";
    points_spent.innerHTML = "";
    claimed_on.innerHTML = "";
    reward_img.src = "images/rewards/no_img_available.jpg";
}
