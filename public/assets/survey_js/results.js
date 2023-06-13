const result_url = document.getElementById("result-url").innerHTML;
const SURVEY_ID = document.getElementById("survey_id").innerHTML;
const csrf = document.querySelector('meta[name="csrf-token"]').content;
const user_id = document.getElementById("user_id");
const survey_schema_id = document.getElementById("survey_schema_id");

let surveyJson = {};

console.log(result_url);
console.log(SURVEY_ID);
console.log(csrf);

async function saveSurveyResults(result_url, json) {
  const data = {
    user_id: user_id,
    survey_id: SURVEY_ID,
    content: json,
  };

  const options = {
    method: "PATCH",
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
      
      surveyJson = await response.json();
      const survey = new Survey.Model(surveyJson);
      survey.onComplete.add(surveyComplete);
      console.log(surveyJson);
    } else {
      throw new Error('Server or Network Error.');
    }
  } catch (error) {
    console.error('Error: ', error);
  }
}

function surveyComplete(sender) {
    const surveyData = sender.data;

    console.log('Survey Data: ', surveyData);

    saveSurveyResults(result_url, surveyData);
}

// Create a new instance of the SurveyJS model
const survey = new Survey.Model(surveyJson);

// Add the onComplete event handler
survey.onComplete.add(surveyComplete);

// Render the survey on the page
survey.render("surveyContainer");
