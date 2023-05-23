const creatorOptions = {
    showLogicTab: true,
    isAutoSave: false
};

const creator = new SurveyCreator.SurveyCreator(creatorOptions);

let csrf = document.getElementsByTagName("meta")[3];

const survey_id = document.getElementsByTagName("meta")[4];
const url = document.getElementById("url");

console.log(url.textContent);

document.addEventListener("DOMContentLoaded", function() {
    creator.render("surveyCreator");
});

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
        id: survey_id.content,
        content: json,
        version: saveNo
    }

    const options = {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json; charset=UTF8",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": csrf.content
        },
        credentials: "same-origin",
    };

    //console.log(csrf.content);

    fetch(url, options)
    .then((response) => response.json())
    .then((data) => console.log(data))
    .catch(error => console.log(error));
}