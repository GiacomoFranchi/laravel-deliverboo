//attendere caricamento dom
document.addEventListener('DOMContentLoaded', async function () {
    // ottenere id food item e ristorante selezionato 
    const foodItemsContainer = document.getElementById('foodItemsContainer');
    const restaurantSelect = document.getElementById('restaurantSelect');
    const newOrder = document.getElementById('newOrderBtn');
    if (newOrder) {
        newOrder.addEventListener('click', function() {
            // Pulisce sessionStorage
            sessionStorage.removeItem('selectedFoodItems');
            sessionStorage.removeItem('selectedRestaurantId');
            console.log('SessionStorage pulito per un nuovo ordine');

        });
    }

    //se old session presenti recurpera, altrimenti inizializza array vuoto
    let oldFoodItems = JSON.parse(sessionStorage.getItem('selectedFoodItems') || '[]');

    // se esiste un id ristorante salvato in storage lo prende
    const storedRestaurantId = sessionStorage.getItem('selectedRestaurantId');
    if (storedRestaurantId) {
        restaurantSelect.value = storedRestaurantId;
        // carica gli items associati all'id del ristorante 
        loadFoodItems(storedRestaurantId);
    }

    // listener x cambio selezione ristoranti
    restaurantSelect.addEventListener('change', async function() {
        const restaurantId = this.value;
        //debug
        console.log(restaurantId);
        
        // salva id ristorante  nel sessionStorage
        sessionStorage.setItem('selectedRestaurantId', restaurantId);
        // carica food item in base a id ristorante
        loadFoodItems(restaurantId);
    });

    // funzione asincrona per caricare gli food items
    async function loadFoodItems(restaurantId) {
        // pulire container
        foodItemsContainer.innerHTML = '';
        try {
            // richiesta al server per rendere food item da restaurant id 
            const response = await fetch('/admin/orders/' + restaurantId + '/food-items');
            if (!response.ok) {
                throw new Error(`Errore: ${response.status}`);
            }
            //risposta in json
            const data = await response.json(); 
            console.log(data); // debug


            //x ogni item aggiunge i vari elementi 
            data.forEach(item => {
                const div = document.createElement('div');
                div.className = 'form-check';

                const input = document.createElement('input');
                input.type = 'checkbox';
                input.className = 'form-check-input';
                input.name = 'food_items[]';
                input.id = 'item' + item.id;
                input.value = item.id;

                // se item è dentro old item, lo seleziona
                if (oldFoodItems.includes(item.id.toString())) {
                    input.checked = true;
                }

                const label = document.createElement('label');
                label.htmlFor = 'item' + item.id;
                label.className = 'form-check-label';
                label.textContent = item.name;

                const quantityInput = document.createElement('input');
                quantityInput.type = 'number';
                quantityInput.className = 'form-control ml-2';
                quantityInput.name = 'quantities[]';
                quantityInput.style.maxWidth = '80px';
                quantityInput.min = '1';
                quantityInput.value = '1'; // quantità di default
                quantityInput.id = 'quantity' + item.id;
                //abulita l'input quantità solo con selezione di fooditem
                quantityInput.disabled = !input.checked; 

                // visibilità checkbox quantità a seconda della selezione
                input.addEventListener('change', function() {
                    quantityInput.disabled = !this.checked;
                    // aggiorna array degli elementi selezionati e session storage
                    if (this.checked) {
                        if (!oldFoodItems.includes(item.id.toString())) {
                            oldFoodItems.push(item.id.toString());
                        }
                    } else {
                        oldFoodItems = oldFoodItems.filter(id => id !== item.id.toString());
                    }
                    sessionStorage.setItem('selectedFoodItems', JSON.stringify(oldFoodItems));
                });

                // aggiunge gli elementi creati al container
                div.appendChild(input);
                div.appendChild(label);
                div.appendChild(quantityInput);
                foodItemsContainer.appendChild(div);
            });
        } catch (error) {
            console.error('Errore:', error);
        }
    }
    
});
