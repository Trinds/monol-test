document.addEventListener("DOMContentLoaded", function () {
    const course_id = document.getElementById("course_id");
    const classroomSelect = document.getElementById("classroom_id");

    function updateClassrooms() {
        const selectedCourseId = course_id.value;

        for (const option of classroomSelect.options) {
            option.dataset.course === selectedCourseId
                ? (option.style.display = "block")
                :
                ((option.style.display = "none"));
        }
    }

    course_id.addEventListener("change", function () {
        updateClassrooms();
        classroomSelect.value = "";
    });
    updateClassrooms();
});
