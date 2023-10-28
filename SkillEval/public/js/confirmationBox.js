document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".deleteBtn");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const Id = this.getAttribute("data-id");
            const Name = this.getAttribute("data-name");
            const Entity = this.getAttribute("data-entity");
            showConfirmationBox(Id, Name, Entity);
        });
    });

    function showConfirmationBox(Id, Name, Entity) {
        const confirmationMessage = getConfirmationMessage(Entity, Name);
        document.getElementById("Name").textContent = confirmationMessage;
        document.getElementById("confirmationBox").style.display = "block";

        const confirmYesButton = document.getElementById("confirmYesButton");
        confirmYesButton.addEventListener("click", function () {
            confirmDelete(Id, getRoute(Entity));
        });

        const confirmNoButton = document.getElementById("confirmNoButton");
        confirmNoButton.addEventListener("click", function () {
            hideConfirmationBox();
        });
    }

    function hideConfirmationBox() {
        document.getElementById("confirmationBox").style.display = "none";
    }

    function confirmDelete(Id, route) {
        document.getElementById(route + Id).submit();
    }

    function getConfirmationMessage(entity, name) {
        switch (entity) {
            case "students":
                return `Tem a certeza que pretende apagar o aluno com o nome "${name}"?`;
            case "courses":
                return `Tem a certeza que pretende apagar o curso "${name}"? Também irá apagar as turmas associadas a este curso.`;
            case "classrooms":
                return `Tem a certeza que pretende apagar a turma "${name}"? Também irá apagar os alunos associados a esta turma.`;
            case "users":
                return `Tem a certeza que pretende apagar o utilizador com o nome "${name}"?`;
            default:
                return `Tem a certeza que pretende apagar o item com o nome "${name}"?`;
        }
    }

    function getRoute(entity) {
        switch (entity) {
            case "students":
                return "studentRmvForm";
            case "courses":
                return "courseRmvForm";
            case "classrooms":
                return "clasroomRmvForm";
            case "users":
                return "userRmvForm";
            default:
                return "defaultRmvForm";
        }
    }
});
