document.addEventListener("DOMContentLoaded", function () {
    const courseSelect = document.getElementById("course_id");
    const classroomSelect = document.getElementById("classroom_id");

    function updateClassrooms() {
        const selectedCourseId = courseSelect.value;

        for (const option of classroomSelect.options) {
            selectedCourseId === "" ||
            option.dataset.course === selectedCourseId
                ? (option.style.display = "block")
                : ((option.style.display = "none"),
                (classroomSelect.value = ""));
        }
    }

    courseSelect.addEventListener("change", function () {
        updateClassrooms();
    });
});
