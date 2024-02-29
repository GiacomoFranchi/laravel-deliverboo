
    // importare la libreria
import Chart from 'chart.js/auto';
    
    const ctx = document.getElementById('restaurantShowChart').getContext('2d');


    const colors = [];
    const dynamicColors = function() {
        let r = Math.floor(Math.random() * 255);
        let g = Math.floor(Math.random() * 255);
        let b = Math.floor(Math.random() * 255);
        return "rgb(" + r + "," + g + "," + b + ")";
    };

    for (let i = 0; i < mostOrderedFoodsData.length; i++) {
        colors.push(dynamicColors()); 
    }
    const showChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: mostOrderedFoodsLabels ,
            datasets: [{
                label: 'Most Ordered Foods',
                data: mostOrderedFoodsData,
                backgroundColor: colors,
                borderColor: 'rgb(255, 255, 255)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    display: false
                }
            }
        }
    });