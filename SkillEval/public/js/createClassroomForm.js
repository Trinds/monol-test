document.addEventListener("DOMContentLoaded", function () {
    const manualForm = document.getElementById("manualForm");
    const importForm = document.getElementById("importForm");
    const manualRadio = document.getElementById("manualRadio");
    const importRadio = document.getElementById("importRadio");

    manualRadio.addEventListener("click", function () {
        manualForm.style.display = "block";
        importForm.style.display = "none";
    });

    importRadio.addEventListener("click", function () {
        manualForm.style.display = "none";
        importForm.style.display = "block";
    });
});
