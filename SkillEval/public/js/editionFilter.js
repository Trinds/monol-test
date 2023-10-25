document.addEventListener("DOMContentLoaded", function () {
    const courseSelect = document.getElementById("course_filter");
    const classroomSelect = document.getElementById("classroom_filter");


    function clearClassrooms() {
        for (const option of classroomSelect.options) {
            option.style.display = "none";
        }
    }

    clearClassrooms();

    function updateClassrooms() {
        const selectedCourseId = courseSelect.value;
        if (selectedCourseId === "") {
            clearClassrooms();
        } else {
            for (const option of classroomSelect.options) {
                if (option.getAttribute('data-course') === selectedCourseId) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            }
        }
    }

    courseSelect.addEventListener("change", function () {
        updateClassrooms();
        classroomSelect.value = "";
    });



    updateClassrooms();
});
