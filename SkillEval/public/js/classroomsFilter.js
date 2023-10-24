document.addEventListener("DOMContentLoaded", function () 
{
    const course_id = document.getElementById("course_id");
    const classroomSelect = document.getElementById("classroom_id");

    function clearClassrooms() 
    {
        for (const option of classroomSelect.options) 
            option.style.display = "none";
    }

    clearClassrooms();

    function updateClassrooms() 
    {
        const selectedCourseId = course_id.value;

        if (selectedCourseId === "") 
            clearClassrooms();
        else 
        {
            for (const option of classroomSelect.options) {
                if (option.dataset.course === selectedCourseId) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            }
        }
    }

    course_id.addEventListener("change", function () 
    {
        updateClassrooms();
        classroomSelect.value = "";
    });

    updateClassrooms();
});
