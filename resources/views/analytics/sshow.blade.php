<!DOCTYPE html>
<html>
  <head>
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/survey-core@1.12.3/survey.core.min.js"></script>
    <script src="https://unpkg.com/survey-core@1.12.3/survey.i18n.min.js"></script>
    <script src="https://unpkg.com/survey-core@1.12.3/themes/index.min.js"></script>
    <script src="https://unpkg.com/survey-js-ui@1.12.3/survey-js-ui.js"></script>
    <script src="https://unpkg.com/plotly.js-dist-min/plotly.min.js"></script>
    <script src="https://unpkg.com/survey-analytics@1.12.3/survey.analytics.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/survey-analytics@1.12.3/survey.analytics.css" />
    <link rel="stylesheet" href ="./index.css" />
  </head>
  <body>
    <div id="loadingIndicator" class="data-loading-indicator-panel">
      <div class="data-loading-indicator">
        <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_17928_11482)">
            <path d="M32 64C14.36 64 0 49.65 0 32C0 14.35 14.36 0 32 0C49.64 0 64 14.35 64 32C64 49.65 49.64 64 32 64ZM32 4C16.56 4 4 16.56 4 32C4 47.44 16.56 60 32 60C47.44 60 60 47.44 60 32C60 16.56 47.44 4 32 4Z" fill="#E5E5E5" />
            <path d="M53.2101 55.2104C52.7001 55.2104 52.1901 55.0104 51.8001 54.6204C51.0201 53.8404 51.0201 52.5704 51.8001 51.7904C57.0901 46.5004 60.0001 39.4704 60.0001 31.9904C60.0001 24.5104 57.0901 17.4804 51.8001 12.1904C51.0201 11.4104 51.0201 10.1404 51.8001 9.36039C52.5801 8.58039 53.8501 8.58039 54.6301 9.36039C60.6701 15.4004 64.0001 23.4404 64.0001 31.9904C64.0001 40.5404 60.6701 48.5704 54.6301 54.6204C54.2401 55.0104 53.7301 55.2104 53.2201 55.2104H53.2101Z" fill="#19B394" />
          </g>
          <defs>
            <clipPath id="clip0_17928_11482">
              <rect width="64" height="64" fill="white" />
            </clipPath>
          </defs>
        </svg>
      </div>
    </div>
    <div id="dashboardTabs" class="tabs" style="display:none">
        <button class="tablinks" onclick="changeDashboardTab(0)">Net Promoter Score</button>
        <button class="tablinks" onclick="changeDashboardTab(1)">Customer Segmentation</button>
        <button class="tablinks" onclick="changeDashboardTab(2)">Frameworks and Devices</button>
    </div>
    <div id="surveyDashboardContainer"></div>
    <script src="./json.js"></script>
    <script src="./index.js"></script>
  </body>
</html>