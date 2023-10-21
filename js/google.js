google.charts.load('current', { 'packages': ['corechart'] });
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
        var data = google.visualization.arrayToDataTable([
                ['Color', 'Quantity'],
                ['Orange', 11],
                ['Black', 2],
                ['Red', 1],
                ['White', 2],
                ['Green', 7]
        ]);
}