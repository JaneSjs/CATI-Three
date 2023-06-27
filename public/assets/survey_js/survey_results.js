document.addEventListener("DOMContentLoaded", async function () {
  const survey_url = document.getElementById("survey_url");
  const survey_id = document.getElementById("survey_id");
  const user_id = document.getElementById("user_id");

  console.log('survey url:', survey_url.textContent);
  console.log('survey id:', survey_id.textContent);
  console.log('user id:', user_id.textContent);

  let survey; // Declare the survey variable outside fetchSurvey()

  async function fetchSurvey() {
    try {
      const response = await fetch(survey_url.textContent);

      if (response.ok) {
        const responseData = await response.json();

        console.log(responseData);

        // Parse the survey content from the response
        const surveyContent = JSON.parse(responseData.survey.content);

        const surveyJson = surveyContent;

        // Create the SurveyJS instance with the generated model
        survey = new Survey.Model(surveyJson);

        // Render survey inside the page
        ko.applyBindings({
          model: survey
        });

        // Add the onComplete event handler
        survey.onComplete.add(surveyComplete);
      } else {
        throw new Error('Error fetching data: ');
      }
    } catch (error) {
      console.error(error);
    }
  }

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

  fetchSurvey();
  renderSurveyResults();

  /**
   * Collecting Survey Results
   */
  const result_url = document.getElementById("result_url").innerHTML;
  const csrf = document.querySelector('meta[name="csrf-token"]').content;

  console.log('Result Url: ', result_url);
  console.log(csrf);

  async function saveSurveyResults(result_url, json) {
    // ...existing code...
  }

  // ...existing code...

  function surveyComplete(sender) {
    console.log('Survey complete:', sender);
    const surveyData = sender.data;

    console.log('Survey Data:', surveyData);

    saveSurveyResults(result_url, surveyData);
  }
});
