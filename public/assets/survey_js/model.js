const url = document.getElementById("url");

console.log(url.innerHTML);

let fetchedSchema;

async function fetchSurvey() {
	try {
		const response = await fetch(url.innerHTML);

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

			console.log(surveyJson);
            // Create the SurveyJS instance with the generated model
			const survey = new Survey.Model(surveyJson);

			document.addEventListener("DOMContentLoaded", function() {
			    ko.applyBindings({
			        model: survey
			    });
			});

            // Render the survey on the page
            // Survey.StylesManager.applyTheme("default");
    		// SurrveyNG.render('surveyContainer', { model: survey });


		} else {
            throw new Error('Server or Network Error.');
        }
	} catch (error) {
		console.error('Error fetching data: ',error);
	}
}

fetchSurvey();

