document.addEventListener('DOMContentLoaded', async function () {


    //listener dropdown dei ristoranti
    document.getElementById('restaurantSelect').addEventListener('change', async function() {
        const restaurantId = this.value;
        console.log(restaurantId); // prendi l'id del ristorante

        const foodItemsContainer = document.getElementById('foodItemsContainer');
        foodItemsContainer.innerHTML = ''; //pulisci container 
        try {
            //ottenere gli fooditem  su id del ristorante
            const response = await fetch('/admin/orders/' + restaurantId + '/food-items');
            if (!response.ok) {
                //gestire gli errori di risposta
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            //converte risposta in json
            const data = await response.json();
            console.log(data); // Log debug

            // aggiornare il dom con food items 
            data.forEach(item => {
                // div x ogni articolo
                const div = document.createElement('div');
                div.className = 'form-check';
                // input di tipo checkbox x fooditem
                const input = document.createElement('input');
                input.type = 'checkbox';
                input.className = 'form-check-input';
                input.name = 'food_items[]';
                //valore univoco x input
                input.id = 'item' + item.id;
                //imposta valore di imput come id fooditem
                input.value = item.id;
                //crea una label x l'input

                const label = document.createElement('label');
                label.htmlFor = 'item' + item.id;
                label.className = 'form-check-label';
                //impostare testo label come nome dell'articolo
                label.textContent = item.name;

                // input numerico x quantità
                const quantityInput = document.createElement('input');
                quantityInput.type = 'number';
                quantityInput.className = 'form-control ml-2';
                quantityInput.name = 'quantities[]';
                quantityInput.style.maxWidth = '80px';
                quantityInput.min = '1'; // quantità minima
                quantityInput.value = '1'; // quantità default
                quantityInput.id = 'quantity' + item.id;

                // disabilità inizialmente qiantità
                quantityInput.disabled = true;

                // false quando il checkbox viene selezionato
                input.addEventListener('change', function() {
                    quantityInput.disabled = !this.checked;
                });
                //aggiunge input a div
                div.appendChild(input);
                div.appendChild(label);
                div.appendChild(quantityInput);
                //aggiungo div a contenitore
                foodItemsContainer.appendChild(div);
            });
        } catch (error) {
            console.error('Errore:', error);
           
        }
    });
});
