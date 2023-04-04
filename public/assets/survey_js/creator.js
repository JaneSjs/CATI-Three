const creatorOptions = {
    showLogicTab: true,
    isAutoSave: true
};

const creator = new SurveyCreator.SurveyCreator(creatorOptions);

document.addEventListener("DOMContentLoaded", function() {
    creator.render("surveyCreator");
});

creator.saveSurveyFunc = (saveNo, callback) => {
    // If you use localStorage:
    window.localStorage.setItem("survey-json", creator.text);
    callback(saveNo, true);

    // If you use a web service:
    // saveSurveyJson(
    //     "https://your-web-service.com/",
    //     creator.JSON,
    //     saveNo,
    //     callback
    // );
};