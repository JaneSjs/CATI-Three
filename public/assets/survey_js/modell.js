document.addEventListener("DOMContentLoaded", async function () {
	const survey_url = document.getElementById("survey-url");
	const SURVEY_ID = document.getElementById("survey_id");

	console.log(survey_url.textContent);
	console.log(SURVEY_ID);

	async function fetchSurvey() {
	try {
		const response = await fetch(survey_url.textContent);

		if (response.ok) {
			const responseData = await response.json();

			console.log(responseData);

			// Parse the survey content from the response
      		const surveyContent = JSON.parse(responseData.survey.content);

			//Process the fetched  survey content and create a SurveyJS model
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
			const survey = new Survey.Model(surveyJson);

            // Render survey inside the page

			ko.applyBindings({
			    model: survey
			});

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
//const SURVEY_ID = document.getElementById("survey_id").innerHTML;
const csrf = document.querySelector('meta[name="csrf-token"]').content;

let surveyJson = {};

console.log(result_url);
console.log(SURVEY_ID);
console.log(csrf);

function surveyComplete(sender) {
	console.log('Survey complete: ', sender);
    const surveyData = sender.data;

    console.log('Survey Data: ', surveyData);

    saveSurveyResults(result_url, surveyData);
}

async function saveSurveyResults(result_url, json) {
  const data = {
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
      // Add the onComplete event handler
	  survey.onComplete.add(surveyComplete);
      console.log(surveyJson);
    } else {
      throw new Error('Server or Network Error.');
    }
  } catch (error) {
    console.error('Error: ', error);
  }
}



// Create a new instance of the SurveyJS model
//const survey = new Survey.Model(surveyJson);

// // Add the onComplete event handler
// survey.onComplete.add(surveyComplete);

// Render the survey on the page
//survey.render("surveyContainer");



// End of DOMContentLoaded event wrapper
});




