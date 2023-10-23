document.addEventListener("DOMContentLoaded", function () {
    const editBtn = document.getElementById("buttonEdit");
    const cancelBtn = document.getElementById("buttonCancel");
    const saveBtn = document.getElementById("buttonSave");

    const nameH1 = document.getElementById("studentNameH1");
    const nameInput = document.getElementById("studentNameInput");
    const imageInput = document.getElementById("studentImageInput");
    const emailInput = document.getElementById("email");
    const classroomView = document.getElementById("studentClassroomView");
    const classroomInput = document.getElementById("classroomDropdowns");
    const numberInput = document.getElementById("studentNumberInput");
    const birthDateView = document.getElementById("birthDateView");
    const birthDateInput = document.getElementById("birthDateInput");
    const course_id = document.getElementById("course_id");

    editBtn.addEventListener("click", function () {
        nameH1.hidden = true;
        nameInput.hidden = false;
        imageInput.hidden = false;
        emailInput.removeAttribute("readonly");
        classroomView.hidden = true;
        classroomInput.hidden = false;
        numberInput.removeAttribute("readonly");
        birthDateView.hidden = true;
        birthDateInput.hidden = false;
        saveBtn.hidden = false;
        cancelBtn.hidden = false;
        editBtn.hidden = true;
    });

    cancelBtn.addEventListener("click", function () {
        nameH1.hidden = false;
        nameInput.hidden = true;
        imageInput.hidden = true;
        emailInput.setAttribute("readonly", true);
        classroomView.hidden = false;
        classroomInput.hidden = true;
        numberInput.setAttribute("readonly", true);
        birthDateView.hidden = false;
        birthDateInput.hidden = true;
        saveBtn.hidden = true;
        cancelBtn.hidden = true;
        editBtn.hidden = false;
    });

    course_id.addEventListener("change", function () {
        actClassrooms();
        classroom_id.value = "Selecione...";
    });
    function actClassrooms(){
        const selectedCourseId = course_id.value;
        const classroomSelect = document.getElementById("classroom_id");
        for (const option of classroomSelect.options) {
            if (
                selectedCourseId === "" ||
                option.dataset.course === selectedCourseId
            ) {
                option.style.display = "block";
            } else {
                option.style.display = "none";
            }
        }
    }
    actClassrooms()
});
