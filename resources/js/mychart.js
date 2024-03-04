// importare la libreria
import Chart from 'chart.js/auto';

// map sui dati del ristorante x separare array di nomi, ordini totali e guadagni totali
// preparare i dati x usarli nelle stats
const restaurantNames = restaurantsData.map(data => data.name);
const totalOrders = restaurantsData.map(data => data.total_orders);
const totalRevenue = restaurantsData.map(data => data.total_revenue);

// prendere il canvas contex dove andranno le stats 
const ctx = document.getElementById('restaurantsChart').getContext('2d');

// creare nuova istanza chart specificando il tipo (bar x iniziare) e dati da usare
const myChart = new Chart(ctx, {
    type: 'bar', // tipologia
    data: {
        labels: restaurantNames, // label x asse x : nomi dei ristoranti  
        datasets: [{ // dati x la bar chart e stile
            label: 'Total Orders', // label x il primo set di dati 
            data: totalOrders, // dati x total orders.
            backgroundColor: 'rgba(54, 162, 235, 0.2)', 
            borderColor: 'rgba(54, 162, 235, 1)', 
            borderWidth: 1 // larghezza del bordo attorno le barre
        },
        {
            label: 'Total Revenue in €', // label x secondo set di dati
            data: totalRevenue, // dati x total revenue
            backgroundColor: 'rgba(255, 99, 132, 0.2)', 
            borderColor: 'rgba(255, 99, 132, 1)', 
            borderWidth: 1 
        }]
    },
    //options: oggetto che contiene svariati setting x personalizzare le chart
    options: {
        responsive: true,
        maintainAspectRatio: true, 
        scales: { // questo configura gli assi
            y: { // configurazione x asse Y
                beginAtZero: true //l'asse y inizia a 0
            }
        }
    }
});


// const ctx = document.getElementById('anotherRestaurantChart').getContext('2d');

// const myScatterChart = new Chart(ctx, {
//     type: 'scatter',
//     data: {
//         datasets: [{
//             label: 'Ordini e Guadagni',
//             data: restaurantsData.map(data => ({
//                 x: data.totalOrders, // Numero degli ordini
//                 y: data.totalRevenue // Guadagno totale
//             })),
//             backgroundColor: 'rgba(255, 99, 132, 0.2)',
//             borderColor: 'rgba(255, 99, 132, 1)',
//         }]
//     },
//     options: {
//         scales: {
//             x: {
//                 title: {
//                     display: true,
//                     text: 'Numero degli Ordini'
//                 }
//             },
//             y: {
//                 title: {
//                     display: true,
//                     text: 'Guadagno Totale'
//                 }
//             }
//         }
//     }
// });






