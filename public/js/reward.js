// JS to show Reward Image Preview
reward_img.onchange = evt => {
    const [file] = reward_img.files
    if (file) {
        preview.style.visibility = 'visible';

        preview.src = URL.createObjectURL(file)
    }
}