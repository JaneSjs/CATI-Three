document.addEventListener("DOMContentLoaded", async function () {
  const result_url = document.getElementById("result_url").textContent;
  const interview_id = document.getElementById("interview_id").textContent;
  const survey_id = document.getElementById("survey_id").textContent;

  console.log('Results url:', result_url);
  console.log('Interview id:', interview_id);
  console.log('Survey id:', survey_id);

  async function renderSurveyResults() {
    try {
      const response = await fetch(result_url);

      if (response.ok) {
        const surveyResults = await response.json();

        console.log('Results:', surveyResults);

        const resultData = surveyResults.result[0].content;
        const parsedData = JSON.parse(resultData);

        console.log('Parsed Results:', parsedData);

        // Display Survey Result JSON

        function formatJSON(data, parentKey = null) {
          var html = '';
          for (var key in data) {
            if (data.hasOwnProperty(key)) {
              var value = data[key];
              var formattedKey = key;
              if (typeof value === 'object' && value !== null) {
                html += `<tr><td>${formattedKey}</td><td>${formatJSON(value, key)}</td></tr>`;
              } else {
                var formattedValue = typeof value === 'string' ? `"${value}"` : value;
                html += `<tr><td>${formattedKey}</td><td>${formattedValue}</td></tr>`;
              }
            }
          }
          return html;
        }

        var formattedJson = formatJSON(parsedData);
        document.getElementById("json-data").innerHTML = formattedJson;
        

      } else {
        throw new Error('Error fetching survey results');
      }
    } catch (error) {
      console.error(error);
    }
  }

  renderSurveyResults();

});