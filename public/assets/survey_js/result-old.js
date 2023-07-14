document.addEventListener("DOMContentLoaded", async function () {
  const result_url = document.getElementById("result_url").textContent;
  const interview_id = document.getElementById("interview_id").textContent;
  const survey_id = document.getElementById("survey_id").textContent;

  console.log('Results url:', result_url);
  console.log('Interview id:', interview_id);
  console.log('Survey id:', survey_id);

  //let survey; // Declare the survey variable outside fetchSurvey()


  async function renderSurveyResults() {
    try {
      const response = await fetch(result_url);

      if (response.ok) {
        const surveyResults = await response.json();

        console.log('Results:', surveyResults);

        const resultData = surveyResults.result[0].content

        const parsedData = JSON.parse(resultData);

        console.log('Parsed Results:', parsedData);

        const survey = new Survey.Model();

        // Setting the survey results
        survey.data = parsedData;

        const surveyContainer = document.getElementById('survey-results');

        survey.render(surveyContainer);

      } else {
        throw new Error('Error fetching survey results');
      }
    } catch (error) {
      console.error(error);
    }
  }

  renderSurveyResults();
});
