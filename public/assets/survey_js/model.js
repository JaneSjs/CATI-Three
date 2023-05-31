document.addEventListener("DOMContentLoaded", function () {
	let url = document.getElementById("survey-url");

	let SURVEY_ID = document.getElementById("survey_id");

	console.log(url.textContent);
	console.log(SURVEY_ID);

	async function fetchSurvey() {
	try {
		const response = await fetch(url.textContent);

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
			document.addEventListener("DOMContentLoaded", function() {
			    ko.applyBindings({
			        model: survey
			    });
			});
		} else {
            throw new Error('Server or Network Error.');
        }
	} catch (error) {
		console.error('Error fetching data: ',error);
	}
}

fetchSurvey();
});

//let fetchedSchema;



