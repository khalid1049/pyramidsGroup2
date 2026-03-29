document.addEventListener('DOMContentLoaded', function () {

    const exhibitorSelect = document.querySelector('[name="CustomerRequest[exhibitor]"]');
    const standSelect = document.querySelector('[name="CustomerRequest[stand]"]');

    if (!exhibitorSelect || !standSelect) return;

    exhibitorSelect.addEventListener('change', function () {

        const exhibitorId = this.value;

        if (!exhibitorId) return;

        const url = this.dataset.standUrl.replace('__id__', exhibitorId);

        fetch(url)
            .then(response => response.json())
            .then(data => {

                const tomSelect = standSelect.tomselect;
                tomSelect.clearOptions();
                tomSelect.clear();

                data.forEach(stand => {
                    tomSelect.addOption({ value: stand.id, text: stand.label });
                });

                tomSelect.refreshOptions(false);

            });

    });

    if (exhibitorSelect.value) {
        exhibitorSelect.dispatchEvent(new Event('change'));
    }

});