<template>
    <div class="chart-container" style="position: relative; height:50vh; width:100%">
        <canvas :id="chartId"></canvas>
    </div>
    
</template>

<script>
	import Chart from 'chart.js';

    export default {
    	props : ['datasets', 'labels', 'type'],
        data(){
            return {
            	context: '',
                chartId: this.randId(),
                backgroundColor: [
                    "#EF9A9A", "#CE93D8", "#9FA8DA", "#80CBC4", "#90CAF9", "#E6EE9C", "#FFCC80", "#B0BEC5",
                    "#EF5350", "#AB47BC", "#7E57C2", "#42A5F5", "#26C6DA", "#26A69A", "#D4E157", "#FFCA28",
                ]
            }
        },
        methods: {
            randId() {
                 return Math.random().toString(36).substr(2, 10);
            }
        },
        mounted() {
            this.context = document.getElementById(this.chartId);

            new Chart(this.context, {
                type: 'bar',
                data: { 
                    datasets: this.datasets,
                    labels: this.labels,
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                padding: 20,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                 // how to set padding here?
                            }
                        }]
                    },
                    // tooltips: {
                    //     enabled: true,
                    //     mode: 'single',
                    //     callbacks: {
                    //         title: function(tooltipItem, data) {
                    //           return data['labels'][tooltipItem[0]['index']];
                    //         },
                    //         label: function(tooltipItem, data) {
                    //           return " " + data['datasets'][0]['data'][tooltipItem['index']] + " $";
                    //         }
                    //     }
                    // },
                }
            });
        }
    }



</script>

