const url = document.getElementById("result-url").innerHTML;
const SURVEY_ID = document.getElementById("survey_id").innerHTML;
const csrf = document.querySelector('meta[name="csrf-token"]').content;

console.log(url);
console.log(SURVEY_ID);
console.log(csrf);

function surveyComplete(sender) {
	saveSurveyResults(url, sender.data);
}

function saveSurveyResults(url, json) {
    const data = {
        content: json,
    }

    const options = {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json; charset=UTF8",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": csrf
        },
        credentials: "same-origin",
    };

    console.log(data);

    fetch(url, options)
    .then((response) => {
        if (response.ok) {
            console.log('Results Submitted Successfully');
            // Parse the response only if its JSON
            surveyJson = response.json();
            return surveyJson;
        } else {
            throw new Error('Server or Network Error.');
        }

        const survey = new Survey.Model(surveyJson);

        survey.onComplete.add(surveyComplete);
    })
    .then((data) => console.log(data))
    .catch(error => console.error('Error: ',error));
}

// function alertResults(sender) {
//     const results = JSON.stringify(sender.data);

//     alert(results);
// }

