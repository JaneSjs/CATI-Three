const creatorOptions = {
    showLogicTab: true,
    isAutoSave: false
};

const creator = new SurveyCreator.SurveyCreator(creatorOptions);

let csrf = document.getElementsByTagName("meta")[3];

document.addEventListener("DOMContentLoaded", function() {
    creator.render("surveyCreator");
});

creator.saveSurveyFunc = (saveNo, callback) => {
    // If you use a web service:
    saveSurveyJson(
        "http://127.0.0.1:8000/survey_schema",
        creator.JSON,
        saveNo,
        callback
    );
};

function saveSurveyJson(url, json, saveNo, callback) {
    const data = {
        name: "blank",
        content: json
    }

    const options = {
        method: "POST",
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