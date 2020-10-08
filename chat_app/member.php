<?php
/**
* Template Name: User Member
*/
get_header();
?>
<canvas id="myChart" width="100px" height="100px"></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myRadarChart = new Chart(ctx, {
    type: 'radar',
    data: {
    labels: ['555', '60 days', '30 days', 'Renew'],
    datasets: [{
        data: ['5 girls', 10, 4, 2]
    }]
},
 options: {
    scale: {
        angleLines: {
            display: true
        },
        ticks: {
            suggestedMin: 0,
            suggestedMax: 100
        }
    }
}
});
</script>

<?php
get_footer();
?>