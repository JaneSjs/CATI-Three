//const csrf = document.getElementsByTagName("meta")[3];
const csrf = document.querySelector('meta[name="csrf-token"]').content;

const survey_id = document.getElementsByTagName("meta")[4];
const url = document.getElementById("url");

let fetchedSchema;

async function fetchSurvey() {
	try {
		const response = await fetch(url.innerHTML);

		if (response.ok) {
			const responseData = await response.json();

			fetchedSchema = JSON.parse(responseData.survey.content);

			console.log(fetchedSchema);

			//const model = ko.observable(new Survey.Model(fetchedSchema));
			const model = new Survey.Model(fetchedSchema);

			// Unregister the component before registering it again
			ko.components.unregister('survey');

			ko.components.register('survey', {
				viewModel: function(params) {
					this.survey = params.survey;
				},
				template: '<div data-bind="survey: survey"></div>'
			});

			ko.bindingHandlers.survey = {
				init: function (element, valueAccessor) {
					const schema = ko.unwrap(valueAccessor());

					//Render survey in the specified element
					const survey = new Survey.Model(schema);
					survey.render(element);
				}
			};

			ko.applyBindings({ survey: model });

			
		} else {
            throw new Error('Server or Network Error.');
        }
	} catch (error) {
		console.error('Error: ',error);
	}
}

fetchSurvey();

