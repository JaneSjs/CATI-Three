document.addEventListener("DOMContentLoaded", async function () {
  const result_url = document.getElementById("result_url");
  const survey_id = document.getElementById("survey_id");

  console.log('survey Results url:', result_url.textContent);
  console.log('survey id:', survey_id.textContent);

  let survey; // Declare the survey variable outside fetchSurvey()


  async function renderSurveyResults() {
    try {
      const response = await fetch(result_url);

      if (response.ok) {
        const surveyResults = await response.json();

        // Render survey results inside the page
        const resultsElement = document.getElementById("survey-results");
        resultsElement.textContent = JSON.stringify(surveyResults);
      } else {
        throw new Error('Error fetching survey results');
      }
    } catch (error) {
      console.error(error);
    }
  }

  renderSurveyResults();
});
