const csrf = document.getElementsByTagName("meta")[3];
//const csrf = document.querySelector('meta[name="csrf-token"]').content;

const survey_id = document.getElementsByTagName("meta")[4];
const url = document.getElementById("url");

const model = fetch(url, options)
    .then((response) => {
        if (response.ok) {
            // Parse the response only if its JSON
            return response.json();
        } else {
            throw new Error('Server or Network Error.');
        }
    })
    .then((data) => console.log(data))
    .catch(error => console.error('Error: ',error));

const surveyJson = {
	elements: [{
		name: "FirstName",
		title: "Enter your first name:",
		type: "text"
	}, {
		name: "LastName",
		title: "Enter your last name:",
		type: "text"
	}]
};

const survey = new Survey.Model(surveyJson);

document.addEventListener("DOMContentLoaded", function () {
	ko.applyBindings({
		model: survey
	});
});