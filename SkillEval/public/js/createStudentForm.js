document.addEventListener('DOMContentLoaded', function () {
    var courseSelect = document.getElementById('course_id');
    var classroomSelect = document.getElementById('classroom_id');

    function updateClassrooms() {
        var selectedCourseId = courseSelect.value;
        
        for (var i = 0; i < classroomSelect.options.length; i++) {
            classroomSelect.options[i].style.display = 'none';
        }

        for (var i = 0; i < classroomSelect.options.length; i++) {
            var option = classroomSelect.options[i];
            if (option.getAttribute('data-course') === selectedCourseId) {
                option.style.display = 'block';
            }
        }

        if (classroomSelect.options[classroomSelect.selectedIndex].style.display === 'none') {
            classroomSelect.value = '';
        }
    }
    courseSelect.addEventListener('change', updateClassrooms);
    updateClassrooms();
});
