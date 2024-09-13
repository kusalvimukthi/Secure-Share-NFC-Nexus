document.addEventListener('DOMContentLoaded', function () {
    let groupIndex = getElementIndex('vaccine'); // Starting index for new groups
    groupIndex++;

    // Function to create a new group
    function createNewGroup() {
        const groupContainer = document.getElementById('group-container');
        const newGroup = document.createElement('div');
        newGroup.classList.add('group-a');
        newGroup.innerHTML = `
            <div data-repeater-item="" style="">
                <div class="row">
                    <div class="mb-6 col-lg-6 col-xl-4 col-12">
                        <label class="form-label" for="vaccine_${groupIndex}">vaccine name</label>
                        <input type="text" id="vaccine_${groupIndex}" class="form-control" placeholder="john.doe">
                    </div>
                    <div class="mb-6 col-lg-6 col-xl-3 col-12">
                        <label class="form-label" for="vaccination_date_${groupIndex}">vaccination date</label>
                        <input type="date" id="vaccination_date_${groupIndex}" class="form-control">
                    </div>
                    <div class="mb-6 col-lg-6 col-xl-3 col-12">
                        <label class="form-label" for="next_vaccination_date_${groupIndex}">Next vaccination date</label>
                        <input type="date" id="next_vaccination_date_${groupIndex}" class="form-control">
                    </div>
                    <div class="mb-6 col-lg-12 col-xl-2 col-12 d-flex align-items-end">
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

    function getElementIndex(element){
        let lastIndex = 0;

        $('input[id^="'+element+'_"]').each(function() {
            // Extract the numeric part of the ID
            let currentId = $(this).attr('id');
            let currentIndex = parseInt(currentId.split('_')[1]);

            // Keep track of the highest index
            if (currentIndex > lastIndex) {
                lastIndex = currentIndex;
            }
        });
        return lastIndex;
    }
});
