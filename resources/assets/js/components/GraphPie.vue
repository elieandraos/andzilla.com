<template>
    <div class="chart-container" style="position: relative; height:50vh; width:100%">
        <canvas :id="chartId"></canvas>
    </div>
    
</template>

<script>
	import Chart from 'chart.js';

    export default {
    	props : ['datasets', 'labels'],
        data(){
            return {
            	context: '',
                chartId: this.randId(),
                backgroundColor: [
                    "#EF9A9A", "#CE93D8", "#9FA8DA", "#80CBC4", "#90CAF9", "#E6EE9C", "#FFCC80", "#B0BEC5"
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
                type: 'doughnut',
                data: { 
                     datasets: [{
                        data: this.datasets,
                        backgroundColor: this.backgroundColor
                    }],
                    labels: this.labels,
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        mode: 'single',
                        callbacks: {
                            title: function(tooltipItem, data) {
                              return data['labels'][tooltipItem[0]['index']];
                            },
                            label: function(tooltipItem, data) {
                              return " " + data['datasets'][0]['data'][tooltipItem['index']] + " $";
                            }
                        }
                    },
                }
            });
        }
    }
</script>

