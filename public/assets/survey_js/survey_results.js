document.addEventListener("DOMContentLoaded", async function () {
  const survey_url = document.getElementById("survey_url").textContent;
  const survey_id  = document.getElementById("survey_id").textContent;
  const interview_id = document.getElementById("interview_id").textContent;

  console.log('survey url:', survey_url);
  console.log('survey id:',survey_id);
  console.log('interview id:',interview_id);

  //
  const result_url = document.getElementById("result_url").textContent;

  console.log('Results url:', result_url);

  let survey; // Declare the survey variable outside fetchSurvey()


  async function fetchSurvey() {
    try {
      const response = await fetch(survey_url);

      if (response.ok) {
        const responseData = await response.json();

        console.log(responseData);

        // Parse the survey content from the response
        const surveyContent = JSON.parse(responseData.survey.content);

        const surveyJson = surveyContent;

        // Create the SurveyJS instance with the generated model
        survey = new Survey.Model(surveyJson);
        //survey.applyTheme(ContrastLight);

        // Render survey inside the page
        ko.applyBindings({
          model: survey
        });

        // Render Survey Results
        try {
          const response = await fetch(result_url);

          if (response.ok) {
            const surveyResults = await response.json();

            console.log('Results:', surveyResults);

            const resultData = surveyResults.result[0].content;
            const parsedData = JSON.parse(resultData);

            console.log('Parsed Results:', parsedData);

            // Render the survey results
            
            survey.data = parsedData;

            // Make Answers ReadOnly
            survey.getAllQuestions().forEach(question => {
              question.readOnly = true;
            });

            // Remove The Complete button that appears at the end of the survey
            //survey.show = false;
            survey.showCompleteButton = false;

          } else {
            throw new Error('Error fetching survey results');
          }
        } catch (error) {
          console.error(error);
        }

      } else {
        throw new Error('Error fetching data: ');
      }
    } catch (error) {
      console.error(error);
    }
  }

  fetchSurvey();

});
