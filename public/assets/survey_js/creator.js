    const creatorOptions = {
    showLogicTab: true,
    isAutoSave: false
};

const creator = new SurveyCreator.SurveyCreator(creatorOptions);


document.addEventListener("DOMContentLoaded", function () {

const csrf = document.querySelector('meta[name="csrf-token"]').content;

//const survey_id = document.getElementsByTagName("meta")[4];
const url = document.getElementById("url");
const survey_id = document.getElementById("survey_id").textContent;
const user = document.getElementById("user").textContent;

console.log(survey_id);
console.log(url.textContent);
console.log(user);
console.log(csrf);

    creator.render("surveyCreator");


creator.saveSurveyFunc = (saveNo, callback) => {
    // If you use a web service:
    saveSurveyJson(
        url.textContent,
        creator.JSON,
        saveNo,
        callback
    );
};

function saveSurveyJson(url, json, saveNo, callback) {
    const data = {
        user: user,
        id: survey_id,
        content: json,
        version: saveNo
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
            // Parse the response only if its JSON
            return response.json();
        } else {
            throw new Error('Server or Network Error.');
        }
    })
    .then((data) => console.log(data))
    .catch(error => console.error('Error: ',error));
}

});