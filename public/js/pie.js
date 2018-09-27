//const Chart = require ('chart.js');
//console.log(Chart);

window.addEventListener('load', function() {
	var plotPieChart = document.querySelector('#pie-chart');
	plotPieChart.height = 130;
	const dataPie = {
		labels: ['Белый', 'Красный', 'Синий', 'Желтый'],
		datasets: [{
				label: 'Код категории',
				backgroundColor: ['#ffffff', 'red', 'blue', 'yellow'],
				data: [90, 92, 78, 66]
		}]
	};
	const optionsPie = {
		animation: {
			duration: 2000,
			animateScale: true
		}
	};
	var pieChart = new Chart ( plotPieChart, {
		type: 'pie',
		data: dataPie,
		options: optionsPie
	}); 	
}, false);