
function showLoadingSpinner() {
    var opts = {
        lines: 12,
        length: 18,
        width: 11,
        radius: 30,
        scale: 0.55,
        corners: 1,
        speed: 1,
        rotate: 0,
        animation: "spinner-line-fade-quick",
        direction: 1,
        color: "#7573fc",
        fadeColor: "transparent",
        top: "40%",
        left: "50%",
        shadow: "0 0 1px transparent",
        zIndex: 2000000000,
        className: "spinner",
        position: "absolute",
    };
    var spinner = new Spin.Spinner(opts).spin();
    document.body.appendChild(spinner.el);
}

function hideLoadingSpinner() {
    document.body.removeChild(document.querySelector(".spinner"));
}
