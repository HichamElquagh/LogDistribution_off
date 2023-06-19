<!DOCTYPE html>
<html>
<head>
  <title>Google Charts - Line and Bar Charts</title>
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .chart-container {
      margin-top: 20px;
      width: 100%;
    }

    .chart {
      width: 100%;
      height: 400px;
      margin-bottom: 20px;
    }

    .filter-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-direction: column;
      margin-top: 20px;
    }

    .filter-container label {
      margin-right: 10px;
    }

    .filter-container input[type="date"] {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .filter-container button {
      padding: 8px 12px;
      background-color: #FFBB44; /* Warning color */
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }

    /* Style the line chart */
    #line_chart {
      background-color: #fff3cd; /* Warning color */
      border: 1px solid #ffeeba; /* Warning color */
    }

    /* Style the bar chart */
    #bar_chart {
      background-color: #fff3cd; /* Warning color */
      border: 1px solid #ffeeba; /* Warning color */
    }
  </style>
  <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(fetchArticlesData);

    var articlesData = null; // Variable to store the fetched articles data

    function drawLineChart(chartId, startDate, endDate) {
      if (articlesData === null) {
        return;
      }

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Date');
      data.addColumn('number', 'Price');
      data.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});

      $.each(articlesData, function(index, article) {
        var articleName = article.article_libelle;
        var price = null;
        var createdAt = new Date(article.created_at);

        // Check if the article falls within the specified date range
        if (createdAt >= startDate && createdAt <= endDate) {
          price = parseFloat(article.prix_unitaire);
          var tooltip = '<div style="padding: 10px; font-family: Verdana, sans-serif;">' +
                        '<strong>' + articleName + '</strong><br>' +
                        'Price: ' + price.toFixed(2) + '</div>';
          data.addRow([createdAt, price, tooltip]);
        }
      });

      var options = {
        title: 'Article Prices - Line Chart',
        chartArea: {width: '80%', height: '70%'},
        hAxis: {title: 'Date'},
        vAxis: {title: 'Price'},
        legend: {position: 'none'},
        curveType: 'function',
        tooltip: {isHtml: true},
        width: '100%',
        height: '100%',
        series: {
          0: {color: '#FFBB44'} // Warning color
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById(chartId));
      chart.draw(data, options);
    }

    function drawBarChart(chartId, startDate, endDate) {
      if (articlesData === null) {
        return;
      }

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Article');
      data.addColumn('number', 'Price');

      $.each(articlesData, function(index, article) {
        var articleName = article.article_libelle;
        var price = null;
        var createdAt = new Date(article.created_at);

        // Check if the article falls within the specified date range
        if (createdAt >= startDate && createdAt <= endDate) {
          price = parseFloat(article.prix_unitaire);
          data.addRow([articleName, price]);
        }
      });

      var options = {
        title: 'Article Prices - Bar Chart',
        chartArea: {width: '80%', height: '70%'},
        hAxis: {title: 'Price'},
        vAxis: {title: 'Article'},
        legend: {position: 'none'},
        width: '100%',
        height: '100%',
        colors: ['#FFBB44'] // Warning color
      };

      var chart = new google.visualization.BarChart(document.getElementById(chartId));
      chart.draw(data, options);
    }

    function fetchArticlesData() {
      $.ajax({
        url: 'https://iker.wiicode.tech/api/articles',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          articlesData = response.data;

          // Get the start and end dates for the selected date range
          var startDate = new Date('2023-06-01');
          var endDate = new Date('2023-06-30');

          drawLineChart('line_chart', startDate, endDate); // Initial line chart rendering with selected date range
          drawBarChart('bar_chart', startDate, endDate); // Initial bar chart rendering with selected date range
        },
        error: function(error) {
          console.log(error);
        }
      });
    }

    function filterCharts(chartId) {
      // Get the start and end dates from the input fields
      var startDateString = $('#' + chartId + '_start_date').val();
      var endDateString = $('#' + chartId + '_end_date').val();

      var startDate = new Date(startDateString);
      var endDate = new Date(endDateString);

      if (chartId === 'line_chart') {
        drawLineChart(chartId, startDate, endDate); // Update the line chart with the selected date range
      } else if (chartId === 'bar_chart') {
        drawBarChart(chartId, startDate, endDate); // Update the bar chart with the selected date range
      }
    }
  </script>
</head>
<body>

<h2 class="text-center">Article Prices</h2>

<div class="row">
  <div class="col-md-6 col-sm-12">
    <div class="chart-container">
      <div id="line_chart" class="chart"></div>
    </div>
    <div class="filter-container d-flex justify-content-between align-items-center">
      <div class="d-flex">
        <div style="display: flex; flex-direction: column; align-items: center;">
          <label for="line_chart_start_date">Start Date:</label>
          <input type="date" id="line_chart_start_date">
        </div>
        <div style="display: flex; flex-direction: column; align-items: center; margin-left: 10px;">
          <label for="line_chart_end_date">End Date:</label>
          <input type="date" id="line_chart_end_date">
        </div>
      </div>
      <button onclick="filterCharts('line_chart')">Apply Filter</button>
    </div>
  </div>
  <div class="col-md-6 col-sm-12">
    <div class="chart-container">
      <div id="bar_chart" class="chart"></div>
    </div>
    <div class="filter-container d-flex justify-content-between align-items-center">
      <div class="d-flex">
        <div style="display: flex; flex-direction: column; align-items: center;">
          <label for="bar_chart_start_date">Start Date:</label>
          <input type="date" id="bar_chart_start_date">
        </div>
        <div style="display: flex; flex-direction: column; align-items: center; margin-left: 10px;">
          <label for="bar_chart_end_date">End Date:</label>
          <input type="date" id="bar_chart_end_date">
        </div>
      </div>
      <button onclick="filterCharts('bar_chart')">Apply Filter</button>
    </div>
  </div>
</div>

</body>
</html>
