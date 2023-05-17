'use strict';

/* Chart.js docs: https://www.chartjs.org/ */

window.chartColors = {
	green: '#75c181',
	gray: '#a9b5c9',
	text: '#252930',
	border: '#e7e9ed',
	blue: '#297fb8'
};

/* Random number generator for demo purpose */
var randomDataPoint = function () { return Math.round(Math.random() * 10000) };


//Chart.js Line Chart Example 
const labelchats = document.querySelector('#labelsLineChart');
if (labelchats) {
	var lineChartConfig = {
		type: 'line',

		data: {
			labels: JSON.parse(document.querySelector('#labelsLineChart').innerHTML),

			datasets: [{
				label: 'Atendimento',
				fill: false,
				backgroundColor: window.chartColors.green,
				borderColor: window.chartColors.green,
				data: JSON.parse(document.querySelector('#dataLineService').innerHTML),
			}, {
				label: 'Comida',
				borderDash: [3, 5],
				backgroundColor: window.chartColors.blue,
				borderColor: window.chartColors.blue,
				data: JSON.parse(document.querySelector('#dataLineFood').innerHTML),
				fill: false,
			}]
		},
		options: {
			responsive: true,
			aspectRatio: 1.5,

			legend: {
				display: true,
				position: 'bottom',
				align: 'end',
			},

			title: {
				display: true,
				text: 'Quantidade de avaliações por dia (' + document.getElementById('canvas-linechart').dataset?.initDate?.split('_').join('/') + ' à ' + document.getElementById('canvas-linechart').dataset?.endDate?.split('_').join('/') + ')',

			},
			tooltips: {
				mode: 'index',
				intersect: false,
				titleMarginBottom: 10,
				bodySpacing: 10,
				xPadding: 16,
				yPadding: 16,
				borderColor: window.chartColors.border,
				borderWidth: 1,
				backgroundColor: '#fff',
				bodyFontColor: window.chartColors.text,
				titleFontColor: window.chartColors.text,

				callbacks: {

					//Ref: https://stackoverflow.com/questions/38800226/chart-js-add-commas-to-tooltip-and-y-axis
					label: function (tooltipItem, data) {
						if (parseInt(tooltipItem.value) >= 1000) {
							return tooltipItem.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
						} else {
							return tooltipItem.value;
						}
					},
					title: function () {
						console.log('teste')
					},
				},

			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
					display: true,
					gridLines: {
						drawBorder: false,
						color: window.chartColors.border,
					},
					scaleLabel: {
						display: false,

					}
				}],
				yAxes: [{
					display: true,
					gridLines: {
						drawBorder: false,
						color: window.chartColors.border,
					},
					scaleLabel: {
						display: false,
					},
					ticks: {
						beginAtZero: true,
						userCallback: function (value, index, values) {
							return value.toLocaleString();   //Ref: https://stackoverflow.com/questions/38800226/chart-js-add-commas-to-tooltip-and-y-axis
						}
					},
				}]
			}
		}
	};



	// Chart.js Bar Chart Example 

	var barChartConfig = {
		type: 'bar',

		data: {
			labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
			datasets: [{
				label: 'Orders',
				backgroundColor: window.chartColors.green,
				borderColor: window.chartColors.green,
				borderWidth: 1,
				maxBarThickness: 16,

				data: [
					23,
					45,
					76,
					75,
					62,
					37,
					83
				]
			}]
		},
		options: {
			responsive: true,
			aspectRatio: 1.5,
			legend: {
				position: 'bottom',
				align: 'end',
			},
			title: {
				display: true,
				text: 'Chart.js Bar Chart Example'
			},
			tooltips: {
				mode: 'index',
				intersect: false,
				titleMarginBottom: 10,
				bodySpacing: 10,
				xPadding: 16,
				yPadding: 16,
				borderColor: window.chartColors.border,
				borderWidth: 1,
				backgroundColor: '#fff',
				bodyFontColor: window.chartColors.text,
				titleFontColor: window.chartColors.text,

			},
			scales: {
				xAxes: [{
					display: true,
					gridLines: {
						drawBorder: false,
						color: window.chartColors.border,
					},

				}],
				yAxes: [{
					display: true,
					gridLines: {
						drawBorder: false,
						color: window.chartColors.borders,
					},


				}]
			}

		}
	}
}






// Generate charts on load
window.addEventListener('load', function () {

	var lineChart = document.getElementById('canvas-linechart')?.getContext('2d');
	if (lineChart) {
		window.myLine = new Chart(lineChart, lineChartConfig);
	}


	var barChart = document.getElementById('canvas-barchart')?.getContext('2d');
	if (barChart) {
		window.myBar = new Chart(barChart, barChartConfig);
	}


	var date_filter = document.getElementById('filter_range');
	console.log(date_filter);
	if (date_filter) {
		const datepickerFilter = new DateRangePicker(date_filter, {
			buttonClass: 'btn',
			language: 'pt-BR',
			maxDate: new Date(),
			minDays: 3,
			maxDays: 7,

			changeDate: function () {
				console.log('change date')
			}

		});

	}


});

