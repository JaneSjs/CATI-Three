document.addEventListener("DOMContentLoaded", async function () {
  const survey_url = document.getElementById("survey-url");
  const SURVEY_ID = document.getElementById("survey_id");

  console.log(survey_url.textContent);
  console.log(SURVEY_ID);

  let survey; // Declare the survey variable outside fetchSurvey()

  async function fetchSurvey() {
    try {
      const response = await fetch(survey_url.textContent);

      if (response.ok) {
        const responseData = await response.json();

        console.log(responseData);

        // Parse the survey content from the response
        const surveyContent = JSON.parse(responseData.survey.content);

        // Process the fetched survey content and create a SurveyJS model
        const elements = surveyContent.pages[0].elements.map(item => ({
          name: item.name,
          title: item.title,
          type: item.type
        }));

        const surveyJson = {
          elements: elements
        };

        console.log('Survey JSON: ', surveyJson);

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

  fetchSurvey();

  /**
   * Collecting Survey Results
   */
  const result_url = document.getElementById("result-url").innerHTML;
  const csrf = document.querySelector('meta[name="csrf-token"]').content;

  console.log('Result Url: ',result_url);
  console.log(csrf);

  async function saveSurveyResults(result_url, json) {
    const data = {
      content: json,
    };

    const options = {
      method: "POST",
      body: JSON.stringify(data),
      headers: {
        "Content-Type": "application/json; charset=UTF-8",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": csrf,
      },
      credentials: "same-origin",
    };

    console.log(data);

    try {
      const response = await fetch(result_url, options);
      if (response.ok) {
        console.log('Results Submitted Successfully');

        const surveyResult = await response.json();
        console.log(surveyResult);
      } else {
        throw new Error('Server or Network Error.');
      }
    } catch (error) {
      console.error('Error: ', error);
    }
  }

  function surveyComplete(sender) {
    console.log('Survey complete:', sender);
    const surveyData = sender.data;

    console.log('Survey Data:', surveyData);

    saveSurveyResults(result_url, surveyData);
  }
});
