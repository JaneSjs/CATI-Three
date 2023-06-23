document.addEventListener("DOMContentLoaded", async function () {
  
  const surveyJsonUrl = document.getElementById("result_url").innerHTML;
  const surveyResultsUrl = document.getElementById("result_url").innerHTML;
  const survey_id  = document.getElementById("survey_id").textContent;

  Promise.all([fetch(surveyJsonUrl), fetch(surveyResultsUrl)])
    .then(responses => Promise.all(responses.map(response => response.json())))
    .then(([surveyJson, surveyResults]) => {
      const survey = new Survey.Model(surveyJson);

      const vizPanelOptions = {
        allowHideQuestions: false
      };

      const vizPanel = new SurveyAnalytics.VisualizationPanel(
        survey.getAllQuestions(),
        surveyResults,
        vizPanelOptions
      );

      vizPanel.render("surveyVizPanel");
    })
    .catch(error => {
      console.error("Error fetching data:", error);
    });
});
