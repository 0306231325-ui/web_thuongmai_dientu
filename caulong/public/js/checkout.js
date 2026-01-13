document.addEventListener('DOMContentLoaded', function () {
    const addressSelector = document.getElementById('address-selector');
    if (addressSelector) {
        addressSelector.addEventListener('change', function () {
            var selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                var name = selectedOption.getAttribute('data-name');
                var phone = selectedOption.getAttribute('data-phone');
                var address = selectedOption.value;

                document.getElementById('inputName').value = name ? name : '';
                document.getElementById('inputPhone').value = phone ? phone : '';
                document.getElementById('inputAddress').value = address ? address : '';
            } else {
                
            }
        });
    }
});