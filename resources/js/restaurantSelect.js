document.addEventListener('DOMContentLoaded', function () {
    //cerca cambiamenti
    document.getElementById('restaurantSelect').addEventListener('change', function() {
        let restaurantId = this.value;

        // prendi food items
        fetch('/admin/food-items/' + restaurantId)
            .then(response => response.json())
            .then(data => {
                let foodItemsContainer = document.getElementById('foodItemsContainer');
                foodItemsContainer.innerHTML = ''; // pulisci

                // aggiorna il dom
                data.forEach(item => {
                    let div = document.createElement('div');
                    div.className = 'form-check';

                    let input = document.createElement('input');
                    input.type = 'checkbox';
                    input.className = 'form-check-input';
                    input.name = 'food_items[]';
                    input.id = 'item' + item.id;
                    input.value = item.id;

                    let label = document.createElement('label');
                    label.htmlFor = 'item' + item.id;
                    label.className = 'form-check-label';
                    label.textContent = item.name;

                    div.appendChild(input);
                    div.appendChild(label);

                    foodItemsContainer.appendChild(div);
                });
            })
            .catch(error => {
                console.error('Error fetching food items:', error);
            });
    });
});
