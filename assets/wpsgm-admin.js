function copyShorcode() {
    var copyText = document.getElementById("shorcodeInput");

    copyText.disabled = false;
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");

    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copied: " + copyText.value;
    copyText.disabled = true;
}

function tooltipHandler() {
    var tooltip = document.getElementById("myTooltip");
    tooltip.innerHTML = "Copy to clipboard";
}
