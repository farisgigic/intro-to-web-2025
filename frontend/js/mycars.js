document.querySelectorAll('.details-btn').forEach(function (button) {
    button.addEventListener('click', function () {
        const carDetails = this.closest('.car-card').querySelector('.car-details');
        const isCollapsed = carDetails.classList.contains('collapsed');

        if (isCollapsed) {
            carDetails.classList.remove('collapsed');
            this.innerHTML = 'Hide details <i class="fa fa-chevron-up"></i>';
        } else {
            carDetails.classList.add('collapsed');
            this.innerHTML = 'View details <i class="fa fa-chevron-down"></i>';
        }
    });
});
