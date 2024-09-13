document.addEventListener('DOMContentLoaded', function () {
    let groupIndex = getElementIndex('url'); // Starting index for new groups
    groupIndex++;
    // Function to create a new group
    function createNewGroup() {
        const groupContainer = document.getElementById('group-container');
        const newGroup = document.createElement('div');
        newGroup.classList.add('group-a');
        newGroup.innerHTML = `
            <div data-repeater-item="" style="">
                <div class="row">
                    <div class="mb-6 col-lg-6 col-xl-4 col-12 mb-0">
                        <label class="form-label" for="url-${groupIndex}">URL</label>
                        <input type="text" id="url-${groupIndex}" name="url-${groupIndex}" class="form-control" placeholder="john.doe">
                    </div>
                    <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0">
                        <label class="form-label" for="username-${groupIndex}">Username</label>
                        <input type="text" id="username-${groupIndex}" class="form-control" placeholder="john.doe">
                    </div>
                    <div class="mb-6 col-lg-6 col-xl-3 col-12 mb-0 form-password-tog">
                        <label class="form-label" for="password-${groupIndex}">Password</label>
                        <div class="input-group input-group-merge has-validation">
                            <input type="password" id="password-${groupIndex}" class="form-control" placeholder="············">
                            <span class="input-group-text cursor-pointer toggle-password"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-6 col-lg-12 col-xl-2 col-12 d-flex align-items-end mb-0">
                        <button class="btn btn-label-danger" data-repeater-delete="" type="button">
                            <i class="bx bx-x me-1"></i>
                            <span class="align-middle">Delete</span>
                        </button>
                    </div>
                </div>
                <hr class="mt-0">
            </div>
        `;
        groupContainer.appendChild(newGroup);
        groupIndex++;
        attachDeleteEvent(newGroup);
    }

    // Attach delete event to a group
    function attachDeleteEvent(groupElement) {
        const deleteButton = groupElement.querySelector('[data-repeater-delete]');
        deleteButton.addEventListener('click', function () {
            const groupContainer = document.getElementById('group-container');
            if (groupContainer.querySelectorAll('.group-a').length > 1) {
                groupElement.remove();
            } else {
                alert('At least one group must remain.');
            }
        });
    }

    function getElementIndex(element){
        let lastIndex = 0;

        $('input[id^="'+element+'-"]').each(function() {
            // Extract the numeric part of the ID
            let currentId = $(this).attr('id');
            let currentIndex = parseInt(currentId.split('-')[1]);

            // Keep track of the highest index
            if (currentIndex > lastIndex) {
                lastIndex = currentIndex;
            }
        });
        return lastIndex;
    }

    // Initial delete button event attachment
    document.querySelectorAll('[data-repeater-delete]').forEach(btn => {
        btn.addEventListener('click', function () {
            const groupContainer = document.getElementById('group-container');
            if (groupContainer.querySelectorAll('.group-a').length > 1) {
                btn.closest('.group-a').remove();
            } else {
                alert('At least one group must remain.');
            }
        });
    });

    // Add new group button event
    document.getElementById('add-new-group').addEventListener('click', function (e) {
        e.preventDefault();
        createNewGroup();
    });

    document.getElementById('group-container').addEventListener('click', function(event) {
        console.log(event.target.classList);
        if (event.target.classList.contains('bx-hide') || event.target.classList.contains('bx-show')) {

            console.log("insi");
            var input = event.target.closest('.form-password-tog').querySelector('input[type="password"], input[type="text"]');
            var icon = event.target;

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("bx-hide", "bx-show");
            } else {
                input.type = "password";
                icon.classList.replace("bx-show", "bx-hide");
            }
        }
    });
});


